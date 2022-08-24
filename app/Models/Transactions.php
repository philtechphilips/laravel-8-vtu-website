<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transactions extends Model
{
    use HasFactory;
    protected $fillable = ["user_id", "tx_id", "time", "amount", "balance", "prev_bal", "product", "description", "status", "created_at"];
}
