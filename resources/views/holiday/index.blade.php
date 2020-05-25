@extends('layouts.appadmin')

@section('content')
<div class="container-fluid">


    <!-- DataTales Example -->
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Holidays</h6>
      </div>
      <div class="col-3 pt-1">
      <a href="#" class="btn btn-primary btn-icon-split pull-right" data-toggle="modal" data-target="#addholidaymodal">
        <span class="icon text-white-50">
          <i class="fas fa-plus"></i>
        </span>
        <span class="text">Add Holiday</span>
      </a>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>Id</th>
                <th>Date</th>
                <th>Occassion</th>
                <th>Created At</th>
                <th>Action</th>
              </tr>
            </thead>
          </table>
        </div>
      </div>
    </div>

  </div>

<!-- Logout Modal-->
<link rel="stylesheet" href="{{ asset('css/bootstrap-datepicker.min.css') }}">

<style>
 
  .base-input .input-field {
      width: 100%;
      height: 40px;
      padding: 8px 13px;
      text-align: left;
      background: #fff;
      border: 1px solid #ebf1fa;
      box-sizing: border-box;
      border-radius: 5px;
      font-style: normal;
      font-weight: 400;
      font-size: 14px;
      line-height: 21px;
  }
      </style>
<div class="modal fade" id="addholidaymodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Holiday</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="{{ route('holiday.store')}}" method="post">
        @csrf
        <div class="form-group base-input">
          <input class="input-field " id="date" type="text" aria-describedby="emailHelp" placeholder="Enter date..." name="date" value="" required>
        </div>
      
        <div class="form-group base-input">
          <input class="input-field " id="occassion" type="text" aria-describedby="emailHelp" placeholder="Enter occassion..." name="occassion" value="" required>
        </div>
      
      
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Save</button>
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
        
      </form>
        

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
  <script src="{{ asset('js/bootstrap-datepicker.min.js') }}"></script>

  <!-- Page level custom scripts -->
  {{-- <script src="js/demo/datatables-demo.js"></script> --}}
  <script>
     $("#date").datepicker({
            format: 'dd-mm-yyyy',
            todayHighlight: true,
            autoclose: true
        });
      $(function() {
       
    $('#dataTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{!! route('holiday.list') !!}",
        columns: [
            { data: 'id', name: 'id' },
            { data: 'date', name: 'date' },
            { data: 'occassion', name: 'occassion' },
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

function deleteholiday(obj){
      var id = $(obj).attr('data-id') || 0;
      console.log(id);
  if(confirm("are you sure want delete?")){
    var form = document.createElement("form");
     var element1 = document.createElement("input");
      var element2 = document.createElement("input"); 
      form.method = "POST"; 
      form.action = "{{ route('holiday.destroy',"")}}"+"/"+id; 
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