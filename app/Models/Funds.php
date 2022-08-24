<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Funds extends Model
{
    use HasFactory;
    protected $table = 'funds';
    protected $fillable = [
        'user_id','status', 'trans_id', 'init_time', 'success_time', 'amount', 'gateway_response',
    ];
}
