<!doctype html>
<html lang="en" class="light-theme">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- loader-->
  <link href="{{ asset('/theme/css/pace.min.css') }}" rel="stylesheet" />
  <script src="{{ asset('/theme/js/pace.min.js') }}"></script>

  <!--plugins-->
  <link href="{{ asset('/theme/plugins/perfect-scrollbar/css/perfect-scrollbar.css') }}" rel="stylesheet" />

  <!-- CSS Files -->
  <link href="{{ asset('/theme/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('/theme/css/bootstrap-extended.css') }}" rel="stylesheet">
  <link href="{{ asset('/theme/css/style.css') }}" rel="stylesheet">
  <link href="{{ asset('/theme/css/icons.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">

  <title>@yield('title')</title>
</head>

<body class="bg-white">

  <!--start wrapper-->
  <div class="wrapper">
    <div class="">
      @yield('content')
      <!--end row-->
    </div>
  </div>
  <!--end wrapper-->


</body>

</html>