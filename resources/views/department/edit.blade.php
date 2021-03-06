@extends('layouts.appadmin')
@section('css')
<link rel="stylesheet" href="{{ asset('css/crater.css') }}">
    
@show
@section('content')
<div class="col-xl-8 col-lg-7">
    <div class="card shadow mb-4">
      <!-- Card Header - Dropdown -->
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Edit Department</h6>
       
      </div>
      <!-- Card Body -->
      <div class="card-body">
        
      <form class="user" method="POST" action="{{ route('department.update',$department->id)}}" >
            @csrf
@method('patch')

<div class="form-group base-input">
  <input 
    class="input-field " id="name" type=" text "
  aria-describedby="emailHelp" 
  placeholder="Enter name..." 
  name="name"
value="{{ old('name',$department->name) }}"  >
      </div>  
  
            <div class="form-group base-input">
  <textarea 
    class="input-field " 
  id="notes" 
  aria-describedby="emailHelp" 
  placeholder="Enter the notes..." 
  name="notes"
  style="height: 100px"
> 
{{   old('notes',$department->notes)}}
</textarea>
      </div>  
                <div class="form-group">
                <button type="submit" class="btn btn-primary">
                  Update
              </button>
                </div>
        </form>
      </div>
    </div>
  </div> 
@endsection