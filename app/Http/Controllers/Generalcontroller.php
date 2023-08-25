<?php

namespace App\Http\Controllers;

use App\Models\Expenditure;
use App\Models\Registercustomer;
use App\Models\SavingsBooklet;
use App\Models\SavingsBookletPages;
use App\Models\Transactions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class Generalcontroller extends Controller
{
    //
 
    
  public function calculateActiveToInactivePercentage() {
        $activeCustomers = Registercustomer::where('status', 'Active')->count();
        $inactiveCustomers = Registercustomer::where('status', 'Inactive')->count();
        
        if ($inactiveCustomers === 0) {
            return 100; // All customers are active, so percentage is 100%
        }
    
        $percentage = ($activeCustomers / ($activeCustomers + $inactiveCustomers)) * 100;
        return $percentage;
    }
    

    function calculateInactiveToActivePercentage() {
        $activeCustomers = Registercustomer::where('status', 'Active')->count();
        $inactiveCustomers = Registercustomer::where('status', 'Inactive')->count();
        
        if ($activeCustomers === 0) {
            return 100; // All customers are inactive, so percentage is 100%
        }
        
        $percentage = ($inactiveCustomers / ($activeCustomers + $inactiveCustomers)) * 100;
        return $percentage;
    }

// generate unique id
  public function generateIdNumber($length = 8) {
    $id = Str::random($length);
    
    while (strlen($id) < $length) {
        $id .= mt_rand(0, 9);
    }
    
    return $id;
}

   
    public function  registerCustomer(Request $request)
    {
       $customers = Registercustomer::get();
       $activeCustomers = Registercustomer::where('status','Active')->count();
       $inactiveCustomers = Registercustomer::where('status','Inactive')->count();
       $cardsales = Registercustomer::sum('cardprice');
       $cardsalesno = Registercustomer::select('cardprice')->count();
       $idNumber = $this->generateIdNumber();
       $percentageofactiveusers = $this->calculateActiveToInactivePercentage();
       $percentageofinactiveusers = $this->calculateInactiveToActivePercentage();
if( $percentageofactiveusers > $percentageofinactiveusers){
    $activesucess = 'true' ;
}else{
    $activesucess = 'false';
}

        return view('content.susuUi.registercustomer',compact('customers','idNumber', 'activeCustomers', 'inactiveCustomers', 'percentageofactiveusers', 'percentageofinactiveusers', 'activesucess', 'cardsales', 'cardsalesno'));
    }



 public function  registerCustomerpost(Request $request)
{ 
    
    try {
        $request->validate([
            'newcustomer'      => 'required|string|max:255',
            'cardprice'     => 'required|string|max:255',
            'cardnum'  => 'required|string|max:255',
            'registrationdate'  => 'required|string|max:255',
            'initialdeposite' => 'required|string|max:255',
        ]);

  $data = [
 "newcustomer" => $request->newcustomer,
  "cardprice" => $request->cardprice ,
  "cardnum" =>$request->cardnum ,
  "registrationdate" => $request->registrationdate ,
  "initialdeposite" => $request->initialdeposite ,
  'status' => 'Active'
        ];
$idd = $this->generateIdNumber();
        $booklet = [
            "bookletId" => $idd,
            "customerid" => $request->cardnum,
            "maxpages" =>  '15',
            'status' => 'Active'
         ];

$bookletpages = [
    'bookletId' => $idd,
    'customerid'  => $request->cardnum ,
    'pagenum' => '1',
    'isfull' => 'false',
    'haswithdrawn' => 'false',
    'totaldeposit' => $request->initialdeposite,
    'balance'=> '0' ,
    'profit' => $request->initialdeposite
    ];

    $transaction = [
        'bookletId' => $idd,
        'customerid' =>  $request->cardnum,
        'pagenum' => '1',
        'boxid' => '1',
        'depositamount' =>$request->initialdeposite,
        'transactionDate' => now()
    ];

Registercustomer::create($data);
SavingsBooklet::create($booklet);
SavingsBookletPages::create($bookletpages);
Transactions::create($transaction);

        return redirect()->route('registerCustomer');

} catch (\Throwable $th) {
    //throw $th;
    Log::info($th);
 }
   
    }

    // customer deposit/ Tranactions
    public function customerDeposit() {
        $idNumber = $this->generateIdNumber();
        $customers = Registercustomer::get();
        return view('content.susuUi.customerDeposit',compact('customers', 'idNumber'));
    }

 public function customerDepositpost(Request $request) {
    $customerid = $request->customer;
   $registercustomers = DB::table('registercustomers')->where('cardnum',$customerid)->first();
   
   $savingsBooklets = DB::table('savings_booklets')->where('customerid',$customerid)->first();
  $savingsBookletPages =  DB::table('savings_booklet_pages')->where('customerid',$customerid)->get();
  $transactions =  DB::table('transactions')->where('customerid',$customerid)->get();
  $customers = DB::table('registercustomers')->get();  
  $amountWithdrawn = SavingsBookletPages::where('haswithdrawn','true')->sum('balance');
        // dd($transactions);
        return view('content.susuUi.customerbooklet',compact('registercustomers', 'savingsBooklets', 'savingsBookletPages', 'transactions', 'customers', 'amountWithdrawn' ));
    }

 public function customerTransactionpostget($id) {
    $customerid = $id;
    // dd($id);
   $registercustomers = DB::table('registercustomers')->where('cardnum',$customerid)->first();
   
   $savingsBooklets = DB::table('savings_booklets')->where('customerid',$customerid)->first();
  $savingsBookletPages =  DB::table('savings_booklet_pages')->where('customerid',$customerid)->get();
  $transactions =  DB::table('transactions')->where('customerid',$customerid)->get();
  $customers = DB::table('registercustomers')->get();  
  $amountWithdrawn = SavingsBookletPages::where('haswithdrawn','true')->sum('balance');
        // dd($transactions);
        return view('content.susuUi.customerbooklet',compact('registercustomers', 'savingsBooklets', 'savingsBookletPages', 'transactions', 'customers', 'amountWithdrawn' ));
    }

    

 public function customerTransactionpost(Request $request) {
DB::beginTransaction();
try {

    $data = [
        'bookletId' => $request->bookletId,
        'customerid' => $request->customerid,
        'pagenum' => $request->pagenum,
        'boxid' => $request->boxid,
        'transactionDate' => $request->transactionDate,
        'depositamount' => $request->depositamount
    ];

   DB::table('transactions')->insert($data);
// 
 $savingsBookletPages =  DB::table('savings_booklet_pages')->where('customerid',$request->customerid)->where('bookletId',$request->bookletId)->where('pagenum', $request->pagenum)->first();
if(intval($request->boxid) == 31){
    if(isset($savingsBookletPages)){
        $totaldeposit = intval($savingsBookletPages->totaldeposit) +  intval($request->depositamount);
        $balance = (intval($savingsBookletPages->totaldeposit) +  intval($request->depositamount) ) -  intval($savingsBookletPages->profit);
           $datam = [
       'totaldeposit' => $totaldeposit,
       'balance' => $balance,
       'isfull' => 'true',
       'updated_at' => now()
        ];
       
        DB::table('savings_booklet_pages')->where('customerid',$request->customerid)->where('bookletId',$request->bookletId)->where('pagenum', $request->pagenum)->update($datam);
           // dd($balance);
       }else{
           $bookletpages = [
               'bookletId' => $request->bookletId,
               'customerid'  => $request->customerid ,
               'pagenum' => $request->pagenum,
               'isfull' => 'true',
               'haswithdrawn' => 'false',
               'totaldeposit' => $request->depositamount,
               'balance'=> '0' ,
               'profit' => $request->depositamount
               ];
               SavingsBookletPages::create($bookletpages);
       }
}else{
if(isset($savingsBookletPages)){
 $totaldeposit = intval($savingsBookletPages->totaldeposit) +  intval($request->depositamount);
 $balance = (intval($savingsBookletPages->totaldeposit) +  intval($request->depositamount) ) -  intval($savingsBookletPages->profit);
    $datam = [
'totaldeposit' => $totaldeposit,
'balance' => $balance,
'updated_at' => now()
 ];

 DB::table('savings_booklet_pages')->where('customerid',$request->customerid)->where('bookletId',$request->bookletId)->where('pagenum', $request->pagenum)->update($datam);
    // dd($balance);
}else{
    $bookletpages = [
        'bookletId' => $request->bookletId,
        'customerid'  => $request->customerid ,
        'pagenum' => $request->pagenum,
        'isfull' => 'false',
        'haswithdrawn' => 'false',
        'totaldeposit' => $request->depositamount,
        'balance'=> '0' ,
        'profit' => $request->depositamount
        ];
        SavingsBookletPages::create($bookletpages);
}
} 
 
    DB::commit();
   
   return redirect('customerTransactionpostget/'.$request->customerid.'');
        // dd($request->all());
} catch (\Throwable $th) {
    //throw $th;
    Log::info($th);
}

       
    }

public function withdrawpage(Request $request) {
    DB::beginTransaction();
    try{
    //code...

$bookletId =  $request->bookletId;


  // Make sure $x is an integer
  $x = (int) $bookletId;

 
  // Loop from $x to 31 and perform insertions
  for ($i = $x; $i <= 31; $i++) {
      

    $data = [
        'bookletId' => $request->bookletId,
        'customerid' => $request->customerid,
        'pagenum' => $request->pagenum,
        'boxid' => $i,
        'transactionDate' => now(),
        'depositamount' => 0
    ];

   DB::table('transactions')->insert($data);
// 
 $savingsBookletPages =  DB::table('savings_booklet_pages')->where('customerid',$request->customerid)->where('bookletId',$request->bookletId)->where('pagenum', $request->pagenum)->first();
if(intval($i) == 31){
    if(isset($savingsBookletPages)){
        $totaldeposit = intval($savingsBookletPages->totaldeposit) +  0;
        $balance = (intval($savingsBookletPages->totaldeposit) +  0 ) -  intval($savingsBookletPages->profit);
           $datam = [
       'totaldeposit' => $totaldeposit,
       'balance' => $balance,
       'isfull' => 'true',
       'haswithdrawn' => 'true',
       'updated_at' => now()
        ];
       
        DB::table('savings_booklet_pages')->where('customerid',$request->customerid)->where('bookletId',$request->bookletId)->where('pagenum', $request->pagenum)->update($datam);
           // dd($balance);
       }else{
           $bookletpages = [
               'bookletId' => $request->bookletId,
               'customerid'  => $request->customerid ,
               'pagenum' => $request->pagenum,
               'isfull' => 'true',
               'haswithdrawn' => 'true',
               'totaldeposit' => 0,
               'balance'=> '0' ,
               'profit' => 0
               ];
               SavingsBookletPages::create($bookletpages);
       }
}else{
if(isset($savingsBookletPages)){
 $totaldeposit = intval($savingsBookletPages->totaldeposit) + 0;
 $balance = (intval($savingsBookletPages->totaldeposit) +  0 ) -  intval($savingsBookletPages->profit);
    $datam = [
'totaldeposit' => $totaldeposit,
'balance' => $balance,
'haswithdrawn' => 'true',
'updated_at' => now()
 ];

 DB::table('savings_booklet_pages')->where('customerid',$request->customerid)->where('bookletId',$request->bookletId)->where('pagenum', $request->pagenum)->update($datam);
    // dd($balance);
}else{
    $bookletpages = [
        'bookletId' => $request->bookletId,
        'customerid'  => $request->customerid ,
        'pagenum' => $request->pagenum,
        'isfull' => 'false',
        'haswithdrawn' => 'true',
        'totaldeposit' => 0,
        'balance'=> '0' ,
        'profit' => 0
        ];
        SavingsBookletPages::create($bookletpages);
}
} 
    }

    DB::commit();
   
    return redirect('customerTransactionpostget/'.$request->customerid.'');
}catch (\Throwable $th) {
    //throw $th;
    Log::info($th);
} 
}




public function  withdrawall(Request $request)
{ 

    DB::beginTransaction();
    try{
    //code...

$bookletId =  $request->bookletId;
$customerid = $request->customerid;
$allpages = DB::table('savings_booklet_pages')->where('customerid',$request->customerid)->where('bookletId',$request->bookletId)->where('haswithdrawn','false')->get();
if(!empty($allpages)){


foreach ($allpages as $allpage) {
  
  // Make sure $x is an integer
  $x = (int) $bookletId;

 
  // Loop from $x to 31 and perform insertions
  for ($i = $x; $i <= 31; $i++) {
      

    $data = [
        'bookletId' => $request->bookletId,
        'customerid' => $request->customerid,
        'pagenum' => $allpage->pagenum,
        'boxid' => $i,
        'transactionDate' => now(),
        'depositamount' => 0
    ];

   DB::table('transactions')->insert($data);
// 
 $savingsBookletPages =  DB::table('savings_booklet_pages')->where('customerid',$request->customerid)->where('bookletId',$request->bookletId)->where('pagenum', $allpage->pagenum)->first();
if(intval($i) == 31){
    if(isset($savingsBookletPages)){
        $totaldeposit = intval($savingsBookletPages->totaldeposit) +  0;
        $balance = (intval($savingsBookletPages->totaldeposit) +  0 ) -  intval($savingsBookletPages->profit);
           $datam = [
       'totaldeposit' => $totaldeposit,
       'balance' => $balance,
       'isfull' => 'true',
       'haswithdrawn' => 'true',
       'updated_at' => now()
        ];
       
        DB::table('savings_booklet_pages')->where('customerid',$request->customerid)->where('bookletId',$request->bookletId)->where('pagenum', $allpage->pagenum)->update($datam);
           // dd($balance);
       }else{
           $bookletpages = [
               'bookletId' => $request->bookletId,
               'customerid'  => $request->customerid ,
               'pagenum' => $allpage->pagenum,
               'isfull' => 'true',
               'haswithdrawn' => 'true',
               'totaldeposit' => 0,
               'balance'=> '0' ,
               'profit' => 0
               ];
               SavingsBookletPages::create($bookletpages);
       }
}else{
if(isset($savingsBookletPages)){
 $totaldeposit = intval($savingsBookletPages->totaldeposit) + 0;
 $balance = (intval($savingsBookletPages->totaldeposit) +  0 ) -  intval($savingsBookletPages->profit);
    $datam = [
'totaldeposit' => $totaldeposit,
'balance' => $balance,
'haswithdrawn' => 'true',
'updated_at' => now()
 ];

 DB::table('savings_booklet_pages')->where('customerid',$request->customerid)->where('bookletId',$request->bookletId)->where('pagenum', $request->pagenum)->update($datam);
    // dd($balance);
}else{
    $bookletpages = [
        'bookletId' => $request->bookletId,
        'customerid'  => $request->customerid ,
        'pagenum' => $request->pagenum,
        'isfull' => 'false',
        'haswithdrawn' => 'true',
        'totaldeposit' => 0,
        'balance'=> '0' ,
        'profit' => 0
        ];
        SavingsBookletPages::create($bookletpages);
}
} 
    }
    }
 DB::commit();
}
   
   
    return redirect('customerTransactionpostget/'.$request->customerid.'');
}catch (\Throwable $th) {
    //throw $th;
    Log::info($th);
} 

}


public function compareTotalDepositPerYear()
{
    // Retrieve the data from the database
    $data = DB::table('savings_booklet_pages')
        ->selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, SUM(totaldeposit) as total_deposit')
        ->groupBy('year', 'month')
        ->orderBy('year')
        ->orderBy('month')
        ->get();

    // Organize the data into the desired format
    $result = [];
    foreach ($data as $item) {
        $year = $item->year;
        $month = $item->month;
        $totalDeposit = (float) $item->total_deposit;

        // Add the data to the result array
        if (!isset($result[$year])) {
            $result[$year] = [
                'name' => $year,
                'data' => [],
            ];
        }

        // Fill in the gaps for months without data
        while (count($result[$year]['data']) < $month - 1) {
            $result[$year]['data'][] = 0;
        }

        // Set the data for the current month
        $result[$year]['data'][] = $totalDeposit;
    }

    // Convert any missing months at the end of each year to 0
    foreach ($result as &$yearData) {
        while (count($yearData['data']) < 12) {
            $yearData['data'][] = 0;
        }
    }

    // Convert the result array to JSON and return
    return response()->json(array_values($result));
}



public function expenses(){
    $allexpenses = Expenditure::where('type','fromprofit')->orwhere('type','fromexpense')->get();
    $payallexpenses = Expenditure::where('type','toprofit')->orwhere('type','toexpense')->get();
    $paidprofitexpense = Expenditure::where('type','toprofit')->sum('amount') ;
    $paidtocustomerbalance = Expenditure::where('type','toexpense')->sum('amount') ;

    $profitExps= Expenditure::where('type','fromprofit')->sum('amount') -  $paidprofitexpense;
    $takenfromcustomerbalance = Expenditure::where('type','fromexpense')->sum('amount') - $paidtocustomerbalance;

    $profit =  DB::table('savings_booklet_pages')->sum('profit');
    
    $profitLeft = ($profit -  $profitExps) ;
    $balance =  DB::table('savings_booklet_pages')->sum('balance');
    $customerbalanceleft = ($balance - $takenfromcustomerbalance);
    return view('content.susuUi.expenses',compact('allexpenses', 'profitExps', 'profitLeft', 'takenfromcustomerbalance', 'customerbalanceleft', 'payallexpenses'));
}


public function expensespost(Request $request){
    
// dd($request->all());
$expense = [
"type" => $request->type,
"amount" => $request->amount,
"date" => $request->date,
"reason" => $request->reason,
];

Expenditure::create($expense);


    return redirect()->route('expenses');
}







}
