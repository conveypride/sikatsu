<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SavingsBookletPages extends Model
{
    use HasFactory;

protected $fillable = [
'bookletId',
'customerid',
'pagenum',
'isfull',
'haswithdrawn',
'totaldeposit',
'balance',
'profit',
];

}
