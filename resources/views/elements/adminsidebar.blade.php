<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
      <div class="sidebar-brand-icon rotate-n-15">
        <i class="fas fa-laugh-wink"></i>
      </div>
      <div class="sidebar-brand-text mx-3"> @yield('admintitle','Attendance CMS')</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item 
    @if (Request::segment(1) == "home")
        {{ 'active' }}
    @endif">
      <a class="nav-link" href="{{ route('home')}}">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>{{__("Dashboard")}}</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    {{-- <div class="sidebar-heading">
      Interface
    </div> --}}

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item 
    @if (in_array(Request::segment(1),['employee','department','designation','skill','holiday','attendance','leave']))
        {{ 'active' }}
    @endif">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-fw fa-folder"></i>
        <span>{{__("HR")}}</span>
      </a>
      
      <div id="collapseTwo" class="collapse 
      @if (in_array(Request::segment(1),['employee','department','designation','skill','holiday','attendance','leave']))
          {{ 'show' }}
      @endif"   aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <a class="collapse-item" href="{{ route('employee.index')}}">{{__("Employee")}}</a>
          <a class="collapse-item" href="{{ route('department.index')}}">{{__("Department")}}</a>
          <a class="collapse-item" href="{{ route('designation.index')}}">{{__("Designation")}}</a>
          <a class="collapse-item" href="{{ route('attendance.index')}}">{{__("Attendance")}}</a>
          <a class="collapse-item" href="{{ route('holiday.index')}}">{{__("Holiday")}}</a>
          <a class="collapse-item" href="{{ route('leave.index')}}">{{__("Leaves")}}</a>
          <a class="collapse-item" href="{{ route('skill.index')}}">{{__("Skill")}}</a>
        </div>
      </div>
    </li>

 
    <li class="nav-item 
    @if (in_array(Request::segment(1),['users','roles','permissions']))
        {{ 'active' }}
    @endif">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-fw fa-folder"></i>
        <span>{{__("Users Management")}}</span>
      </a>
      
      <div id="collapseTwo" class="collapse 
      @if (in_array(Request::segment(1),['users','roles','permissions']))
          {{ 'show' }}
      @endif"   aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <a class="collapse-item" href="{{ route('users.index')}}">{{__("Users")}}</a>
          <a class="collapse-item" href="{{ route('roles.index')}}">{{__("Roles")}}</a>
          <a class="collapse-item" href="{{ route('permissions.index')}}">{{__("Permissions")}}</a>
          
        </div>
      </div>
    </li>

 

    <!-- Divider -->
    {{-- <hr class="sidebar-divider"> --}}


    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
      <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

  </ul>
  