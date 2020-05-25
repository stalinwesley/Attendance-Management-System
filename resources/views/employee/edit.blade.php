@extends('layouts.appadmin')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/custom-select.css') }}">
    <link rel="stylesheet" href="{{ asset('css/crater.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap-datepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dropzone.css') }}">
<link rel="stylesheet" href="{{ asset('css/select2.min.css')}}">

@endsection
@section('content')
<div  class="customer-create main-content">
<form method="POST" action="{{ route('employee.update',$employee->id)}}" >
    @csrf
    @method('patch')
    <div class="page-header">
    <h3 class="page-title">Edit Employee</h3>
     <?php 
     $breadcrumb = [
       [
         'name'=>'Home',
         'url'=> URL::to('/'),
      ],
       [
         'name'=>'Employee',
         'url'=> route('employee.index'),
      ],
       [
         'name'=>'Edit Employee',
         'url'=> '#',
      ],
     ]
     ?> 
     @include('elements.breadcrumb')

     <div class="page-actions header-button-container"><button type="submit" class="base-button btn btn-primary default-size " tabindex="23">
      <i class="fas fa-save fa-fw mr-1"></i>
      Update Employee</button>
   </div>
   </div> 
   <div class="customer-card card">
      <div class="card-body">
         <div class="row">
            <div class="section-title col-sm-2">Basic Info</div>
            <div class="col-sm-5">
               <div class="form-group">
                  <label class="form-label">Employee Id</label><span class="text-danger"> *</span> 
                  <div class="base-input" focus="">
                  <input name="employee_id" tabindex="1" placeholder="PRA1223" autocomplete="on" type="text" class="input-field {{ $errors->has('employee_id') ? 'invalid' : ''}}" value="{{ old('employee_id',$employee->emp_id)}}">  
                  </div>
                  @error('employee_id')
                  <div>
                    <span class="text-danger">
                      {{ $message}}
                    </span>
                  </div>
                  @enderror
               </div>
               <div class="form-group">
                  <label class="form-label">Employee Name</label><span class="text-danger"> *</span> 
                  <div class="base-input">
                      <input name="employee_name" tabindex="3" placeholder="" autocomplete="on" type="text" class="input-field {{ $errors->has('employee_name') ? 'invalid' : ''}}" value="{{ old('employee_name',$employee->user->name)}}">  
                  </div> 
                  @error('employee_name')
                  <div>
                    <span class="text-danger">
                      {{ $message}}
                    </span>
                  </div>
                  @enderror      
               </div>
               <div class="form-group">
                <label class="form-label">Mobile</label> <span class="text-danger"> *</span> 
                <div class="base-input">
                    <input name="mobile" tabindex="4" placeholder="" autocomplete="on" type="text" class="input-field {{ $errors->has('mobile') ? 'invalid' : ''}}" value="{{ old('mobile',$employee->user->mobile)}}">  
                </div>
                @error('mobile')
                <div>
                  <span class="text-danger">
                    {{ $message}}
                  </span>
                </div>
                  @enderror
             </div>
         
            </div>
            <div class="col-sm-5">
               <div class="form-group">
                  <label class="form-label">Employee Email</label><span class="text-danger"> *</span> 
                  <div class="base-input" label="employee Email">
                      <input name="employee_email" tabindex="2" placeholder="" autocomplete="on" type="text" class="input-field {{ $errors->has('employee_email') ? 'invalid' : ''}}" value="{{ old('employee_email',$employee->user->email)}}">  
                  </div>
                  @error('employee_email')
                  <span class="text-danger">
                    {{ $message}}
                  </span>
                  @enderror
               </div>
               <div class="form-group">
                  <label class="form-label">Employee Password</label><span class="text-danger"> *</span> 
                  <div class="base-input" label="employee Email">
                      <input name="employee_password" tabindex="2" placeholder="" autocomplete="on" type="password" class="input-field {{ $errors->has('employee_password') ? 'invalid' : ''}}">  
                  </div>
                  @error('employee_password')
                  <div>
                      <span class="text-danger">
                          {{ $message}}
                      </span>
                    </div>
                  @enderror
               </div>
               <div class="form-group">
                  <label class="form-label">Login</label> 
                  <div class="base-input">
                      <select name="status" id="status" class="input-field {{ $errors->has('status') ? 'invalid' : ''}}">
                        <option value="0">Select Status</option>  
                        <option value="1" @if (old('status',$employee->user->status) == 1)
                            {{ 'selected' }}
                        @endif>Enabled</option>  
                        <option value="2" @if (old('status',$employee->user->status) == 2)
                        {{ 'selected' }}
                    @endif>disabled</option>  
                      </select>  
                  </div>
                  @error('status')
                  <div>
                      <span class="text-danger">
                          {{ $message}}
                      </span>
                    </div>
                  @enderror
               </div>
            </div>
         </div>
         <hr>
         <div class="row">
            <div class="section-title col-sm-2">Offcial Details</div>
            <div class="col-sm-5">
               <div class="form-group">
                  <label class="form-label">Designation</label><span class="text-danger"> *</span> 
                  <div class="base-input">
                    <select name="designation" id="designation" class="form-control {{ $errors->has('designation') ? 'invalid' : ''}}">
                      <option value="0">select designation</option>
                        @foreach ($designation as $k => $item)
                        @if (old('designation',$employee->designation_id) == $item['id'])
                        <option value="{{ $item['id']}}" selected> {{ $item['name']}}</option>
                        @else
                            
                        <option value="{{ $item['id']}}"> {{ $item['name']}}</option>
                        @endif
                        @endforeach
                    </select>
                  </div>
                  @error('designation')
                  <div>
                      <span class="text-danger">
                          {{ $message}}
                      </span>
                    </div>
                  @enderror
               </div>
               <div class="form-group">
                  <label class="form-label">Joining Date</label> <span class="text-danger"> *</span>
                  <div class="base-input">
                      <input name="joiningdate" tabindex="9" placeholder="" autocomplete="on" type="text" class="input-field {{ $errors->has('joiningdate') ? 'invalid' : ''}}" id="joiningdate" value="{{ old('joiningdate',$employee->joining_date)}}">  
                  </div>
                  @error('joiningdate')
                  <div>
                      <span class="text-danger">
                          {{ $message}}
                      </span>
                    </div>
                  @enderror
               </div>
               <div class="form-group">
                  <label class="form-label">Address</label> <span class="text-danger"> *</span>
                  <div class="base-input">

                  <textarea rows="2" cols="10" placeholder="Street 1" class="text-area-field base-text-area {{ $errors->has('address') ? 'invalid' : ''}}" tabindex="11" type="text" name="address">{{ old('address',$employee->address)}}</textarea>
                </div>
                @error('address')
                <div>
                    <span class="text-danger">
                        {{ $message}}
                    </span>
                  </div>
                @enderror                   
                  
               </div>
               <div class="form-group ">
                <label for="photo">Photo</label>
                <div class="needsclick dropzone dz-clickable" id="photo-dropzone">

                  <div class="dz-default dz-message"><span>Drop files here to upload</span></div></div>
   
                </div>
                @isset($employee->user->image->url)
              <img src="{{ Storage::url($employee->user->image->url)}}" alt="" srcset="" width="100px">
                @endisset
            </div>
            <div class="col-sm-5">
              <div class="form-group">
                <label class="form-label">Department</label><span class="text-danger"> *</span> 
                <div class="base-input">
                  <select name="department" id="department" class="form-control {{ $errors->has('department') ? 'invalid' : ''}}">
                    <option value="0">select department</option>
                    @foreach ($department as $item)
                    @if (old('department',$employee->department_id) == $item['id'])
                        
                    <option value="{{ $item['id']}}" selected>{{ $item['name']}}</option>
                    @else
                        
                    <option value="{{ $item['id']}}">{{ $item['name']}}</option>
                    @endif
                    @endforeach
                  </select>
                </div>
                @error('department')
                    <div>
                        <span class="text-danger">
                            {{ $message}}
                        </span>
                      </div>
                    @enderror
             </div>
            
               <div class="form-group">
                  <label class="form-label">Last Date</label> 
                  <div class="base-input">
                  <input name="lastdate" tabindex="10" placeholder="" autocomplete="on" type="text" class="input-field {{ $errors->has('employee_id') ? 'invalid' : ''}}" id="lastdate" value="{{ old('lastdate',$employee->last_date)}}">  
                  </div>
               </div>
               <div class="form-group">
                  <label class="form-label">Gender</label> <span class="text-danger"> *</span>
                  <div class="base-input">
                      <select name="gender" id="gender" class="input-field {{ $errors->has('employee_id') ? 'invalid' : ''}}">
                      <option value="0">Select gender</option>  
                      <option value="male" @if (old('gender',$employee->gender) == "male")
                      {{ 'selected' }}
                  @endif>Male</option>  
                      <option value="female" @if (old('gender',$employee->gender) == "female")
                      {{ 'selected' }}
                  @endif>FeMale</option>  
                      <option value="others" @if (old('gender',$employee->gender) == "others")
                      {{ 'selected' }}
                  @endif>Others</option>  
                      </select>  
                  </div>
               </div>
               
               <div class="form-group">
                  <label class="form-label">Skills</label> 
                  <div class="base-input">
                      <select name="skills[]" id="skills" class="input-field {{ $errors->has('employee_id') ? 'invalid' : ''}}" multiple style="height: 100px">
                      <option value="0">Select Skills</option>
                      @foreach ($skills as $id => $skill)
                      <option value="{{ $id }}" {{ (isset($employee->skills) && $employee->skills->contains($id) ) ? 'selected' : ''}}> {{$skill}}</option>                          
                      @endforeach  
                      </select>  
                  </div>
               </div>
               
            </div>
         </div>

      </div>
   </div>
   </form>
