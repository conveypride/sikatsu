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
            <span class="fw-semibold d-block mb-1">Active Customers</span>
            <h3 class="card-title mb-2">{{ $activeCustomers }}</h3>
            <small class="{{ $activesucess  == 'true' ? "text-success" : "text-danger"}}   fw-semibold"><i class='bx bx-up-arrow-alt'></i> {{ $percentageofactiveusers }}%</small>
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
            <span>Inactive Customers</span>
            <h3 class="card-title text-nowrap mb-1"> {{ $inactiveCustomers }}</h3>
            <small class="{{ $activesucess  == 'true' ? "text-danger" : "text-success"}}  fw-semibold"><i class='bx bx-up-arrow-alt'></i> {{ $percentageofinactiveusers }}%</small>
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
        <span class="d-block mb-1">Card Sales</span>
        <h3 class="card-title text-nowrap mb-2">GHS {{ $cardsales }}.00</h3>
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
        <span class="fw-semibold d-block mb-1">No.Books Sold</span>
        <h3 class="card-title mb-2">{{ $cardsalesno }}</h3>
        {{-- <small class="text-success fw-semibold"><i class='bx bx-up-arrow-alt'></i> +28.14%</small> --}}
      </div>
    </div>
  </div>
    </div>
  </div>
  <!-- Register New Customer -->
  <div class="col-12  order-2 order-md-3 order-lg-2 mb-4">
    <form action="registerCustomerpost" method="post">
        @csrf
    <div class="card">
      <div class="row row-bordered g-0">
        <div class="col">
          <h5 class="card-header m-0 me-2 pb-3">Register New Customer</h5>
         
            <div class="px-2 mb-3">
                <label for="newcustomer" class="form-label">Enter Name</label>
                <input required class="form-control" list="datalistOptions" id="newcustomer" name="newcustomer" placeholder="Type name...">
                @if (!empty($customers))
                   
                <datalist id="datalistOptions">
                    @foreach ($customers as $customer)
                    <option value="Name: {{ $customer->newcustomer }} | Cardnum: {{ $customer->cardnum }} ">
                    @endforeach
                </datalist>
                @else
                    <datalist id="datalistOptions">
                  <option value="Name of customer">
                  
                </datalist>
                @endif
                
              </div>

          <div class="mb-3 row px-2">
            <label for="cardprice" class=" col-form-label">Card Price</label>
            <div class="col-md-10">
              <input required class="form-control" type="number" name="cardprice" id="cardprice" placeholder="GHS..." />
            </div>
          </div>

          <div class="mb-3 row px-2">
            <label for="cardnum" class=" col-form-label">Card Number</label>
            <div class="col-md-10">
              <input required class="form-control" type="text" placeholder="eg john123..." name="cardnum" id="cardnum" value="{{ $idNumber }}" readonly />
            </div>
          </div>

          <div class="mb-3 row px-2">
            <label for="registrationdate" class="  col-form-label">Registration Date</label>
            <div class="col-md-10">
              <input required class="form-control" name="registrationdate" type="datetime-local" id="registrationdate" />
            </div>
          </div>

          <div class="mb-3 row px-2">
            <label for="initialdeposite" class=" col-form-label">Initial Deposite</label>
            <div class="col-md-10">
              <input required class="form-control" type="number" name="initialdeposite" id="initialdeposite" placeholder="GHS..." />
            </div>
          </div>

          <button type="submit" class="btn btn-primary px-2 mx-2 my-2">Register</button>

        </div>
        
      </div>
    </div>
  </div>
</form>

</div>
 
<!-- Basic Bootstrap Table -->
<div class="card m-2">
    <h5 class="card-header">All Registered Users</h5>
    <div class="table-responsive text-nowrap">
      <table class="table">
        <thead>
          <tr>
            <th>#No.</th>
            <th>Card-iD</th>
            <th>Customer-Name</th>
            <th>Status</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody class="table-border-bottom-0">
            @if (!empty($customers))
            @foreach ($customers as $customer)
                 <tr class="cont">
                <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong id="idd">{{ $customer->id }}</strong></td>
                <td>{{ $customer->cardnum }}</td>
                <td id="usname">
                    {{ $customer->newcustomer }}
                </td>
                <td><span class="badge bg-label-primary me-1" id="stat">{{ $customer->status }}</span></td>
                <td>
                  <div class="dropdown">
                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                    <div class="dropdown-menu">
                      <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#edidtmodel"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                      {{-- <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-trash me-1"></i> Delete</a> --}}
                    </div>
                  </div>
                </td>
              </tr>
              @endforeach
            @else
            <tr>
            <td>
                No customers registered...
            </td> 
            </tr>
            
            @endif
            
        
        </tbody>
      </table>
    </div>
  </div>
  <!--/ Basic Bootstrap Table -->
  
  <div class="modal fade" id="edidtmodel" tabindex="-1" aria-labelledby="edidtmodelLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="edidtmodelLabel">Edit User Details</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="{{ route('edituser') }}" method="post">
          @csrf
          <div class="modal-body">
            <p>
             User Name: <input type="text" class="form-control"  name="username" id="username" >
            </p>
            
  <p>
 <div class="mb-3">
  <label for="status" class="form-label">Status</label>
  <select class="form-select form-select-lg" name="status" id="status">
    <option id="statusval"></option>
    <option value="Active">Active</option>
    <option value="Disabled">Disabled</option> 
  </select>
 </div>
  </p>
   <input type="hidden" class="form-control" name="userid" id="userid">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </form>
      </div>
    </div>
  </div>
  
  @section('customscript')
  <script>

var edidtmodel = document.getElementById('edidtmodel')
edidtmodel.addEventListener('show.bs.modal', function (event) {
  // alert('hi');
  // Button that triggered the modal
  var button = event.relatedTarget
  // Extract info from data-bs-* attributes
  // var recipient = button.getAttribute('data-bs-whatever');
 var id =  button.closest(".cont").querySelector("#idd").textContent;
 var usname = button.closest(".cont").querySelector("#usname").textContent;
 var stat = button.closest(".cont").querySelector("#stat").textContent;

  // Update the modal's content.
  var username = edidtmodel.querySelector('#username') 
 var statusval = edidtmodel.querySelector('#statusval')
 var userid = edidtmodel.querySelector('#userid')

 username.value = usname.trim(); 
 statusval.textContent = stat.trim();
 userid.value = id.trim();
 
})
</script>
  @endsection

@endsection
