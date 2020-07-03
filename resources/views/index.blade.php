<!DOCTYPE html>
<html lang="es">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1 maximum-scale=1.0"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Sistema Biométrico</title>
    <link rel="stylesheet" href="{{ asset('css/sb-admin-2.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/dataTables.bootstrap4.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('font-awesome/css/all.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}"/>
    <!--link rel="shortcut icon" type="image/x-icon" href="{{ asset('img/icon.png') }}"/-->
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>
  </head>
  <body class="bg-gray-100" id="page-top">
      @yield('content')
      <footer class="sticky-footer">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; Tecnotronik {{ now()->year }}</span>
          </div>
        </div>
      </footer>
  </body>
  <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('js/jquery.easing.compatibility.js') }}"></script>
  <script src="{{ asset('js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('js/jquery.easing.min.js') }}"></script>
  <script src="{{ asset('js/Chart.min.js') }}"></script>
  <script src="{{ asset('js/Chart.bundle.min.js') }}"></script>
  <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('js/dataTables.bootstrap4.min.js') }}"></script>
  <!--
  <script src="{{ asset('js/chart-area-demo.js') }}"></script>
  <script src="{{ asset('js/chart-pie-demo.js') }}"></script>
  -->
</html>