<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\Data as ModelsData;
use App\Models\Funds;
use App\Models\Transactions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Data extends Controller
{
    public function index(){
      $user = Auth::user()->id; //Getting authenticated user
      $fund = Funds::where("user_id", $user)->first();  //Getting deposited amounts
      if($fund == []){
        $fund = 0;
      }else{
        //Getting last transaction transactions
        $tranactions = Transactions::where("user_id", $user)->latest()->first();
        //Getting wallet Balance
       if($tranactions == []){
         $fund = Funds::where("user_id", $user)->sum("amount");
       }else{
        $fund = $tranactions->balance;
       }
      }
        return view("Users.main.data", compact("fund"));
    }

    public function data(Request $request){
       $net = $request->network;
       $plans = ModelsData::where("network_name", $net)->get();
    //    $plans->name;
       if($net != ""){
        foreach($plans as $plans){
            echo "<option value='$plans->plan_code'>$plans->name &#8358 $plans->amount</option>";
        }
       }
        // echo "<option>dhhdhhdhdhd</option>";
    //    $data = ModelsData::where('network_name', '9MOBILE')->get();
    //    foreach($data as $data){
    //     echo $data->amount;
    //    }
    }
public function buyData(Request $request){
  //Buying Data
 $network = $request->network;
 $check = $request->check;
 $phone = $request->phone;
 $net = strtolower($network);
 //Product Price
 $price_object = ModelsData::where("plan_code", $check)->first();
 $price = $price_object->amount;
   //Getting Wallet Balance
   $user = Auth::user()->id; //Getting authenticated user
   $fund = Funds::where("user_id", $user)->first();  //Getting deposited amounts
   if($fund == []){
   $funds = 0;
   }else{
   //Getting last transaction transactions
   $tranactions = Transactions::where("user_id", $user)->latest()->first();
   //Getting wallet Balance
   if($tranactions == []){
    $funds = Funds::where("user_id", $user)->sum("amount");
   }else{
   $funds = $tranactions->balance;
    }
   }

   $current_balance = $funds; //Wallet Balance
   $product_price = $price;
   if($current_balance > $product_price){
    $endpoint = "https://www.payscribe.ng/sandbox/data/vend";
    $key = getenv("PAYSCRIBE_KEY");
         $postdata = array(
           "plan" => $check,
             "recipent" => $phone,
             "network" => $net
         );
         
         $ch = curl_init();
         curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
         curl_setopt($ch, CURLOPT_URL, $endpoint);
         curl_setopt($ch, CURLOPT_POST, 1);
         curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postdata));
         curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
         curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 300);
         curl_setopt($ch, CURLOPT_TIMEOUT, 300);
         curl_setopt($ch, CURLOPT_HTTPHEADER, array(
         "Authorization: Bearer $key",
         "Content-Type: Application/json",
         "Cache-control: no-cache"
         ));
         
         $request = curl_exec($ch);
         $result = json_decode($request);
         //var_dump($result);
         $status = $result->status; //Getting Transaction Status
         //If transaction is successful Save Transaction details to database
         if($status == 1){
           
           //Getting Auth User
           $user_id = Auth::user()->id;
           $transaction = new Transactions();
           $transaction_id = $result->message->details->transaction_id;
           $transaction->tx_id = "LUPAY".$transaction_id;
           $transaction->amount = $result->message->details->amount;
           $transaction->product = $result->message->details->plan;
           $transaction->description = $result->message->details->processed;
           $transaction->user_id = $user_id;
           $transaction->time = $result->message->details->datetime;
           $transaction->status = $result->status;
         
          $transaction->prev_bal = $current_balance;
          $transaction->amount = $product_price;
          $transaction->balance = $current_balance - $product_price;
          $n_transac = $transaction->save();
          if($n_transac){
              echo "Data Purchase is Sucessfull!";
          }else{
           echo "Something is Wrong!";
          } 
         }
   }else{
   echo "Insufficient Funds";
   }

 
      // echo $status;

}
    public function vtu()
    {
      $endpoint = "https://www.payscribe.ng/sandbox/data/lookup";
    $key = getenv("PAYSCRIBE_KEY");
         $postdata = array(
           "network" => "mtn",
             "tyoe" => "gifting",
            //  "network" => $net
         );
         
         $ch = curl_init();
         curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
         curl_setopt($ch, CURLOPT_URL, $endpoint);
         curl_setopt($ch, CURLOPT_POST, 1);
         curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postdata));
         curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
         curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 300);
         curl_setopt($ch, CURLOPT_TIMEOUT, 300);
         curl_setopt($ch, CURLOPT_HTTPHEADER, array(
         "Authorization: Bearer $key",
         "Content-Type: Application/json",
         "Cache-control: no-cache"
         ));
         
         $request = curl_exec($ch);
         $result = json_decode($request);
         var_dump($result);
    }
}
