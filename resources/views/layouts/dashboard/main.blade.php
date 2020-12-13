  @extends('layouts.app2')
  @section('main')
      <!-- Sidenav -->
      @include('layouts.dashboard.sidebar')
  <!-- Main content -->
  <div class="main-content" id="panel">
    <!-- Topnav -->
    @include('layouts.dashboard.navbar')
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
      @include('layouts.dashboard.footer')
    </div>
  </div>
  @endsection
  