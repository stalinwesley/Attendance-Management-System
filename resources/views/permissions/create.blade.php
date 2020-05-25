@extends('layouts.appadmin')
@section('css')
<link rel="stylesheet" href="{{ asset('css/crater.css') }}">
    
@show

@section('content')
<div class="col-xl-8 col-lg-7">
    <div class="card shadow mb-4">
      <!-- Card Header - Dropdown -->
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Add Permission</h6>
       
      </div>
      <!-- Card Body -->
      <div class="card-body">
        
      <form class="user" method="POST" action="{{ route('permissions.store')}}" >
            @csrf

            @component('components.input',[
                'type'=>'text',
                'name'=>'title',
                'placeholder'=>'Enter name...',
                ])
                
            @endcomponent

                
              <div class="form-group">
                <button type="submit" class="btn btn-primary">
                  Save
              </button>
                </div>
        </form>
      </div>
    </div>
  </div> 
@endsection