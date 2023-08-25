@extends('layouts/contentNavbarLayout')

@section('title', 'Dashboard - Analytics')

@section('vendor-style')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/apex-charts/apex-charts.css')}}">
@endsection

@section('vendor-script')
<script src="{{asset('assets/vendor/libs/apex-charts/apexcharts.js')}}"></script>
@endsection

@section('page-script')
<script src="{{asset('assets/js/dashboards-analytics.js')}}"></script>
@endsection

@section('content')
<form action="{{ route('customerDepositpost')}}" method="post">
    @csrf
  <div class="px-2 mb-3">
       <label for="customer" class="form-label fs-5">Search Customer Name </label>
      <div class="input-group"> 
      <input required class="form-control" list="datalistOptions" id="customer" name="customer" placeholder="Type name...">  <span class="input-group-text"> <button type="submit" class="btn btn-primary px-2 mx-2 my-2">Search</button> </span>
      @if (!empty($customers))
         
      <datalist id="datalistOptions">
          @foreach ($customers as $customer)
          <option value="{{ $customer->cardnum }}"> Name: {{ $customer->newcustomer }} </option>
          @endforeach
      </datalist>
      @else
          <datalist id="datalistOptions">
        <option value="Name of customer">
        
      </datalist>
      @endif
        </div>
    </div>
   </form>

<div class="row">
  <div>
    <h4 class="fw-semibold d-block my-2 p-2 text-center"> {{ $registercustomers->newcustomer }} Booklet</h4>
    <div class="row">
        {{-- Total Deposit --}}
      <div class="col-lg-6 col-md-12 col-6 mb-4">
        <div class="card">
          <div class="card-body">
            <div class="card-title d-flex align-items-start justify-content-between">
              <div class="avatar flex-shrink-0">
                <img src="{{asset('assets/img/icons/unicons/chart-success.png')}}" alt="chart success" class="rounded">
              </div>
              <div class="dropdown">
                <button class="btn p-0" type="button" id="cardOpt3" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="bx bx-dots-vertical-rounded"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                  <a class="dropdown-item" href="javascript:void(0);">View All</a>
                  <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                </div>
              </div>
            </div>
            <span class="fw-semibold d-block mb-1">Total Deposit</span>
            <h3 class="card-title mb-2">
              @if (!empty($savingsBookletPages))
                @php
                
                  $depositssum = 0;
                foreach ($savingsBookletPages as $value) {
                      $depositssum += $value->totaldeposit;
                       }
                @endphp
              GHS {{  $depositssum }}
              @else
                {{  '-' }}
              @endif
            </h3>
            {{-- <small class="text-success fw-semibold"><i class='bx bx-up-arrow-alt'></i> 66%</small> --}}
          </div>
        </div>
      </div>
      <div class="col-lg-6 col-md-12 col-6 mb-4">
        <div class="card">
          <div class="card-body">
            <div class="card-title d-flex align-items-start justify-content-between">
              <div class="avatar flex-shrink-0">
                <img src="{{asset('assets/img/icons/unicons/chart.png')}}" alt="Credit Card" class="rounded">
              </div>
              <div class="dropdown">
                <button class="btn p-0" type="button" id="cardOpt6" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="bx bx-dots-vertical-rounded"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt6">
                  <a class="dropdown-item" href="javascript:void(0);">View All</a>
                  <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                </div>
              </div>
            </div>
            <span>Balance</span>
            <h3 class="card-title text-nowrap mb-1"> 
               @if (!empty($savingsBookletPages))
              @php
              
                $depositssum = 0;
              foreach ($savingsBookletPages as $value) {
                    $depositssum += $value->balance;
                     }
              @endphp
            GHS {{  $depositssum - $amountWithdrawn }}
            @else
              {{  '-' }}
            @endif
          </h3>
            {{-- <small class="text-success fw-semibold"><i class='bx bx-up-arrow-alt'></i> 5%</small> --}}
          </div>
        </div>
      </div>
{{-- Total Withdrawal --}}
<div class="col-6 mb-4">
    <div class="card">
      <div class="card-body">
        <div class="card-title d-flex align-items-start justify-content-between">
          <div class="avatar flex-shrink-0">
            <img src="{{asset('assets/img/icons/unicons/paypal.png')}}" alt="Credit Card" class="rounded">
          </div>
          <div class="dropdown">
            <button class="btn p-0" type="button" id="cardOpt4" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="bx bx-dots-vertical-rounded"></i>
            </button>
            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt4">
              <a class="dropdown-item" href="javascript:void(0);">View All</a>
            </div>
          </div>
        </div>
        <span class="d-block mb-1">Total Withdrawal</span>
        <h3 class="card-title text-nowrap mb-2">GHS {{ $amountWithdrawn }}</h3>
        {{-- <small class="text-danger fw-semibold"><i class='bx bx-down-arrow-alt'></i> -14.82%</small> --}}
      </div>
    </div>
  </div>
  {{-- Company Profit --}}
  <div class="col-6 mb-4">
    <div class="card">
      <div class="card-body">
        <div class="card-title d-flex align-items-start justify-content-between">
          <div class="avatar flex-shrink-0">
            <img src="{{asset('assets/img/icons/unicons/cc-primary.png')}}" alt="Credit Card" class="rounded">
          </div>
          <div class="dropdown">
            <button class="btn p-0" type="button" id="cardOpt1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="bx bx-dots-vertical-rounded"></i>
            </button>
            <div class="dropdown-menu" aria-labelledby="cardOpt1">
              <a class="dropdown-item" href="javascript:void(0);">View All</a>
              <a class="dropdown-item" href="javascript:void(0);">Delete</a>
            </div>
          </div>
        </div>
        <span class="fw-semibold d-block mb-1">Company Profit</span>
        <h3 class="card-title mb-2"> 
          @if (!empty($savingsBookletPages))
          @php
          
            $profitsum = 0;
          foreach ($savingsBookletPages as $value) {
                $profitsum += $value->profit;
                 }
          @endphp
        GHS {{  $profitsum  }}
        @else
          {{  '-' }}
        @endif
        </h3>
        {{-- <small class="text-success fw-semibold"><i class='bx bx-up-arrow-alt'></i> +28.14%</small> --}}
      </div>
    </div>
  </div>
    </div>
  </div>
   
