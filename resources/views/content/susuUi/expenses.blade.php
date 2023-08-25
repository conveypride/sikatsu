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
<div class="row">

  <div class="">
    <div class="row">
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
            <span class="fw-semibold d-block m-1">Profit Expenditure</span>
            <h3 class="card-title mb-2">¢{{ $profitExps }}</h3>
            {{-- <small class="{{ $activesucess  == 'true' ? "text-success" : "text-danger"}}   fw-semibold"><i class='bx bx-up-arrow-alt'></i> {{ $percentageofactiveusers }}%</small> --}}
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
            <span>Profit Left</span>
            <h3 class="card-title text-nowrap m-1"> ¢{{ $profitLeft }}</h3>
            {{-- <small class="{{ $activesucess  == 'true' ? "text-danger" : "text-success"}}  fw-semibold"><i class='bx bx-up-arrow-alt'></i> {{ $percentageofinactiveusers }}%</small> --}}
          </div>
        </div>
      </div>
{{-- payments --}}
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
        <span class="d-block m-1">Amount Taken From Customers Balance</span>
        <h3 class="card-title text-nowrap mb-2">¢{{ $takenfromcustomerbalance }}</h3>
        {{-- <small class="text-danger fw-semibold"><i class='bx bx-down-arrow-alt'></i> -14.82%</small> --}}
      </div>
    </div>
  </div>
  {{-- No.Books Sold --}}
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
        <span class="fw-semibold d-block m-1">Customers Balance Left</span>
        <h3 class="card-title mb-2">¢{{ $customerbalanceleft }}</h3>
        {{-- <small class="text-success fw-semibold"><i class='bx bx-up-arrow-alt'></i> +28.14%</small> --}}
      </div>
    </div>
  </div>
    </div>
  </div>
  <!-- Add Expenses -->
  <div class="col-12  order-2 order-md-3 order-lg-2 mb-4">
    <form action="{{ route('expensespost') }}" method="post">
        @csrf
    <div class="card">
      <div class="row row-bordered m-2 g-0">
        <div class="col">
          <h5 class="card-header m-0 me-2 pb-3">Add Expenses</h5>
         
           <div class="mb-3 row px-2"> 
            <div class="col-md-10">
                <label for="type" class="form-label">Selectn Expense Type</label>
                <select class="form-select" id="type"name="type" aria-label="Default type">
                  <option value="fromprofit">From Profit</option>
                  <option value="fromexpense">From Customer Balance</option> 
                </select>
            </div>
          </div>
 <div class="mb-3 row px-2">
            <label for="amount" class=" col-form-label">Amount</label>
            <div class="col-md-10">
              <input required class="form-control" type="number" name="amount" id="amount" placeholder="GHS..." />
            </div>
          </div>
        
          <div class="mb-3 row px-2">
            <label for="amount" class="col-form-label">Date</label>
            <div class="col-md-10">
              <input required class="form-control" name="date" type="datetime-local" id="date" />
            </div>
          </div>

          <label for="reason" class="form-label">Comment For Expense</label>
          <textarea required class="form-control" id="reason" rows="3" name="reason"></textarea>

          <button type="submit" class="btn btn-primary px-2 mx-2 my-2">Submit</button>

        </div>
        
      </div>
    </div>
  </div>
</form>

</div>
 
<!-- Basic Bootstrap Table -->
<div style="max-height: 600px; overflow-y: auto;">
    <div class="table-responsive  ">
