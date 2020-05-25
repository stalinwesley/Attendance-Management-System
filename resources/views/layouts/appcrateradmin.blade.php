<!DOCTYPE html>
<html lang="en">
    <head>
        <script src="{{ asset('js/pace.js')}}"></script>
        <link rel="stylesheet" href="{{ asset('css/pace.css')}}">
        <script>    
        pace.start();
        </script>
        <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="">
  <meta name="author" content="">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title> @yield('title','Home')</title>
  <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600&amp;display=swap" rel="stylesheet">

  <style type="text/css">
    .fade-enter-active, .fade-leave-active {
      transition: opacity .5s;
    }
    .fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
      opacity: 0;
    }
    </style>

    <link rel="stylesheet" href="{{ asset('css/crater.css')}}">
    <link rel="stylesheet" href="{{ asset('css/sweet.css')}}">
    @yield('css')
  
</head>
<body class="skin-crater layout-default">
    <div class="pace  pace-inactive"><div class="pace-progress" data-progress-text="100%" data-progress="99" style="transform: translate3d(100%, 0px, 0px);">
        <div class="pace-progress-inner"></div>
      </div>
      <div class="pace-activity"></div></div>

      <div id="app" class="template-container">
          <div class="mobile-menu-overlay"></div>
          <div class="template-container">
              @include('layouts.elements.header') 
              @include('layouts.elements.sidebar') 
              @yield('content')
              @include('layouts.elements.footer') 
        </div>
      </div>
  <script src="{{ asset('vendor/jquery/jquery.min.js')}}"></script>

  @yield('javascript')

</body>
</html>