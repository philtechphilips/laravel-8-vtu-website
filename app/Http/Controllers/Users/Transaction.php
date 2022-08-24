<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\Funds;
use App\Models\Transactions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Transaction extends Controller
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
        //Show Transactions Table Details in Table
        $all_tranactions = Transactions::where("user_id", $user)->latest()->get();
        return view('Users.main.transactions', compact('fund', 'all_tranactions'));
    }
}