<!-- customer booklet pages -->
<div class="card m-2">
    
    <div class="row justify-content-center align-items-center  g-2">
      <div class="col align-self-start"><h5 class="card-header">Transactions</h5></div>
      <div class="col" >
        <form action="{{ route('withdrawall') }}" method="post"  style="float: right">
        @csrf
        <input type="hidden" name="customerid" value="{{ $savingsBooklets->customerid }}">
          <input type="hidden" name="bookletId" value="{{  $savingsBooklets->bookletId }}">
      <button type="submit" class="btn btn-danger px-2">Withdraw Everything</button>
    </form></div>
      
    </div>
    <div class="container" style="max-height: 600px; overflow-y: auto;">
      <div class="table-responsive mt-2 ">
      

    <!-- Loop through each page -->
    @for ($pageIndex = 0; $pageIndex < $savingsBooklets->maxpages; $pageIndex++)
    <div class="col-md-12">
        <div class="card m-2">
          
            <div class="card-header">
              <div class="row justify-content-center align-items-center g-2 bg-primary mx-2 px-2 ">
                <div class="col"><h5 class="card-header text-white">Page No. {{ $pageIndex + 1 }}</h5></div>
                <div class="col"><h6 class="card-header text-white">
                  @foreach ($savingsBookletPages as $savingsBookletPage)
                  @if (($savingsBookletPage->pagenum == $pageIndex + 1 ))
                  <small>Balance: GHS {{ $savingsBookletPage->balance }}</small> 
                  @endif
                @endforeach
                  </h6>
              </div>
              <div class="col"><h6 class="card-header text-white">
                @foreach ($savingsBookletPages as $savingsBookletPage)
                @if (($savingsBookletPage->pagenum == $pageIndex + 1 ))
                <small>Total-deposit: GHS {{ $savingsBookletPage->totaldeposit }}</small> 
                @endif
              @endforeach
                </h6>
            </div>
