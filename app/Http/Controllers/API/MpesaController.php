<?php
namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use DB;
use App\Airtime;
class MpesaController extends Controller
{

    public function receiveMpesaCallback()
    {
        $payload =  file_get_contents('php://input');
        if(!$payload){
            Log::error('PAYMENT >> MPESA: No Body sent');
            return response('ERROR: NO REQUEST');
        }
        //the body
        Log::info($payload);
       
        $result = json_decode($payload);
        $ResultCode=$result->Body->stkCallback->ResultCode;
        $MerchantRequestID=$result->Body->stkCallback->MerchantRequestID;
        $CheckoutRequestID=$result->Body->stkCallback->CheckoutRequestID;
        $ResultDesc=$result->Body->stkCallback->ResultDesc;
//if the user's transaction goes through
        if($ResultCode == 0) {
            $Amount =$result->Body->stkCallback->CallbackMetadata->Item[0]->Value;
            $MpesaReceiptNumber=$result->Body->stkCallback->CallbackMetadata->Item[1]->Value;
            $TransactionDate=$result->Body->stkCallback->CallbackMetadata->Item[3]->Value;
            $SAF =$result->Body->stkCallback->CallbackMetadata->Item[4]->Value;
            $Air=Airtime::where('CheckoutRequestID',$CheckoutRequestID)->first()->no_air;
            Log::info($SAF.' trying to buy '.$Amount.' for '. $Air. ' MpesaTXN: '.$MpesaReceiptNumber);
            //save mpesa details
            Airtime::where('CheckoutRequestID',$CheckoutRequestID)
                ->where('MerchantRequestID',$MerchantRequestID)
                ->update(['ResultDesc'=>$ResultDesc,'MpesaReceiptNumber'=>$MpesaReceiptNumber,'TransactionDate'=>$TransactionDate]);
//            buy them airtime
            $buy_airtel =$this->buy_airtime($Amount,$Air);
            $resp =json_decode(json_encode($buy_airtel));
            Log::info(json_encode($buy_airtel));
//            if airtime vending goes through
            if($resp->transaction->status==1){
                $status=$resp->transaction->status;
                $operator=$resp->transaction->operator;
                $transactionId=$resp->transaction->transactionId;
                $receiptno=$resp->transaction->receiptno;
                Log::info($SAF.' bought '.$Amount.' for '. $Air. ' MpesaTXN: '.$MpesaReceiptNumber.' receipt no '.$receiptno);
//              save the airtime vending activity
                Airtime::where('CheckoutRequestID',$CheckoutRequestID)
                    ->where('MerchantRequestID',$MerchantRequestID)
                    ->update(['receiptno'=>$receiptno,'operator'=>$operator,'transactionId'=>$transactionId,'status'=>$status,'updated_at' => date('Y-m-d H:i:s')]);
            }else{
                Log::info('Vending failed '.$resp);
            }
        }else{
            Log::info('ERROR:'.$payload);
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

    private function buy_airtime($amount,$no_air){
        $key=$this->get_key();
        $data = array(
            'username' => env('VENDOR_USERNAME'),
            'key' => $key,
            'operator'=>'Airtel',
            'amount'=>$amount,
            'mobileno'=>$no_air
        );
        $payload = json_encode($data);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://vendingpointea.com:2053/v3/airtimebuypinless');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        $response = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($response);
        return $response;
    }
}
