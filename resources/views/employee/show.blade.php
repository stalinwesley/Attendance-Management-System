@extends('layouts.appadmin')

@section('content')
<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">{{ $employee->name}} Details</h6>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <tbody>
                <tr>
                <th>Name</th>
                <td>{{$employee->name}}</td>
                </tr>
                <tr>
                <th>Email</th>
                <td>{{$employee->email}}</td>
                </tr>
                <tr>
                    <th> Employee ID</th>
                    <td>{{$employee->employee->emp_id}}</td>
                </tr>
                <tr>
                    <th> Mobile</th>
                    <td>{{$employee->mobile}}</td>
                </tr>
                <tr>
                    <th> Status</th>
                    <td>{{$employee->status ? 'Enabled' : 'Disabled'}}</td>
                </tr>
                <tr>
                    <th> Address</th>
                    <td>{{$employee->employee->address}}</td>
                </tr>
                <tr>
                    <th> Joining Date</th>
                    <td>{{$employee->employee->joining_date}}</td>
                </tr>
                <tr>
                    <th> Department </th>
                    <td>{{$employee->employee->department_name}}</td>
                </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>

  </div>
@endsection
@section('css')
<link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
  
@show
