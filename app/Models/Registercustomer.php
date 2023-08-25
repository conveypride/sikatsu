<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registercustomer extends Model
{
    use HasFactory;
     

    protected $fillable = [
        'newcustomer',
        'cardprice',
        'cardnum',
        'registrationdate',
        'initialdeposite',
        'status'
    ];

}
