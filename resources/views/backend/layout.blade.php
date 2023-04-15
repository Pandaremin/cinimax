<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="" name="description">
  <meta content="" name="keywords">

  <title>@yield('title')</title>

  <!-- Favicons -->
  <link rel="icon" type="image/x-icon" href="/assets/img/cinimaxfavicon.png">
  <link rel="icon" type="image/x-icon" href="/assets/img/apple-toucininetlogo.png">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  
  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Inter" rel="stylesheet">
  
  <!-- Bootstrap Css -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">  <!-- Vendor CSS Files -->
  <link rel="stylesheet" href="/assets/vendor/bootstrap-icons/bootstrap-icons.css">
  <link rel="stylesheet" href="/assets/vendor/simple-datatables/style.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
  
  <!-- Bootstrap select -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
  
  <!-- Template Main CSS File -->
  <link rel="stylesheet" href="/assets/css/stylee.css">
  <link rel="stylesheet" href="/assets/css/style.css">

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
  <!--  StartSweet Alert -->
  @include('sweetalert::alert')
  <!-- End Sweet Alert -->
  <!-- ======= Back to top ======= -->
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
  <!-- End Back to top -->

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.0/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.full.min.js"></script>
  <!-- Vendor JS Files -->
  <script src="/assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="/assets/vendor/tinymce/tinymce.min.js"></script>
  <!-- <script src="/assets/js/jquery.min.js"></script>
  <script src="/assets/js/popper.js"></script>
  <script src="/assets/js/bootstrap.min.js"></script>
  <script src="/assets/js/mainn.js"></script> -->

  <!-- Bootstrap select -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
  
  <!-- Template Main JS File -->
  <script type="text/javascript" src="{{asset('assets/js/main.js')}}"></script>
  
  @stack('scripts')
</body>
</html>