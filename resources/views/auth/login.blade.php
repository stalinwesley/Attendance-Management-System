@extends('layouts.appcrater')

@section('content')


<div class="login-page login-3">
  <div class="site-wrapper"><div class="login-box"><div class="box-wrapper"><div class="logo-main"><a href="/admin"><img src="{{ asset('img/company.jpg')}}" alt="Pranion Logo"></a></div> <form id="loginForm" action="{{ route('login') }}" method="POST">
    @csrf

    <div class="form-group">
      <p class="input-label">Email <span class="text-danger"> * </span></p> 
      <div class="base-input " focus=""><!----> 
        <input name="email" tabindex="" placeholder="" autocomplete="on" type="email" class="input-field {{ $errors->has('email') ? 'invalid' : ''}}" value="{{ old('email') }}"> <!----> <!----></div> 
        @error('email')
                    <span class="text-danger">
                        {{ $message }}
                    </span>
                    @enderror
        <!----></div> 
        <div class="form-group"><p class="input-label">Password <span class="text-danger"> * </span></p> <div class="base-input"><!----> <input name="password" tabindex="" placeholder="" autocomplete="on" type="password" class="input-field {{ $errors->has('password') ? 'invalid' : ''}}"> 
          
          <div style="cursor: pointer;"><svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="eye" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" class="right-icon svg-inline--fa fa-eye fa-w-18"><path fill="currentColor" d="M572.52 241.4C518.29 135.59 410.93 64 288 64S57.68 135.64 3.48 241.41a32.35 32.35 0 0 0 0 29.19C57.71 376.41 165.07 448 288 448s230.32-71.64 284.52-177.41a32.35 32.35 0 0 0 0-29.19zM288 400a144 144 0 1 1 144-144 143.93 143.93 0 0 1-144 144zm0-240a95.31 95.31 0 0 0-25.31 3.79 47.85 47.85 0 0 1-66.9 66.9A95.78 95.78 0 1 0 288 160z" class=""></path></svg></div> <!----></div>
          @error('password')
          <span class="text-danger">
              {{ $message }}
          </span>
          @enderror
          <!----></div>
          <div class="form-group custom-control custom-checkbox">
          <input type="checkbox" class="custom-control-input {{ $errors->has('remember') ? 'invalid' : ''}}" id="customCheck" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
          <label class="custom-control-label" for="customCheck">Remember Me</label>

          </div>
          <div class="other-actions row"><div class="col-sm-12 text-sm-left mb-4"><a href="{{ route('password.request') }}" class="forgot-link">
Forgot Password?
</a></div></div> 

<button type="submit" id="loginsubmit" class="base-button btn btn-primary default-size ">
  <!----> <!----> Login <!----></button></form> </div></div> <div class="content-box"><h1>Super Simple Invoicing<br>
for Freelancers &amp;<br>
Small Businesses  <br></h1> <p>
Crater helps you track expenses, record payments &amp; generate beautiful<br>
invoices &amp; estimates with ability to choose multiple templates.<br></p> <div class="content-bottom"></div></div></div></div>
@endsection

@section('javascript')
    <script>
      $(document).ready(function(){
    $("#loginsubmit").click(function(){
    pace.start();
    });
});

    </script>
@endsection
