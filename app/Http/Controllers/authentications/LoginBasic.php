<?php

namespace App\Http\Controllers\authentications;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class LoginBasic extends Controller
{
  public function index()
  {
    return view('content.authentications.auth-login-basic');
  }


  public function authenticate(Request $request)
  {
      $request->validate([
          'email'    => 'required|string',
          'password' => 'required|string',
      ]);

      $email = 'Jacob@gmail.com';
      $password = $request->password;

      $dt         = Carbon::now();
      $todayDate  = $dt->toDayDateTimeString();
      try {
   
      if (Auth::attempt(['email'=> $email,'password'=> $password])) {
          /** get session */
          $user = Auth::User();
          Session::put('name', $user->name);
          Session::put('email', $user->email);
          // Toastr::success('Login successfully 😎','Success');
          return redirect()->route('dashboard-analytics');
 
         
      } else {
          // Toastr::error('fail, WRONG email OR PASSWORD :)','Error');
          return redirect()->route('login');
      }

  } catch (\Throwable $th) {
        //throw $th;
        Log::info($th);
      }
      
  }




}
