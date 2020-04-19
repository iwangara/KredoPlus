<?php

namespace App\Http\Controllers;

use App\Airtime;
use Illuminate\Http\Request;
use App\Http\Requests\AirtimeRequest;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use SmoDav\Mpesa\Laravel\Facades\STK;
use DB;
class AirtimeController extends Controller
{
    public function confirm(AirtimeRequest $request)
    {

        $saf = $request->get('saf');#request()->except(['_token','_method']);
        $airtel = $request->get('airtel');
        $amount = $request->get('amount');


        return view('client.confirm',compact('saf','airtel','amount'));
    }
    public function payment(Request $request)
    {

        $saf = $request->get('saf');
        $airtel ='254' . substr($request->get('airtel'), -9) ;
        $amount = $request->get('amount');
        $uniqueCode = $this->random_number_string(5);
        $phoneNo = '254' . substr($saf, -9);
        $mpesa_response = STK::request(intval($amount))
            ->from($phoneNo)
            ->usingReference(env('APP_NAME'),$uniqueCode)
            ->push();
//        dd($mpesa_response);
        return $this->HandleSTKResponse($mpesa_response,$phoneNo,$airtel,$amount);
    }

    private function random_number_string($length)
    {
        $faker = Str::random($length);
        return $faker;
    }

    private function HandleSTKResponse($mpesa_response,$phoneNo,$airtel,$amount)
    {
        if($mpesa_response){
            $payload = json_decode(json_encode($mpesa_response));
            if (Arr::has($payload,'ResponseCode')) {
                $MerchantRequestID=$payload->MerchantRequestID;
                $CheckoutRequestID=$payload->CheckoutRequestID;
                $ResponseCode=$payload->ResponseCode;
                $ResultDesc=$payload->ResponseDescription;
                $data=array('no_saf'=>$phoneNo,'no_air'=>$airtel,'amount'=>$amount,'MerchantRequestID'=>$MerchantRequestID,'CheckoutRequestID'=>$CheckoutRequestID,'ResultCode'=>$ResponseCode,
                    'ResultDesc'=>$ResultDesc,'created_at' => date('Y-m-d H:i:s'),'updated_at' => date('Y-m-d H:i:s'));
                DB::table('airtimes')->insert($data);
                if ($payload->ResponseCode == 0) {

                    return view('client.payment',compact('amount','CheckoutRequestID'));
                }else{
                    return view('client.error');
                }
            }else{
                return view('client.error');
            }
        }
        return view('client.error');


    }

    private function validateCheckout($CheckoutRequestID){
        $response = STK::validate($CheckoutRequestID);
        return $response;
    }
    public function success(Request $request)
    {
        $CheckoutRequestID = $request->get('CheckoutRequestID');
        $validateCheckout = $this->validateCheckout($CheckoutRequestID);
        $payload = json_decode(json_encode($validateCheckout));
        if (Arr::has($payload,'errorCode')) {
            if ($payload->errorMessage =="The transaction is being processed") {
                $status='Please enter your Mpesa pin on the pop up on your phone';
                return view('client.status',compact('status'));
            }
        }
        if (Arr::has($payload,'ResultCode')) {
            if ($payload->ResultCode == 0) {
                return view('client.success');
            }elseif ($payload->ResultCode == 2001){
                Airtime::where('CheckoutRequestID',$CheckoutRequestID)
                    ->update(['ResultCode'=>$payload->ResultCode,'ResultDesc'=>$payload->ResultDesc]);
                $status="You entered an Invalid Pin Number";
                return view('client.status',compact('status'));
            }elseif ($payload->ResultCode == 1032){
                Airtime::where('CheckoutRequestID',$CheckoutRequestID)
                    ->update(['ResultCode'=>$payload->ResultCode,'ResultDesc'=>$payload->ResultDesc]);
                $status="You cancelled the transaction";
                return view('client.status',compact('status'));
            }else{
                Airtime::where('CheckoutRequestID',$CheckoutRequestID)
                    ->update(['ResultCode'=>$payload->ResultCode,'ResultDesc'=>$payload->ResultDesc]);
                $status="Unknown error,Try Again or Contact support";
                return view('client.status',compact('status'));
            }
        }

//        dd($validateCheckout);
    }



    public function get_key(){
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
