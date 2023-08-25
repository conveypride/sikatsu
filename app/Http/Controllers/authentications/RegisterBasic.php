<?php

namespace App\Http\Controllers\authentications;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class RegisterBasic extends Controller
{
  public function index()
  {
    return view('content.authentications.auth-register-basic');
  }


  public function storeUser(Request $request)
  {
    try {
      $request->validate([
          'name'      => 'required|string|max:255',
          'email'     => 'required|string|email|max:255|unique:users',
          'password'  => 'required|string|min:8',
      ]);

      // $dt       = Carbon::now();
      // $todayDate = $dt->toDayDateTimeString();
      
      User::create([
          'name'      => $request->name,
          'email'     => $request->email,
          'password'  => Hash::make($request->password),
      ]);
      // Toastr::success('Create new account successfully :)','Success');
      return redirect()->route('login');
    } catch (\Throwable $th) {
      //throw $th;
      Log::info($th);
    }


  }
}
