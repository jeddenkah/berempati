<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
  <meta name="author" content="Creative Tim">
  <title>@yield('title') - {{ config('app.name', 'Laravel') }}</title>
  <!-- Favicon -->
  <link rel="icon" href="/img/brand/favicon.png" type="image/png">
  <!-- Fonts -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
  <!-- Icons -->
  <link rel="stylesheet" href="/vendor/nucleo/css/nucleo.css" type="text/css">
  <link rel="stylesheet" href="/vendor/@fortawesome/fontawesome-free/css/all.min.css" type="text/css">
  <!-- Page plugins -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
  <!-- Argon CSS -->
  <link rel="stylesheet" href="/css/argon.css?v=1.2.0" type="text/css">
  @stack('css')
</head>

<body>
    @yield('main')
  <!-- Argon Scripts -->
  <!-- Core -->
  <script src="/vendor/jquery/dist/jquery.min.js"></script>
  <script src="/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="/vendor/js-cookie/js.cookie.js"></script>
  <script src="/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
  <script src="/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
  
  {!! Toastr::message() !!}
  <!-- Optional JS -->
  @stack('js')
  <script src="/vendor/chart.js/dist/Chart.min.js"></script>
  <script src="/vendor/chart.js/dist/Chart.extension.js"></script>
  <!-- Argon JS -->
  <script src="/js/argon.js?v=1.2.0"></script>
</body>

</html>
