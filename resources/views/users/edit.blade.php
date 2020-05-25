@extends('layouts.appadmin')
@section('css')
<link rel="stylesheet" href="{{ asset('css/crater.css') }}">
    
@show
<style>
  .file {
  visibility: hidden;
  position: absolute;
}
</style>
@section('content')
<div class="col-xl-8 col-lg-7">
  <div class="card shadow mb-4">
    <form class="user" method="POST" action="{{ route('users.update',$user->id)}}" enctype="multipart/form-data" >
      <!-- Card Header - Dropdown -->
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Edit User ( {{ $user->name }} )</h6>
        <div class="dropdown no-arrow show">
          <button type="submit" class="btn btn-primary">
            Update
        </button>
        </div>
      </div>
      <!-- Card Body -->
      <div class="card-body">
        
            @csrf
            @method('patch')
            @component('components.input',[
                'type'=>'text',
                'name'=>'name',
                'placeholder'=>'Enter name...',
                'value'=>$user->name
                ])
                
            @endcomponent

            @component('components.input',[
                'type'=>'text',
                'name'=>'email',
                'placeholder'=>'Enter Email...',
                'value'=>$user->email
                ])
                
            @endcomponent

            @component('components.input',[
                'type'=>'password',
                'name'=>'password',
                'placeholder'=>'Enter password...',
                ])
                
            @endcomponent


            @component('components.input',[
                'type'=>'text',
                'name'=>'mobile',
                'placeholder'=>'Enter Mobile...',
                'value'=>$user->mobile
                ])
                
            @endcomponent

            <div class="form-group base-input">
              <select name="role" id="role" class="input-field {{ $errors->has('status') ? 'invalid' : ''}}" required>
                <option value="0">Select Role</option>
                @foreach ($roles as $id => $role)
              <option value="{{ $id }}" {{ (in_array($id,old('role',[])) || $user->roles->contains($id) ) ? 'selected' : '' }} > {{ $role }}</option>
                @endforeach
              </select>
            </div>


            <div class="form-group base-input">
              <select name="status" id="status" class="input-field {{ $errors->has('status') ? 'invalid' : ''}}">
                <option value="0">Select Status</option>  
                <option value="1" @if (old('status',$user->status) == 1)
                    {{ 'selected' }}
                @endif>Enabled</option>  
                <option value="2" @if (old('status',$user->status) == 2)
                {{ 'selected' }}
            @endif>disabled</option>  
              </select> 
              @error('status')
              <span class="text-danger"  >
                <strong>{{ $message }}</strong> 
              </span>
              @enderror 
          </div>
          <div class="input-group my-3 form-group">
            <input type="file" name="profileimage" class="file" accept="image/*">
      <input type="text" class="form-control {{ $errors->has('profileimage') ? 'invalid' : ''}}" disabled placeholder="Upload File" id="file">
      <div class="input-group-append">
        <button type="button" class="browse btn btn-primary">Browse...</button>
      </div>
     
    </div>
               
      <div class="ml-2 col-sm-6 form-group">
        <img src="{{ isset($user->image->url) ? Storage::url($user->image->url) : 'https://placehold.it/80x80' }}" id="preview" class="img-thumbnail">
        @error('profileimage')
        <span class="text-danger"  >
          <strong>{{ $message }}</strong> 
        </span>
        @enderror
      </div> 
              <div class="form-group">
                <button type="submit" class="btn btn-primary">
                  Update
              </button>
                </div>
              </div>
      </form>

    </div>
  </div> 
@endsection
@section('javascript')
<script>
  $(document).on("click", ".browse", function() {
  var file = $(this).parents().find(".file");
  file.trigger("click");
});
$('input[type="file"]').change(function(e) {
  var fileName = e.target.files[0].name;
  $("#file").val(fileName);

  var reader = new FileReader();
  reader.onload = function(e) {
    // get loaded data and render thumbnail.
    document.getElementById("preview").src = e.target.result;
  };
  // read the image file as a data URL.
  reader.readAsDataURL(this.files[0]);
});
</script>  
@show
