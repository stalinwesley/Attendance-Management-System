@extends('layouts.appadmin')
@section('css')
<link rel="stylesheet" href="{{ asset('css/crater.css') }}">
    
@show
@section('content')
<div class="col-xl-10 col-lg-10">
    <div class="card shadow mb-4">
      <!-- Card Header - Dropdown -->
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Add Department</h6>
       
      </div>
      <!-- Card Body -->
      <div class="card-body">
        
      <form class="user" method="POST" action="{{ route('department.store')}}" >
            @csrf

            @component('components.input',[
                'type'=>'text',
                'name'=>'name',
                'placeholder'=>'Enter name...',
                ])
                
            @endcomponent

            @component('components.inputtext',[
                'name'=>'notes',
                'placeholder'=>'Enter the notes...',
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