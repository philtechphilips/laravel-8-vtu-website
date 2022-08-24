<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\Funds;
use App\Models\Transactions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Airtime extends Controller
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
        return view("Users.main.airtime", compact("fund"));
    }

    public function buyAirtime(Request $request){
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
        $network = $request->network;
        $amount = $request->amount;
        $ported = $request->ported;
        $phone = $request->phone;


        $current_balance = $funds; //Wallet Balance
        $product_price = $amount;
        if($current_balance > $product_price){
        $endpoint = "https://www.payscribe.ng/sandbox/airtime";
        $key = getenv("PAYSCRIBE_KEY");
         $postdata = array(
           "network" => $network,
             "recipent" => $phone,
             "amount" => $amount,
             "ported" => $ported
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
        //  var_dump($result);
        $status = $result->status; //Getting Transaction Status
        if($status == 1){
            //Getting Auth User
            $user_id = Auth::user()->id;
            $transaction = new Transactions();
            $transaction_id = $result->message->details->transaction_id;
            $transaction->tx_id = "LUPAY".$transaction_id;
            $transaction->amount = $result->message->details->amount;
            $transaction->product = "Airtime Recharge";
            $transaction->description = $result->message->details->processed;
            $transaction->user_id = $user_id;
            $transaction->time = $result->message->details->datetime;
            $transaction->status = $result->status;
          
           $transaction->prev_bal = $current_balance;
           $transaction->amount = $product_price;
           $transaction->balance = $current_balance - $product_price;
           $n_transac = $transaction->save();
           if($n_transac){
            echo "Airtime Purchase is Sucessfull!";
           }else{
           echo "Something is Wrong!";
           } 
          }

    }else{
      echo "Insufficient Funds";
      }
}
}