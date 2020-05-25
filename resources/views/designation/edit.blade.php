@extends('layouts.appadmin')
@section('content')
<div class="col-xl-8 col-lg-7">
    <div class="card shadow mb-4">
      <!-- Card Header - Dropdown -->
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Edit Designation</h6>
       
      </div>
      <!-- Card Body -->
      <div class="card-body">
        
      <form class="user" method="POST" action="{{ route('designation.update',$designation->id)}}" >
            @csrf
@method('patch')
@section('css')
<link rel="stylesheet" href="{{ asset('css/crater.css') }}">
    
@show
<div class="form-group base-input">
  <input 
    class="input-field " id="name" type=" text "
  aria-describedby="emailHelp" 
  placeholder="Enter name..." 
  name="name"
value="{{ old('name',$designation->name) }}"  >
      </div>  
  
            <div class="form-group">
 
      </div>  
                <div class="form-group">
                <button type="submit" class="btn btn-primary">
                  Edit
              </button>
                </div>
        </form>
      </div>
    </div>
  </div> 
@endsection