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
<form action="customerDepositpost" method="post">
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


<!-- Basic Bootstrap Table -->
<div class="card m-2">
  <h5 class="card-header">All Registered Users</h5>
  <div class="table-responsive text-nowrap">
    <table class="table">
      <thead>
        <tr>
          <th>No.</th>
          <th>Card-iD</th>
          <th>Customer-Name</th>
          <th>Status</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody class="table-border-bottom-0">
          @if (!empty($customers))
          @foreach ($customers as $customer)
               <tr>
              <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>#{{ $customer->id }}</strong></td>
              <td>{{ $customer->cardnum }}</td>
              <td>
                <form action="customerDepositpost" method="post">
                  @csrf
                  <input type="hidden" value="{{ $customer->cardnum }}"  name="customer"> 
                  <button type="submit" class="btn btn-primary px-2 mx-2 my-2">{{ $customer->newcustomer }} </button>    

                </form>
              </td>
              <td><span class="badge bg-label-primary me-1">{{ $customer->status }}</span></td>
              <td>
                <div class="dropdown">
                  <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                  <div class="dropdown-menu">
                    <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                    <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-trash me-1"></i> Delete</a>
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












@endsection
