<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transactions extends Model
{
    use HasFactory;
    protected  $fillable = [
        'bookletId',
        'customerid',
        'pagenum',
        'boxid',
        'depositamount',
        'transactionDate'
    ];
}