<div class="col">
  <h6 class="card-header text-white">
                @foreach ($savingsBookletPages as $savingsBookletPage)
                @if (($savingsBookletPage->pagenum == $pageIndex + 1 ))
                <small>Profit: GHS {{ $savingsBookletPage->profit }}</small>
                @endif
              @endforeach
                </h6>
            </div>
            
                <div class="col">
                  <form action="{{ route('withdrawpage') }}" method="post"  style="float: right">
                    @csrf
                    <input type="hidden" name="customerid" value="{{ $savingsBooklets->customerid }}">
                    <input type="hidden" name="pagenum" value="{{ $pageIndex + 1 }}">
                    <input type="hidden" name="bookletId" value="{{  $savingsBooklets->bookletId }}">
                    @foreach ($savingsBookletPages as $savingsBookletPage)
                      @if (($savingsBookletPage->pagenum == $pageIndex + 1 ) && $savingsBookletPage->haswithdrawn == 'true')
                      <button type="button" class="btn btn-light" disabled> Money Withdrawn </button>
                      @elseif(($savingsBookletPage->pagenum == $pageIndex + 1 ) && $savingsBookletPage->haswithdrawn == 'false')
                      <button type="submit" class="btn btn-dark"> Withdraw </button>
                      @endif
                    @endforeach
                  
                </form>
                </div>
               </div>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Date</th>
                            <th>Deposit Amount</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Loop through each box id on the page -->
                        @for ($boxId = 1; $boxId <= 31; $boxId++)
                        @php
                        $foundTransaction = false;
                        $transactionDate = null;
                        $depositAmount = null;
                        @endphp

                        <!-- Loop through transactions to find matching transaction -->
                        @foreach ($transactions as $transaction)
                        @if ($transaction->pagenum == $pageIndex + 1 && $transaction->boxid == $boxId)
                        @php
                        $foundTransaction = true;
                        $transactionDate = $transaction->transactionDate;
                        $depositAmount = $transaction->depositamount;
                        @endphp
                        @break
                        @endif
                        @endforeach
                        
                        <tr>
                          <form action="{{ route('customerTransactionpost') }}" method="post">
                            @csrf
                            <td>{{ $boxId }}</td>
                            <td>
                              @if ($foundTransaction)
                                  {{\Carbon\Carbon::parse($transactionDate)->format('F j, Y g:i A') }}
                              @else
                              <input required class="form-control" name="transactionDate" type="datetime-local" />
                              @endif
                          </td>
                          <td> 
                            @if ($foundTransaction)
                            {{ $depositAmount }}
                            @else
                          <input required class="form-control" type="text" placeholder="eg:amount" name="depositamount"/>
                            @endif
                          </td>
                            <td>
                                @if ($foundTransaction)
                                <button class="btn btn-primary px-2" disabled>Paid</button>
                                @else
                                 <input type="hidden" name="pagenum" value="{{ $pageIndex + 1 }}">
                                    <input type="hidden" name="boxid" value="{{ $boxId }}">
                                    <input type="hidden" name="bookletId" value="{{ $savingsBooklets->bookletId }}">
                                    <input type="hidden" name="customerid" value="{{ $savingsBooklets->customerid }}">
                                    <button type="submit" class="btn btn-success px-2">Save</button>
                                
                                @endif
                            </td>
                          </form>
                        </tr>
                        @endfor
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    @endfor
  </div>
