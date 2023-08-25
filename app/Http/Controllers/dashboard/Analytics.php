<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Analytics extends Controller
{
  public function index()
  {

if(Auth::check()){

  $profit =  DB::table('savings_booklet_pages')->sum('profit');
  $totaldeposit =  DB::table('savings_booklet_pages')->sum('totaldeposit');
$balance =  DB::table('savings_booklet_pages')->sum('balance');

$customers =  DB::table('registercustomers')->where('status', 'Active')->count('cardnum');

    return view('content.dashboard.dashboards-analytics', compact('profit','totaldeposit','balance', 'customers'));

}else {
  return view('content.authentications.auth-login-basic');
}


  }
}
