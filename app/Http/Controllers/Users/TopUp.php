<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\Funds;
use App\Models\Transactions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TopUp extends Controller
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
      $all_funds = Funds::where("user_id", $user)->latest()->get(); //Getting all funds to display in table
      return view("Users.main.topup", compact("fund", "all_funds"));
    }

    public function verify($reference){
        $user = Auth::user()->id; //Getting authenticated user
            $n_fund = Funds::where("user_id", $user)->first();  //Getting deposited amounts
            if($n_fund == []){
               $n_fund = 50;
             }else{
            //Getting last transaction transactions
            $tranactions = Transactions::where("user_id", $user)->latest()->first();
           //Getting wallet Balance
           if($tranactions == []){
           $n_fund = Funds::where("user_id", $user)->sum("amount");
           }else{
           $n_fund = $tranactions->balance;
           }
          }
        $sec = getenv("PAYSTACK_SECRET_KEY");
        $curl = curl_init();
  
        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://api.paystack.co/transaction/verify/$reference",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_SSL_VERIFYHOST => 0,
          CURLOPT_SSL_VERIFYPEER => 0,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET",
          CURLOPT_HTTPHEADER => array(
            "Authorization: Bearer $sec",
            "Cache-Control: no-cache",
          ),
        ));
        
        $response = curl_exec($curl);
        $err = curl_error($curl);
      
        curl_close($curl);
        
        $new_data = json_decode($response);
        // echo $response;
        $status =  $new_data ->status;
        $real_status =  $new_data->data->status;
        $trans_id =  $new_data->data->reference;
         $init_time =  $new_data->data->created_at;
         $success_time =  $new_data->data->paid_at;
         $amount=  $new_data->data->amount;
         $gateway=  $new_data->data->gateway_response;
        $real_amount = $amount/100;
        
        if($status == true){
            $fund = new Funds();
           $fund->status = $real_status;
           $fund->trans_id = $trans_id;
           $fund->init_time = $init_time;
           $fund->success_time = $success_time;
           $fund->amount = $real_amount;
           $fund->gateway_response = $gateway;
           $fund->user_id = $user;
           $funds = $fund->save();  
           if($funds){
              //Save In Transaction Database Also
          $user_id = Auth::user()->id;
          $transaction = new Transactions();
          $transaction->tx_id = $trans_id;
          $transaction->amount = $real_amount;
          $transaction->product = "Wallet Funding";
          $transaction->description = "Paystack Payment";
          $transaction->user_id = $user_id;
          $transaction->time = date("Y-m-d H:i:s");
          $transaction->status = $status;
          $transaction->prev_bal = $n_fund;
          $transaction->balance = $n_fund + $real_amount;
          $n_transac = $transaction->save();
         if($n_transac){
             echo "Inserted Sucessfully";
         }else{
          echo "Something is Wrong";
         } 
           }
        } 
        }
    }