</div>

    {{-- @for ($i = 0; $i < $savingsBooklets->maxpages; $i++)
    @php
    $foundTransaction = false; // Set the flag since a matching transaction was found
    $foundTransactionCount = 0;
@endphp
    <div class="table-responsive mt-2 ">
      <div class="row justify-content-center align-items-center g-2 bg-primary mx-2 px-2 ">
        <div class="col"><h5 class="card-header text-white">Page No. {{ $i + 1 }}</h5></div>
        <div class="col">
          <form action="{{ route('withdrawpage') }}" method="post"  style="float: right">
            @csrf
          <button type="submit" class="btn btn-dark ">Withdraw </button>
        </form>
        </div>
       
      </div>
        
        
        <table class="table">
            <thead>
              <tr>
                <th>#</th>
                <th>Date</th>
                <th>Deposit Amount</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody class="table-border-bottom">
               
                @php
    $lastBoxId = 0; // Initialize the last boxid variable
@endphp
                @for ($ii = 1; $ii < 32; $ii++)
                @if (!empty($transactions))
               
   @foreach ($transactions as $key => $transaction)
@php
    
    $boxidValue = intval($transaction->boxid);

    $pgnum = intval($transaction->pagenum);
@endphp
                    @if ($boxidValue == $ii && $pgnum == ($i + 1 ))
                    @php
                    $foundTransaction = true;
               $foundTransactionCount = count($transactions);   
   
           if ($foundTransaction) {
               $lastBoxId = $ii; // Update the last boxid if a transaction is found
           }
             @endphp
                    <tr> 
                        <form action="{{ route('customerTransactionpost') }}" method="post">
                            @csrf
                            <input type="hidden" name="pagenum" value="{{ $i + 1 }}">
        <input type="hidden" name="bookletId" value="{{ $savingsBooklets->bookletId }}">
        <input type="hidden" name="customerid" value="{{ $savingsBooklets->customerid }}">
                        <td> <input readonly class="form-control" type="text" name="boxid" value="{{ $ii }}" />    </td>
                        <td>{{\Carbon\Carbon::parse($transaction->transactionDate)->format('F j, Y g:i A') }} </td>
                        <td>{{$transaction->depositamount}} </td>
                        <td>  <button type="button" disabled class="btn btn-primary px-2 ">Paid  pagenumDB : {{ $pgnum }} => boxidDB : {{ $boxidValue }} =>   ii: {{ $ii }} => counttransactions: {{$foundTransactionCount  }}</button> </td>
                   </form>
                 </tr>
                  
                    @endif

   @endforeach

@if ($foundTransaction == true  && ($ii > $foundTransactionCount) )

   <tr> 
    <form action="{{ route('customerTransactionpost') }}" method="post">
        @csrf
        <input type="hidden" name="pagenum" value="{{ $i + 1 }}">
<input type="hidden" name="bookletId" value="{{ $savingsBooklets->bookletId }}">
<input type="hidden" name="customerid" value="{{ $savingsBooklets->customerid }}">
    <td>  <input readonly class="form-control" type="text" name="boxid" value="{{ $ii }}" />  </td>
    <td> <input required class="form-control" name="transactionDate" type="datetime-local" /> </td>
    <td> <input required class="form-control" type="text" placeholder="eg:amount" name="depositamount"/> </td>
    <td>  <button type="submit" class="btn btn-success px-2 ">Saves</button> </td>
</form> 
</tr> 
 
@elseif ($foundTransaction == false  )
<tr> 
    <form action="{{ route('customerTransactionpost') }}" method="post">
        @csrf
        <input type="hidden" name="pagenum" value="{{ $i + 1 }}">
<input type="hidden" name="bookletId" value="{{ $savingsBooklets->bookletId }}">
<input type="hidden" name="customerid" value="{{ $savingsBooklets->customerid }}">
    <td>  <input readonly class="form-control" type="text" name="boxid" value="{{ $ii }}" />  </td>
    <td> <input required class="form-control" name="transactionDate" type="datetime-local" /> </td>
    <td> <input required class="form-control" type="text" placeholder="eg:amount" name="depositamount"/> </td>
    <td>  <button type="submit" class="btn btn-success px-2 ">Savee</button> </td>
</form> 
</tr> 


@endif
  
   @else
                <tr> 
                    <form action="{{ route('customerTransactionpost') }}" method="post">
                        @csrf
                        <input type="hidden" name="pagenum" value="{{ $i + 1 }}">
        <input type="hidden" name="bookletId" value="{{ $savingsBooklets->bookletId }}">
        <input type="hidden" name="customerid" value="{{ $savingsBooklets->customerid }}">
                    <td> <input readonly class="form-control" type="text" name="boxid" value="{{ $ii + 1 }} ee" />   </td>
                    <td><input required class="form-control" name="transactionDate" type="datetime-local"/> </td>
                    <td> <input required class="form-control" type="text" placeholder="eg:amount" name="depositamount"  /> </td>
                    <td>  <button type="submit" class="btn btn-success px-2 ">Save</button> </td>
                </form>
            </tr>
                @endif
                

                @endfor
                 
            
            </tbody>
          </table>
    </div> 
       @endfor
  </div> --}}
</div>
  <!--/ customer booklet pages -->
  
@endsection

{{-- ============================================================================================================== --}}

