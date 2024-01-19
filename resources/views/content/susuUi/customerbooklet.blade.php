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
            <h3 class="card-title mb-2" >
              @if (!empty($savingsBookletPages))
                @php
                
                  $depositssum = 0;
                foreach ($savingsBookletPages as $value) {
                      $depositssum += $value->totaldeposit;
                       }
                @endphp
              GHS <span id="depost"> {{  $depositssum }} </span>
              @else
              <span id="depost"> {{  '-' }}</span> 
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
            <h3 class="card-title text-nowrap mb-1" > 
               @if (!empty($savingsBookletPages))
              @php
              
                   $profitsum = 0;
foreach ($savingsBookletPages as $value) {
    $profitsum += $value->profit;
     }

     $bal = $depositssum - ($amountWithdrawn + $profitsum);
              @endphp

            GHS  <span id="balancee">{{  $bal }}</span>
            @else
            <span id="balancee"> {{  '-' }}</span> 
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
        <h3 class="card-title text-nowrap mb-2">GHS <span id="withdrawn"> {{ $amountWithdrawn }} </span></h3>
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
         
        GHS <span id="profitsumm">{{  $profitsum  }} </span> 
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
  @if(session('success'))
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    Success:  {{ session('success') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
@endif

@if(session('error'))
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
     Error:  {{ session('error') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
@endif

<!-- customer booklet pages -->
<div class="card m-2">
    
    <div class="row justify-content-center align-items-center  g-2">
      <div class="col align-self-start"><h5 class="card-header">Transactions</h5></div>
      <div class="col">
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#bulkmoney">Deposit Bulk</button>
      </div>
      <div class="col">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#increaseModal"> Increase Pages</button>
      </div>
      <div class="col">
        <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#exampleModal">Withdraw Money</button>
      </div>



      {{-- <div class="col" >
        <form action="{{ route('withdrawall') }}" method="post"  style="float: right">
        @csrf
        <input type="hidden" name="customerid" value="{{ $savingsBooklets->customerid }}">
          <input type="hidden" name="bookletId" value="{{  $savingsBooklets->bookletId }}">

      <button type="submit" class="btn btn-danger px-2">Withdraw Everything</button>
    </form></div> --}}
      
    </div>
    <div class="container" style="max-height: 600px; overflow-y: auto;">
      <div class="table-responsive mt-2 ">
      

    <!-- Loop through each page -->
    @for ($pageIndex = 0; $pageIndex < $savingsBooklets->maxpages; $pageIndex++)
    <div class="col-md-12">
        <div class="card m-2 iimi">
          
            <div class="card-header">
              <div class="row justify-content-center align-items-center g-2 bg-primary mx-2 px-2 ">
                <div class="col"><h5 class="card-header text-white">Page No. {{ $pageIndex + 1 }}</h5></div>
                <input type="hidden" name="pagenumm" value="{{ $pageIndex + 1 }}">
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
                  <form action="#" style="float: right">
                    @csrf
                    <input type="hidden" name="customerid" value="{{ $savingsBooklets->customerid }}">
                    <input type="hidden" name="pagenum" value="{{ $pageIndex + 1 }}">
                    <input type="hidden" name="bookletId" value="{{  $savingsBooklets->bookletId }}">
                    {{-- @foreach ($savingsBookletPages as $savingsBookletPage)
                      @if (($savingsBookletPage->pagenum == $pageIndex + 1 ) && $savingsBookletPage->haswithdrawn == 'true')
                      <button type="button" class="btn btn-light" disabled> Money Withdrawn </button>
                      @elseif(($s avingsBookletPage->pagenum == $pageIndex + 1 ) && $savingsBookletPage->haswithdrawn == 'false')
                      
                      @endif
                    @endforeach
                   --}}
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
                            <th>Status</th>
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
                        {{-- customerTransactionpost --}}
                        <tr class="myFormContainer">
                         <td>
                          <input  class="form-control" type="text" readonly  name="editboxid" value="{{ $boxId}}"/>
                        </td>
                            <td>
                              @if ($foundTransaction)
                                  {{-- {{\Carbon\Carbon::parse($transactionDate)->format('F j, Y g:i A') }} --}}
                                  <input required class="form-control" name="edittransactionDate" type="datetime-local" readonly value="{{ $transactionDate }}" />
                              @else
                              <input required class="form-control" name="transactionDate" type="datetime-local" />
                              @endif
                          </td>
                          <td> 
                            @if ($foundTransaction)
                            <input  class="form-control" type="text" readonly  name="edidepositamount" value=" {{ $depositAmount }}"/>
                            @else
                          <input required class="form-control" type="text" placeholder="eg:amount" name="depositamount"/>
                            @endif
                          </td>
                            <td>
                                @if ($foundTransaction)
                                <button class="btn btn-primary px-2 paid" disabled >Paid</button>
                                @else
                                 <input type="hidden" name="pagenum" value="{{ $pageIndex + 1 }}">
                                    <input type="hidden" name="boxid" value="{{ $boxId }}">
                                    <input type="hidden" name="bookletId" value="{{ $savingsBooklets->bookletId }}">
                                    <input type="hidden" name="customerid" value="{{ $savingsBooklets->customerid }}">
                                    <button type="button" class="btn btn-success px-2 submitFormButton" >Save</button>
                                
                                @endif
                            </td>
                            <td>
                              @if($foundTransaction)
                              <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                                <div class="dropdown-menu">
                                  <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#edidtmodel" ><i class="bx bx-edit-alt me-1"></i> Edit</a>
                                  {{-- <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-trash me-1"></i> Delete</a> --}}
                                </div>
                              </div>
                              @else
                                 {{ "-" }}
                                @endif
                            </td>
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

    
</div>


{{-- edit amount model --}}
<div class="modal fade" id="edidtmodel" tabindex="-1" aria-labelledby="edidtmodelLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="edidtmodelLabel">Edit Transaction</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="{{ route('edittransactions') }}" method="post">
        @csrf
        <div class="modal-body">
          <p>
           PageNum: <input type="text" class="form-control" readonly name="pagenumid" id="pagenumid">
          </p>
          
<p>
 Book-Id: <input type="text" class="form-control" readonly name="bookletidedit" id="bookletidedit" value="{{ $savingsBooklets->bookletId }}">
</p>
    <p>
    Customer-Id  <input type="text" class="form-control" readonly name="customeridedit" id="customeridedit" value="{{ $savingsBooklets->customerid }}">  
    </p>   
         
          <div class="row">
<div class="col-4">
  <label for="boxidedit" class="col-form-label">#</label>
   <input type="text" class="form-control" readonly name="boxidedit" id="boxidedit">
</div>

{{-- <div class="col-4">
  <label for="datetimeedit" class="col-form-label">Date:</label>
  <input type="datetime-local" class="form-control" name="datetimeedit" id="datetimeedit">
</div> --}}

<div class="col-4">
  <label for="amountedit" class="col-form-label">Deposit Amount:</label>
  <input type="text" class="form-control" name="amountedit" id="amountedit">
</div>
 </div>
 <input type="hidden" class="form-control" name="oldamount" id="oldamount">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
    </form>
    </div>
  </div>
</div>






<!-- increaseModal Modal -->
<div class="modal fade" id="increaseModal" tabindex="-1" aria-labelledby="increaseModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="{{ route('increasePage') }} " method="post">
        @csrf
      <div class="modal-header">
        <h5 class="modal-title" id="increaseModalLabel">Increase Page Number</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">

        <div class="col-12">  
            <label for="pagesNum">Number Of Pages</label>
            <input type="hidden" name="pagesNuminit" id="pagesNuminit" class="form-control" value="{{ $savingsBooklets->maxpages }}">
       <input type="number" name="pagesNum" id="pagesNum" class="form-control" value="{{ $savingsBooklets->maxpages }}">  
        </div>

        </div>
      </div>
      <div class="modal-footer">
        <input type="hidden" name="customeridds" value="{{ $savingsBooklets->customerid }}">
        <input type="hidden" name="bookletIdds" value="{{  $savingsBooklets->bookletId }}">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Increase</button>
      </div>
</form>
    </div>
  </div>
</div>

{{-- bulkmoney --}}
<div class="modal fade" id="bulkmoney" tabindex="-1" aria-labelledby="bulkmoneyLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="{{ route('addBulkDeposit') }}" method="post">
        @csrf
      <div class="modal-header">
        <h5 class="modal-title" id="bulkmoneyLabel">Enter Amount To Deposit</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
<div class="col-6"> 
  <h5 class="fw-bold">Rate of Deposit: <input type="text" class="form-control"  name="rate" id="rate">  </h5>
    </div>

    <div class="col-6"> 
  <h5 class="fw-bold">Amount To Deposit: <input type="text" class="form-control"  name="amounttoDeposit" id="amounttoDeposit">  </h5>
    </div>

        </div>
      </div>
      <div class="modal-footer">
        <input type="hidden" name="customeridd" value="{{ $savingsBooklets->customerid }}">
        <input type="hidden" name="bookletIdd" value="{{  $savingsBooklets->bookletId }}">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Deposit</button>
      </div>
</form>
    </div>
  </div>
</div>
{{-- bulkmoney --}}


<!-- partial withdrawal Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="{{ route('withdrawpage') }}" method="post">
        @csrf
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Enter Amount To Withdraw</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
<div class="col-12"> 
  <h5 class="fw-bold">Max. Amount You can Withdraw: <input type="text" class="form-control" readonly name="bal" id="bal" value="{{ $bal }}">  </h5>
   
       </div>

        <div class="col-12">  
            <label for="amounttowithdraw">Amount To Withdraw</label>
       <input type="number" name="amounttowithdraw" id="amounttowithdraw" class="form-control">  
        </div>

        </div>
      </div>
      <div class="modal-footer">
        <input type="hidden" name="customeridd" value="{{ $savingsBooklets->customerid }}">
        <input type="hidden" name="bookletIdd" value="{{  $savingsBooklets->bookletId }}">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Withdraw</button>
      </div>
</form>
    </div>
  </div>
</div>

  <!--/ customer booklet pages -->
  @section('customscript')
  <script>
    // 
    var submitButtons = document.querySelectorAll(".submitFormButton");
   
    submitButtons.forEach(function (submitButton) {
     
      submitButton.addEventListener("click", function (e) {
       e.preventDefault();
       var totaldeposit = document.querySelector('#depost').textContent;
       var balance = document.querySelector('#balancee').textContent;
       var profit = document.querySelector('#profitsumm').textContent;
       var withdrawn = document.querySelector('#withdrawn').textContent;


                var button = this;
                var form = button.closest(".myFormContainer"); // Find the closest form container
                var depositAmount = form.querySelector("[name='depositamount']").value;
                var transactionDate = form.querySelector("[name='transactionDate']").value;
                var pageNum = form.querySelector("[name='pagenum']").value;
                var boxId = form.querySelector("[name='boxid']").value;
                var bookletId = form.querySelector("[name='bookletId']").value;
                var customerId = form.querySelector("[name='customerid']").value;

                // Prepare data as JSON
                var jsonData = {
                    depositamount: depositAmount,
                    transactionDate: transactionDate,
                    pagenum: pageNum,
                    boxid: boxId,
                    bookletId: bookletId,
                    customerid: customerId
                };

                // console.log(totaldeposit);
   if(totaldeposit != '-'){
  totaldeposit = Number(totaldeposit) + Number(depositAmount) ;
}else{
  totaldeposit = '-'
}

if(balance != '-'){
  balance = Number(balance) + Number(depositAmount) ;
}else{
  balance = '-'
}

                
                button.innerHTML = "Loading..."; // Show loading state
 
                // Get CSRF token from meta tag
                var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                // Send AJAX request
                var xhr = new XMLHttpRequest();
                xhr.open("POST", "customerTransactionpost", true);
                xhr.setRequestHeader('X-CSRF-TOKEN', csrfToken);
                xhr.setRequestHeader('Content-Type', 'application/json');
                xhr.onreadystatechange = function () {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200 ) {
                            button.innerHTML = "Paid";
                           
                            button.classList.add('btn-primary');
                            button.classList.add('disabled');
                            button.closest(".myFormContainer").querySelector("[name='transactionDate']").setAttribute('disabled', 'disabled');
                            button.closest(".myFormContainer").querySelector("[name='depositamount']").setAttribute('disabled', 'disabled');
                            button.classList.remove('btn-success');
                            button.classList.remove('submitFormButton');
                             // Change button text to "Paid"
                             document.querySelector('#depost').innerHTML = totaldeposit;
                             document.querySelector('#balancee').innerHTML = (totaldeposit - (Number(withdrawn) + Number(profit)) );
                             document.querySelector('#bal').value = (totaldeposit - (Number(withdrawn) + Number(profit)));
                        
                        } else {
                        //  console.log(xhr.response)
                            button.innerHTML = "Retry";
                            button.classList.remove('btn-success');

                            button.classList.add('btn-danger');
                            button.classList.add('submitFormButton');
                            button.closest(".myFormContainer").querySelector("[name='transactionDate']").setAttribute('disabled', 'false');
                            button.closest(".myFormContainer").querySelector("[name='depositamount']").setAttribute('disabled', 'false');
                            
                        }
                    }
                };
                xhr.send(JSON.stringify(jsonData)); 
            });
          });


// =============================edit amount=====================================
var edidtmodel = document.getElementById('edidtmodel')
edidtmodel.addEventListener('show.bs.modal', function (event) {
  // alert('hi');
  // Button that triggered the modal
  var button = event.relatedTarget
  // Extract info from data-bs-* attributes
  // var recipient = button.getAttribute('data-bs-whatever');
 var datee =  button.closest(".myFormContainer").querySelector("[name='edittransactionDate']").value;
 var depositamountt = button.closest(".myFormContainer").querySelector("[name='edidepositamount']").value;
 var boxidd = button.closest(".myFormContainer").querySelector("[name='editboxid']").value;
 var pagenum = button.closest(".iimi").querySelector("[name='pagenumm']").value;

 
  // Update the modal's content.
  var boxidedit = edidtmodel.querySelector('#boxidedit')
//  var datetimeedit = edidtmodel.querySelector('#datetimeedit')
 var amountedit = edidtmodel.querySelector('#amountedit')
 var oldamount = edidtmodel.querySelector('#oldamount')
 var pagenumid = edidtmodel.querySelector('#pagenumid')

 boxidedit.value = boxidd;
//  datetimeedit.value =  datee;
 amountedit.value = depositamountt;
 oldamount.value = depositamountt;
 pagenumid.value = pagenum;
 
})












</script>
  @endsection
  
@endsection

{{-- ============================================================================================================== --}}

