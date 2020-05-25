@extends('layouts.appadmin')

@section('content')
<div class="container-fluid">


    <!-- DataTales Example -->
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Departments</h6>
      </div>
      <div class="col-3 pt-1">
      <a href="{{ route('department.create')}}" class="btn btn-primary btn-icon-split  pull-right">
        <span class="icon text-white-50">
          <i class="fas fa-plus"></i>
        </span>
        <span class="text">Add deparment</span>
      </a>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Employees</th>
                <th>notes</th>
                <th>Created At</th>
                <th>Action</th>
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
            { data: 'employees', name: 'employees' },
            { data: 'notes', name: 'notes' },
            { data: 'created_at', name: 'created_at' },
            { data: 'action', name: 'action' },
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

function deletedepartment(obj){
      var id = $(obj).attr('data-id') || 0;
      console.log(id);
  if(confirm("are you sure want delete?")){
    var form = document.createElement("form");
     var element1 = document.createElement("input");
      var element2 = document.createElement("input"); 
      form.method = "POST"; 
      form.action = "{{ route('department.destroy',"")}}"+"/"+id; 
      element1.value="{{ csrf_token()}}";
      element1.name="_token";
      form.appendChild(element1);
      element2.value="DELETE"; 
      element2.name="_method"; 
      form.appendChild(element2); 
      document.body.appendChild(form);
      form.submit();
  }
  else{
    return false;
  }
}
  </script>
@show