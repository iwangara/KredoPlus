<?php

namespace App\Http\Controllers;
use App\Airtime;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $balance=$this->get_balance();
        $complete=Airtime::where('status',1)->count();
        $failed =Airtime::whereNull('status')->count();
        $revenue = Airtime::where('status',1)->sum('amount');
        $transactions =Airtime::paginate(10);
        return view('dashboard',compact('complete','balance','failed','transactions','revenue'));
    }


    private function get_balance(){
        $data = array(
            'username' => env('VENDOR_USERNAME'),
            'key' => $this->get_key(),
        );
        $payload = json_encode($data);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://vendingpointea.com:2053/v3/balance');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        $response = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($response);
        $status = $response->status;
        if ($status==0){
            return $response->balance;
        }else{
            return false;
        }
    }

    private function get_key(){
        $data = array(
            'username' => env('VENDOR_USERNAME'),
            'password' => env('VENDOR_PASSWORD'),
        );
        $payload = json_encode($data);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://vendingpointea.com:2053/v3/login');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        $response = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($response);
        $status = $response->status;
        if ($status==0){
            return $response->key;
        }else{
            return false;
        }
    }
}
