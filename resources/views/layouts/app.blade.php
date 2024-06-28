<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Login') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="website_assets/css/animate.min.css" rel="stylesheet">
      <link href="website_assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
      <link href="website_assets/plugins/themify/themify-icons.css" rel="stylesheet">
      <link href="website_assets/plugins/fontawesome/css/all.min.css" rel="stylesheet">
      <link href="website_assets/plugins/owl-carousel/dist/assets/owl.carousel.min.css" rel="stylesheet">
      <link href="assets/sweetalert/sweetalert.css" rel="stylesheet" type="text/css"/>
      <link href="website_assets/plugins/owl-carousel/dist/assets/owl.theme.default.min.css" rel="stylesheet">
      <link href="website_assets/plugins/select2/dist/css/select2.min.css" rel="stylesheet">
      <link href="website_assets/plugins/select2/dist/css/select2-bootstrap.min.css" rel="stylesheet">
      <link href="website_assets/plugins/daterangepicker/daterangepicker.css" rel="stylesheet">
      <link href="website_assets/plugins/fancybox/dist/jquery.fancybox.min.css" rel="stylesheet">
      <script src="website_assets/plugins/jQuery/jquery-3.5.1.min.js"></script>
      <link href="https://fonts.googleapis.com/css?family=Caveat:400,700|Playfair+Display:400,400i,700,700i,900,900i|Sarabun:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800&display=swap" rel="stylesheet" />
      <link href="website_assets/css/style.css?v=3" rel="stylesheet">


      <!-- Food cart CSS File -->
    <link href="assets/css/foodcart/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/css/foodcart/aos/aos.css" rel="stylesheet">
    <link href="assets/css/foodcart/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="assets/css/foodcart/swiper/swiper-bundle.min.css" rel="stylesheet">
    <link href="assets/css/foodcart/main.css" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    
</head>
<body>
    <div id="app">
    @include('includes.navbar')
        

        <main class="py-4">
            @yield('content')
        </main>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- jQuery first, then Popper.js, then Bootstrap JS -->

<script src="website_assets/plugins/bootstrap/js/popper.min.js"></script>
<script src="website_assets/plugins/bootstrap/js/bootstrap.min.js"></script>
<script src="website_assets/plugins/owl-carousel/dist/owl.carousel.min.js"></script>
<script src="website_assets/plugins/select2/dist/js/select2.min.js"></script>
<script src="website_assets/plugins/daterangepicker/moment.min.js"></script>
<script src="website_assets/plugins/daterangepicker/daterangepicker.js"></script>
<script src="website_assets/plugins/isotope/isotope.pkgd.js"></script>
<script src="website_assets/plugins/fancybox/dist/jquery.fancybox.min.js"></script>
<script src="website_assets/plugins/theia-sticky-sidebar/dist/ResizeSensor.min.js"></script>
<script src="website_assets/plugins/theia-sticky-sidebar/dist/theia-sticky-sidebar.min.js">
</script>

<script src="website_assets/plugins/numscroller/numscroller-1.0.js"></script>

<!-- Food Cart JS-->
<script src="assets/js/Food_cart/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/Food_cart/aos/aos.js"></script>
<script src="assets/js/Food_cart/glightbox/js/glightbox.min.js"></script>
<script src="assets/js/Food_cart/purecounter/purecounter_vanilla.js"></script>
<script src="assets/js/Food_cart/swiper/swiper-bundle.min.js"></script>
<script src="assets/js/Food_cart/php-email-form/validate.js"></script>
<script src="assets/js/Food_cart/main.js"></script>

<!-- sweetalert -->

<script src="assets/sweetalert/sweetalert.min.js" type="text/javascript"></script>
<script src="website_assets/js/script.js"></script>
<script src="website_assets/js/subscriber_email.js"></script>

<script src="https://maps.googleapis.com/maps/api/js?key=">

</script>

<script src="website_assets/js/loadMap.js"></script>
</body>
</html>