</div>
@endsection

@section('javascript')
<script src="{{ asset('js/custom-select.min.js') }}"></script>
<script src="{{ asset('js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('js/dropzone.js') }}"></script>
<script>
  $(document).ready(function(){
  $("#imgbox").click(function(){
    $('#profileimage').trigger('click');
  });
});

   $("#joiningdate, #lastdate").datepicker({
            format: 'dd-mm-yyyy',
            todayHighlight: true,
            autoclose: true
        });
  // $("#department").select2({
  //     formatNoMatches: function () {
  //        return "No record found.";
  //      }
  //   });
  //   $("#designation").select2({
  //      formatNoMatches: function () {
  //         return "No record found.";
  //      }
  //   });
</script>
<script>
  Dropzone.options.photoDropzone = {
  url: "{{route('employee.storemedia')}}",
  maxFilesize: 2, // MB
  acceptedFiles: '.jpeg,.jpg,.png,.gif',
  maxFiles: 1,
  addRemoveLinks: true,
  headers: {
  'X-CSRF-TOKEN': "{{ csrf_token()}}"
  },
  params: {
  size: 2,
  width: 4096,
  height: 4096
  },
  success: function (file, response) {
  $('form').find('input[name="photo"]').remove()
  $('form').append('<input type="hidden" name="photo" value="' + response.name + '">')
  },
  removedfile: function (file) {
  file.previewElement.remove()
  if (file.status !== 'error') {
  $('form').find('input[name="photo"]').remove()
  this.options.maxFiles = this.options.maxFiles + 1
  }
  },
  init: function () {
  },
  error: function (file, response) {
  if ($.type(response) === 'string') {
  var message = response //dropzone sends it's own error messages in string
  } else {
  var message = response.errors.file
  }
  file.previewElement.classList.add('dz-error')
  _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
  _results = []
  for (_i = 0, _len = _ref.length; _i < _len; _i++) {
  node = _ref[_i]
  _results.push(node.textContent = message)
  }
  return _results
  }
  }
  
  </script>
@stop