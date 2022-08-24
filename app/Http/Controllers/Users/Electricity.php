<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Electricity extends Controller
{
    public function index(){
        return view("Users.main.electricitity");
    }
}
