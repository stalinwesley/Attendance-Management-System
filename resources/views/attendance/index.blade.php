@extends('layouts.appadmin')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/jquery.timepicker.css')}}">
<link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">

@endsection
@section('content')
<div class="container-fluid">
    <div class="form-row">
      <div class="col form-group">
        <label for="employeename">Employee name</label>
        <select name="employee" id="employee" class="form-control">
          <option value="0">Select Employee</option>
          @foreach ($employees as $id => $employee)
        <option value="{{$id}}" @if (request()->input('employee') == $id)
            selected
        @endif> {{ $employee }}</option>
          @endforeach
        </select>
      </div>
      <div class="col form-group">
        <label for="department">Department</label>
        <select name="department" id="department" class="form-control">
          <option value="0">Select Department</option>
          @foreach ($departments as $id => $department)
        <option value="{{$id}}">{{ $department }}</option>
          @endforeach
        </select>
      </div>
      <div class="col form-group">
        <label for="month">Month</label>
        <select name="month" id="month" class="form-control">
          <option value="01" @if ($month=='01')
              selected
          @endif> January</option>
          <option value="02" @if ($month=='02')
              selected
          @endif> February</option>
          <option value="03" @if ($month=='03')
              selected
          @endif> March</option>
          <option value="04" @if ($month=='04')
              selected
          @endif> April</option>
          <option value="05" @if ($month=='05')
              selected
          @endif> May</option>
          <option value="06" @if ($month=='06')
              selected
          @endif> June</option>
          <option value="07" @if ($month=='07')
              selected
          @endif> July</option>
          <option value="08" @if ($month=='08')
              selected
          @endif> Auguest</option>
          <option value="09" @if ($month=='09')
              selected
          @endif> September</option>
          <option value="10" @if ($month=='10')
              selected
          @endif> October </option>
          <option value="11" @if ($month=='11')
              selected
          @endif> November </option>
          <option value="12" @if ($month=='12')
              selected
          @endif> December </option>
          
        </select>
      </div>
      <div class="col form-group">
        <label for="year">Year</label>
        <select name="year" id="year" class="form-control">
          @for($i = $year ; $i >= ($year - 4);$i--)
        <option value="{{ $i }}" @if ($i == $year) selected
            
        @endif>{{ $i }}</option>
        @endfor
        </select>
      </div>
      <div class="col form-group">
        <label for="">.</label>
        <button type="submit" id="filterattendance" class="btn btn-success form-control"> Apply </button>
      </div>
    </div>


    <!-- DataTales Example -->
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Attendances</h6>
      </div>
      {{-- <div class="col-3 pt-1">
      <a href="#" class="btn btn-primary btn-icon-split pull-right" data-toggle="modal" data-target="#addholidaymodal">
        <span class="icon text-white-50">
          <i class="fas fa-plus"></i>
        </span>
        <span class="text">Add Holiday</span>
      </a>
      </div> --}}
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead >
              <tr>
                  <th>Employee</th>
               
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


<div class="modal fade" id="markatModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Attendance mark</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group base-input">
          <input type="hidden" name="userid" id="userid" value="">
          <input type="hidden" name="attendancedate" id="attendancedate" value="">
          <label for="halfday">Clock In Time</label>

          <input class="input-field " id="timein" type="text" aria-describedby="emailHelp" placeholder="Enter Clock in Time..." name="timein" value="09:00 AM" required>
        </div>
        <div class="form-group base-input">
          <label for="halfday">Clock Out Time</label>
        <input class="input-field " id="timeout" type="text" aria-describedby="emailHelp" placeholder="Enter Clock out Time..." name="timeout" value="06:00 PM" required>
        </div>
        <div class="form-group base-input">
          <label for="halfday">Work From</label>
        <select name="workfrom" id="workfrom" class="input-field">
          <option value="0">Select Work From</option>
          <option value="office">Office</option>
          <option value="home">Home</option>
          <option value="client">Client</option>
        </select>
      
        </div>
      
        <div class="form-group ">
          <label for="halfday">Late</label>
        <input class="input-field " id="late" type="checkbox" aria-describedby="emailHelp" ." name="late" value="yes" required>
        </div>
      
        <div class="form-group ">
          <label for="halfday">Half day</label>
        <input class="input-field " id="halfday" type="checkbox" aria-describedby="emailHelp" ." name="halfday" value="yes" required>
        </div>
      
      
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary" id="saveattendance">Save</button>
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="viewAttendance" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Attendance Details</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body viewattendancedet">
       
      </div>
      <div class="modal-footer">
        {{-- <button type="submit" class="btn btn-primary" id="saveattendance">Save</button> --}}
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>

