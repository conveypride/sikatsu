<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Withdraw;
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
  $totalwithdrwan =   Withdraw::sum('withdrawalamount');
// $amountnowithdrawn =  DB::table('savings_booklet_pages')->where('haswithdrawn','false')->sum('balance');
$balance =  $totaldeposit - ($totalwithdrwan + $profit);

$customers =  DB::table('registercustomers')->where('status', 'Active')->count('cardnum');

    return  view('content.dashboard.dashboards-analytics', compact('profit','totaldeposit','balance', 'customers', 'totalwithdrwan'));

}else {
  return view('content.authentications.auth-login-basic');
}


  }
}
