<!doctype html>
<html lang="en" class="semi-dark">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- loader-->
  <link href="{{ asset('/theme/css/pace.min.css') }}" rel="stylesheet" />
  <script src="{{ asset('/theme/js/pace.min.js') }}"></script>

  <!--plugins-->
  <link href="{{ asset('/theme/plugins/vectormap/jquery-jvectormap-2.0.2.css') }}" rel="stylesheet"/>
  <link href="{{ asset('/theme/plugins/simplebar/css/simplebar.css') }}" rel="stylesheet" />
  <link href="{{ asset('/theme/plugins/perfect-scrollbar/css/perfect-scrollbar.css') }}" rel="stylesheet" />
  <link href="{{ asset('/theme/plugins/metismenu/css/metisMenu.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('/theme/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('/theme/plugins/select2/css/select2.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('/theme/plugins/select2/css/select2-bootstrap4.css') }}" rel="stylesheet" />

  <!-- CSS Files -->
  <link href="{{ asset('/theme/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('/theme/css/bootstrap-extended.css') }}" rel="stylesheet">
  <link href="{{ asset('/theme/css/style.css') }}" rel="stylesheet">
  <link href="{{ asset('/theme/css/icons.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">

  <!--Theme Styles-->
  <link href="{{ asset('/theme/css/dark-theme.css') }}" rel="stylesheet" />
  <link href="{{ asset('/theme/css/semi-dark.css') }}" rel="stylesheet" />
  <link href="{{ asset('/theme/css/header-colors.css') }}" rel="stylesheet" />

  {{-- APP CSS --}}
  <link href="{{ asset('/css/vendor.css') }}" rel="stylesheet" />
  <link href="{{ asset('/css/app.css') }}" rel="stylesheet" />

  <title>Blackdash - Bootstrap5 Admin Template</title>
</head>

<body>


  <!--start wrapper-->
  <div class="wrapper">


    {{-- SIDEBAR  --}}
    @include('layouts.sidebar')

    {{-- TOP HEADER --}}
    @include('layouts.top-header')
    


    <!-- start page content wrapper-->
    <div class="page-content-wrapper">
      <!-- start page content-->
      <div class="page-content">

        {{-- BREADCRUMB --}}
        @include('layouts.breadcrumb')

        {{-- CONTENT --}}
        @yield('content')

      </div>
      <!-- end page content-->
    </div>
    <!--end page content wrapper-->


    <!--start footer-->
    <footer class="footer">
      <div class="footer-text">
        ITtexx. Копірайт © {{ date('Y') }}. Всі права захищені.
      </div>
    </footer>
    <!--end footer-->


    <!--Start Back To Top Button-->
    <a href="javaScript:;" class="back-to-top">
      <ion-icon name="arrow-up-outline"></ion-icon>
    </a>
    <!--End Back To Top Button-->

    {{-- Switcher --}}
    @include('layouts.switcher')


    <!--start overlay-->
    <div class="overlay nav-toggle-icon"></div>
    <!--end overlay-->

  </div>
  <!--end wrapper-->

  <!-- JS Files-->
  <script src="{{ asset('/theme/js/jquery.min.js') }}"></script>
  <script src="{{ asset('/theme/plugins/simplebar/js/simplebar.min.js') }}"></script>
  <script src="{{ asset('/theme/plugins/metismenu/js/metisMenu.min.js') }}"></script>
  <script src="{{ asset('/theme/js/bootstrap.bundle.min.js') }}"></script>
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <!--plugins-->
  <script src="{{ asset('/theme/plugins/perfect-scrollbar/js/perfect-scrollbar.js') }}"></script>
  <script src="{{ asset('/theme/plugins/vectormap/jquery-jvectormap-2.0.2.min.js') }}"></script>
  <script src="{{ asset('/theme/plugins/vectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
  <script src="{{ asset('/theme/plugins/apexcharts-bundle/js/apexcharts.min.js') }}"></script>
  <script src="{{ asset('/theme/plugins/chartjs/chart.min.js') }}"></script>
  <script src="{{ asset('/theme/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('/theme/plugins/datatable/js/dataTables.bootstrap5.min.js') }}"></script>
  <script src="{{ asset('/theme/plugins/select2/js/select2.min.js') }}"></script>

  @if(Route::currentRouteName() == 'dashboard.index')
    <script src="{{ asset('/theme/js/index.js') }}"></script>
  @endif
  <!-- Main JS-->
  <script src="{{ asset('/theme/js/main.js') }}"></script>

  {{-- APP JS --}}
  <script src="{{ asset('/js/app.js') }}"></script>



</body>

</html>