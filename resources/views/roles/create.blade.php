@extends('layouts.appadmin')

@section('css')
<link rel="stylesheet" href="{{ asset('css/crater.css') }}">
<link rel="stylesheet" href="{{ asset('css/select2.min.css')}}">
@endsection

@section('content')
<div class="col-xl-8 col-lg-7">
    <div class="card shadow mb-4">
      <!-- Card Header - Dropdown -->
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Add Role</h6>
       
      </div>
      <!-- Card Body -->
      <div class="card-body">
        
      <form class="user" method="POST" action="{{ route('roles.store')}}" >
            @csrf

            @component('components.input',[
                'type'=>'text',
                'name'=>'title',
                'placeholder'=>'Enter title...',
                ])
                
            @endcomponent
            <div class="form-group ">
              <label class="form-label">Permissions
              <span class="btn btn-info btn-xs select-all">Select all</span>
<span class="btn btn-info btn-xs deselect-all">Deselect all</span></label>
              <span class="text-danger"> *</span>
              <div class="base-input">
                <select name="permissions[]" id="permissions" multiple required class="input-field select2">
                  @foreach ($permissions as $id => $permission)
                     <option value="{{ $id}}" {{ (in_array($id,old('permissions',[]))) ? 'selected':''}}>{{ $permission}}</option>
                  @endforeach
                </select>
              </div>
            </div>
                
              <div class="form-group">
                <button type="submit" class="btn btn-primary">
                  Add
              </button>
                </div>
        </form>
      </div>
    </div>
  </div> 
@endsection
@section('javascript')
<script src="{{ asset('js/select2.full.min.js')}}"></script>
<script>
  
  $('.select-all').click(function () 
  { 
    let $select2 = $(this).parent().siblings('.select2') 
  $select2.find('option').prop('selected', 'selected') 
  $select2.trigger('change') 
  })

  $('.deselect-all').click(function () { 
    let $select2 = $(this).parent().siblings('.select2') 
  $select2.find('option').prop('selected', '')
   $select2.trigger('change') 
   })
   $('.select2').select2()
</script>
@endsection