@endsection

@section('javascript')
    <!-- Page level plugins -->
  <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js')}}"></script>
  <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
  <script src="{{ asset('js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('js/jquery.timepicker.js')}}"></script>
  <!-- Page level custom scripts -->
  <script>

    $('#filterattendance').click(function(){
      $('#dataTable').on('preXhr.dt', function (e, settings, data) {
      // window.employee = $('#employee').val();
      // window.department = $('#department').val();
      // window.month = $('#month').val();
      // window.year = $('#year').val();
      // data['employee'] = employee;
      // data['month'] = month;
      // data['year'] = year;
      // data['department'] = department;
      });
      attendancetable.draw()
    });


    $('#timein').timepicker({
	'minTime': '09:00 AM',
	'maxTime': '12:00 PM',
  'showDuration': true,
  'step': 15,
  'timeFormat': 'h:i A',
    });
    $('#timeout').timepicker({
	'minTime': '06:00 PM',
	'maxTime': '09:00 PM',
  'showDuration': true,
  'step': 15,
  'timeFormat': 'h:i A'
    });
   
      $(function() {
        var d = new Date;
        window.month = d.getMonth() + 1;
        window.year = d.getFullYear();
        window.employee = $('#employee').val() || 0;
        window.department = $('#department').val() || 0;
    window.attendancetable = $('#dataTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
          "url":"{!! route('attendance.list') !!}",
          "data":{
            "month":month,
            "year":year,
            "employee":employee,
            "department":department
          },
        },
        columns: [
            { data: 'attendace', name: 'attendace' },
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

$('#saveattendance').click(function(){
    var timein = $('#timein').val();
    var timeout = $('#timeout').val();
    var late = $("input[name='late']:checked").length || 0;
    var halfday = $("input[name='halfday']:checked").length || 0;

    var year           = $('#year').val();
    var month          = $('#month').val();
    var csrf = $('meta[name=csrf_token]').attr("content");
    var userid = $('#userid').val();
    var attendancedate = ($('#attendancedate').val() <= 9) ? '0'+$('#attendancedate').val() : $('#attendancedate').val() ;
    var attendancedate = attendancedate+"-"+month+"-"+year;

    var workfrom = $('#workfrom').val();
    $.ajax({
        url:"{{ route('attendance.store') }}",
        method:'POST',
        data:{timein:timein,timeout:timeout,late:late,halfday:halfday,year:year,month:month,_token:csrf,userid:userid,attendancedate:attendancedate,workfrom:workfrom},
        success:function(){
          attendancetable.draw();
          $('#markatModel').modal('toggle');
        }
    })

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

$(document).on('click', '.edit-attendance',function (event) {
       var attendanceDate = $(this).data('attendance-date');
       var userData       = $(this).closest('tr').children('td:first');
       var userID         = userData[0]['firstChild']['nextSibling']['dataset']['employeeId'];
        $('#attendancedate').val(attendanceDate)
        $('#userid').val(userID)

       console.log(userData);
       console.log(userID);
       var year           = $('#year').val();
       var month          = $('#month').val();

     
   });
$(document).on('click', '.view-attendance',function (event) {
       var attendanceId = $(this).data('attendance-id');
       var userData       = $(this).closest('tr').children('td:first');
       var userID         = userData[0]['firstChild']['nextSibling']['dataset']['employeeId'];
      //   $('#attendancedate').val(attendanceDate)
      //   $('#userid').val(userID)

      //  console.log(userData);
      //  console.log(userID);
      //  var year           = $('#year').val();
      //  var month          = $('#month').val();
      var url = "{{ route('attendance.info',[':id']) }}";
       url = url.replace(':id',attendanceId); 
       console.log(url);
      $.ajax({
        'url':url,
         'method':"GET",
         success:function(data){
          $('.viewattendancedet').html('');
          $('.viewattendancedet').html(data);
          $('#viewAttendance').modal('toggle');
         }
      })     
     
   });
  </script>
@endsection