<div class="card m-2">
    <h5 class="card-header">All Expenses</h5>
    <div class="table-responsive text-nowrap">
      <table class="table">
        <thead>
          <tr>
            <th>No.</th>
            <th>Type</th>
            <th>Amount</th>
            <th>Reason</th>
            <th>Date</th>
          </tr>
        </thead>
        <tbody class="table-border-bottom-0">
            @if (!empty($allexpenses))
            @foreach ($allexpenses as $allexpense)
                 <tr>
                <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>#{{ $allexpense->id }}</strong></td>
                <td>
                    @if ($allexpense->type == 'fromprofit' )
                        {{ 'From Profit' }}
                    @elseif ($allexpense->type == 'fromexpense' )
                        {{ 'From Expense' }}
                    @endif
                    {{-- {{ $customer->cardnum }} --}}
                
                </td> 
                <td>
                  GHS {{ $allexpense->amount }}.00
                </td>
                <td>
                    {{ $allexpense->reason }}
                </td>
                <td><span class="badge bg-label-primary me-1">{{\Carbon\Carbon::parse($allexpense->date)->format('F j, Y g:i A')  }}</span></td>
               
              </tr>
              @endforeach
            @else
            <tr>
            <td>
                No expenses...
            </td> 
            </tr>
            
            @endif
            
        
        </tbody>
      </table>
    </div>
  </div>
 </div>
  </div>
  
{{--========================== payback expense================================ --}}
<div class="card border-primary mt-3">
  <div class="card-body">
    <h4 class="card-title text-danger">Payback Expenses</h4>
    {{-- <p class="card-text">Text</p> --}}
 <!-- Add Expenses -->
 <div class="col-12  order-2 order-md-3 order-lg-2 mb-4">
    <form action="{{ route('expensespost') }}" method="post">
        @csrf
    <div class="card">
      <div class="row row-bordered m-2 g-0">
        <div class="col">
          <h5 class="card-header m-0 me-2 pb-3"> Add  Expenses Payback</h5>
         
           <div class="mb-3 row px-2"> 
            <div class="col-md-10">
                <label for="type" class="form-label">Selectn Payback Type</label>
                <select class="form-select" id="type"name="type" aria-label="Default type">
                  <option value="toprofit">To Profit</option>
                  <option value="toexpense">To Customer Balance</option> 
                </select>
            </div>
          </div>
 <div class="mb-3 row px-2">
            <label for="amount" class=" col-form-label">Amount</label>
            <div class="col-md-10">
              <input required class="form-control" type="number" name="amount" id="amount" placeholder="GHS..." />
            </div>
          </div>
        
          <div class="mb-3 row px-2">
            <label for="amount" class="col-form-label">Date</label>
            <div class="col-md-10">
              <input required class="form-control" name="date" type="datetime-local" id="date" />
            </div>
          </div>

          <label for="reason" class="form-label">Comment For Expense</label>
          <textarea required class="form-control" id="reason" rows="3" name="reason"></textarea>

          <button type="submit" class="btn btn-primary px-2 mx-2 my-2">Submit</button>

        </div>
        
      </div>
    </div>
  </div>
</form>

</div>
 
<!-- Basic Bootstrap Table -->
<div style="max-height: 600px; overflow-y: auto;">
    <div class="table-responsive  ">
<div class="card m-2">
    <h5 class="card-header">All Paid Amount</h5>
    <div class="table-responsive text-nowrap">
      <table class="table">
        <thead>
          <tr>
            <th>No.</th>
            <th>Type</th>
            <th>Amount</th>
            <th>Reason</th>
            <th>Date</th>
          </tr>
        </thead>
        <tbody class="table-border-bottom-0">
            @if (!empty($payallexpenses))
            @foreach ($payallexpenses as $payallexpense)
                 <tr>
                <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>#</strong></td>
                <td>
                    @if ($payallexpense->type == 'toprofit' )
                        {{ 'To Profit' }}
                    @elseif ($payallexpense->type == 'toexpense' )
                        {{ 'To Expense' }}
                    @endif
                    {{-- {{ $customer->cardnum }} --}}
                
                </td> 
                <td>
                  GHS {{ $payallexpense->amount }}.00
                </td>
                <td>
                    {{ $payallexpense->reason }}
                </td>
                <td><span class="badge bg-label-primary me-1">{{\Carbon\Carbon::parse($payallexpense->date)->format('F j, Y g:i A')  }}</span></td>
               
              </tr>
              @endforeach
            @else
            <tr>
            <td>
                No payback...
            </td> 
            </tr>
            
            @endif
            
        
        </tbody>
      </table>
    </div>
  </div>
 </div>
  </div>
  

  </div>
</div>

  <!--/ Basic Bootstrap Table -->
  
@endsection
