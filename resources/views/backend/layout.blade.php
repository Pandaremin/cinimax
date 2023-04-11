<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="" name="description">
  <meta content="" name="keywords">

  <title>@yield('title')</title>
  
  <!-- Favicons -->
  <link rel="icon" type="image/x-icon" href="{{asset('/assets/img/cinimaxfavicon.png')}}">
  <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/apple-toucininetlogo.png') }}">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  
  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Inter" rel="stylesheet">
  
  <!-- Bootstrap Css -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

  <!-- Vendor CSS Files -->
  <link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/vendor/simple-datatables/style.css') }}">
  
  <!-- Alertify -->
  <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
  <!-- CSS -->
  <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
  <!-- Default theme -->
  <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css"/>
  <!-- Semantic UI theme -->
  <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/semantic.min.css"/>
  <!-- Bootstrap theme -->
  <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css"/>

  <!-- Bootstrap select -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
  
  <!-- Template Main CSS File -->
  <link rel="stylesheet" href="{{ asset('assets/css/stylee.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

</head>
<body>

  <!-- ======= Header ======= -->
  @include('backend.header')
  <!-- End Header -->

  <!-- ======= Sidebar ======= -->
  @include('backend.sidebar')
  <!-- End Sidebar-->

  <!-- ======= Main ======= -->

  <main id="main" class="main">
  @yield('main')
  </main>
  
  <!-- End #main -->

  <!-- ======= Footer ======= -->
  @include('backend.footer')
  <!-- End Footer -->

  <!-- ======= Back to top ======= -->
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
  <!-- End Back to top -->

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  
  <!-- Vendor JS Files -->
  <script type="text/javascript" src="{{asset('assets/vendor/simple-datatables/simple-datatables.js')}}"></script>
  <script src="{{ asset('assets/vendor/simple-datatables/simple-datatables.js')}}"></script>
  <script src="{{ asset('assets/vendor/tinymce/tinymce.min.js')}}"></script>
  <script src="{{ asset('assets/js/jquery.min.js')}}"></script>
  <script src="{{ asset('assets/js/popper.js')}}"></script>
  <script src="{{ asset('assets/js/bootstrap.min.js')}}"></script>
  <script src="{{ asset('assets/js/mainn.js')}}"></script>

  <!-- Bootstrap select -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
  
  <!-- Template Main JS File -->
  <script type="text/javascript" src="{{asset('assets/js/main.js')}}"></script>
  

  <script>
  @if(Session::has('message'))
  var type = "{{ Session::get('alert-type','info') }}"
  switch(type){
      case 'info':
        alertify.info('{{ Session::get('message') }}');
      break;

      case 'success':
        alertify.set('notifier','position', 'top-right');
        alertify.success('{{ Session::get('message') }}');
      break;

      case 'warning':
        alertify.warning('{{ Session::get('message') }}');
      break;

      case 'error':
        alertify.error('{{ Session::get('message') }}');
      break; 
  }
  @endif 
  </script>

</body>

</html>