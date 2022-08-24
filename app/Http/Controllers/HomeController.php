<?php

namespace App\Http\Controllers;

use App\Models\Funds;
use App\Models\Transactions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
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
        return view("Users.main.content", compact("fund", "all_tranactions"));
        // return view('home');
    }
}
