@extends('layouts.appadmin')

@section('content')
<div class="container-fluid">


    <!-- DataTales Example -->
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Departments</h6>
      </div>
      <a href="{{ route('department.create')}}" class="btn btn-primary btn-icon-split  pull-right">
        <span class="icon text-white-50">
          <i class="fas fa-plus"></i>
        </span>
        <span class="text">Add deparment</span>
      </a>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>Id</th>
                <th>Name</th>
                <th>notes</th>
                <th>Action</th>
                <th>Created At</th>
              </tr>
            </thead>
          </table>
        </div>
      </div>
    </div>

  </div>
@endsection
@section('css')
<link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
  
@show
@section('javascript')
    <!-- Page level plugins -->
  <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js')}}"></script>
  <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

  <!-- Page level custom scripts -->
  {{-- <script src="js/demo/datatables-demo.js"></script> --}}
  <script>
      $(function() {
    $('#dataTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{!! route('deparment.list') !!}",
        columns: [
            { data: 'id', name: 'id' },
            { data: 'name', name: 'name' },
            { data: 'notes', name: 'notes' },
            { data: 'action', name: 'action' },
            { data: 'created_at', name: 'created_at' },
        ],
        buttons: [
            {
                text: 'My button',
                action: function ( e, dt, node, config ) {
                    alert( 'Button activated' );
                }
            }
        ],
    });
});
  </script>
@show