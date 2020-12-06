  @extends('layouts.app')
  @section('main')
      <!-- Sidenav -->
  <!-- Main content -->
  <div class="main-content" id="panel">
    <!-- Topnav -->
    @include('layouts.navbar')
    <!-- Header -->
    <!-- Header -->
    <div class="header bg-primary pb-6">
      <div class="container-fluid">
        @yield('header')
      </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--6">
        @yield('content')
      <!-- Footer -->
      @include('layouts.footer')
    </div>
  </div>
  @endsection
  