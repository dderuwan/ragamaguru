<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'RagamaGuru')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">


    <!-- Bootstrap CSS -->
    <link href="assets/web/website_assets/css/animate.min.css" rel="stylesheet">
      <link href="assets/web/website_assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
      <link href="assets/web/website_assets/plugins/themify/themify-icons.css" rel="stylesheet">
      <link href="assets/web/website_assets/plugins/fontawesome/css/all.min.css" rel="stylesheet">
      <link href="assets/web/website_assets/plugins/owl-carousel/dist/assets/owl.carousel.min.css" rel="stylesheet">
      <link href="assets/sweetalert/sweetalert.css" rel="stylesheet" type="text/css"/>
      <link href="assets/web/website_assets/plugins/owl-carousel/dist/assets/owl.theme.default.min.css" rel="stylesheet">
      <link href="assets/web/website_assets/plugins/select2/dist/css/select2.min.css" rel="stylesheet">
      <link href="assets/web/website_assets/plugins/select2/dist/css/select2-bootstrap.min.css" rel="stylesheet">
      <link href="assets/web/website_assets/plugins/daterangepicker/daterangepicker.css" rel="stylesheet">
      <link href="assets/web/website_assets/plugins/fancybox/dist/jquery.fancybox.min.css" rel="stylesheet">
      <script src="assets/web/website_assets/plugins/jQuery/jquery-3.5.1.min.js"></script>
      <link href="https://fonts.googleapis.com/css?family=Caveat:400,700|Playfair+Display:400,400i,700,700i,900,900i|Sarabun:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800&display=swap" rel="stylesheet" />
      <link href="assets/web/website_assets/css/style.css?v=3" rel="stylesheet">



      <!-- Food cart CSS File -->
    <link href="assets/web/css/foodcart/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/web/css/foodcart/aos/aos.css" rel="stylesheet">
    <link href="assets/web/css/foodcart/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="assets/web/css/foodcart/swiper/swiper-bundle.min.css" rel="stylesheet">
    <link href="assets/web/css/foodcart/main.css" rel="stylesheet">
    <style>
      .navbar {
      z-index: 2;
      padding: 0 1rem;
      background-color: transparent; /* Make navbar transparent */ 
      height: 80px;
      position: absolute; /* Position navbar absolutely */
      top: 0; /* Align to the top */
      width: 100%; /* Full width */
      }
    .nav-link {
        color: #fff !important; /* White color for the links */
    }
    .dropdown-menu{
        width: 50px;
    }
    .dropdown-item{
        width: 10px;
        height:30px;
    }
  


</style>


  </head>
  <body>


<!-- /.End of navbar -->


<nav class="navbar navbar-expand-lg navbar-light header-sticky shadow-sm">
  <div class="container-fluid">
    <a class="navbar-brand" href="#"><img src="assets/img/2023-12-25/I.png" alt=""></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="{{ route('welcome') }}">Entrance</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="{{ route('home') }}">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="{{ route('appointment') }}">Appointments</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="{{ route('store') }}">Online Store</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

  @yield('content')

  <div class="hero-header">
    <div class="header-slider header-slider-preloader slider-two" id="home">
        <div class="animation-slide owl-carousel owl-theme" id="animation-slide">
            <div class="item bg-img-hero" data-image-src="assets/web/images/default.jpeg"></div>
            <div class="item bg-img-hero" data-image-src="/assets/web/images/homeimg3.jpg"></div>
            <div class="item bg-img-hero" data-image-src="assets/web/images/default1.jpg"></div>
        </div>
    </div>
    <!-- /.End of header slider -->
    <div class="container">
        <div class="hero-header_wrap">
            <div class="row align-items-center">
                <div class="col-12 col-md-7">
                    <div class="header-text my-5">
                        <h4 class="header-title">Welcome to Ragama Guru Asapuwa</h4>
                        <p class="header-des mb-0">Meet Guruthuma at Guru Asapuwa<br>
                                        Monday to Saturday and the last Sunday of every month at<br> 8 am</p><br>
                        <h6 class="header-subtitle" style="text-align: left;">BOOK YOUR VISIT</h6>
                        <p class="header-des mb-0">
                                        Fill out the form to schedule your appointment and receive confirmation details via SMS</p>
                                        <ul class="navbar-right d-flex align-items-center mt-4">
                                            <div class="btn-container me-2">
                                                <a href="{{ route('login') }}" id="btn-sign" class="btn btn-primary">SIGN IN</a>
                                            </div>
                                            <div class="btn-container">
                                                <a href="{{ route('register') }}" id="btn-join" class="btn btn-white">JOIN US</a>
                                            </div>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
    <!-- /.End of hero header -->
    <div class="slider_preloader">
        <div class="slider_preloader_status">&nbsp;</div>
    </div>
    <!-- /.End of slider preloader -->
</div>
<!-- /.End of hero header -->

  







    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    
    <script src="assets/web/website_assets/plugins/bootstrap/js/popper.min.js"></script>
    <script src="assets/web/website_assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/web/website_assets/plugins/owl-carousel/dist/owl.carousel.min.js"></script>
    <script src="assets/web/website_assets/plugins/select2/dist/js/select2.min.js"></script>
    <script src="assets/web/website_assets/plugins/daterangepicker/moment.min.js"></script>
    <script src="assets/web/website_assets/plugins/daterangepicker/daterangepicker.js"></script>
    <script src="assets/web/website_assets/plugins/isotope/isotope.pkgd.js"></script>
    <script src="assets/web/website_assets/plugins/fancybox/dist/jquery.fancybox.min.js"></script>
    <script src="assets/web/website_assets/plugins/theia-sticky-sidebar/dist/ResizeSensor.min.js"></script>
    <script src="assets/web/website_assets/plugins/theia-sticky-sidebar/dist/theia-sticky-sidebar.min.js">
    </script>

    <script src="assets/web/website_assets/plugins/numscroller/numscroller-1.0.js"></script>

    <!-- Food Cart JS-->
    <script src="assets/web/js/Food_cart/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/web/js/Food_cart/aos/aos.js"></script>
    <script src="assets/web/js/Food_cart/glightbox/js/glightbox.min.js"></script>
    <script src="assets/web/js/Food_cart/purecounter/purecounter_vanilla.js"></script>
    <script src="assets/web/js/Food_cart/swiper/swiper-bundle.min.js"></script>
    <script src="assets/web/js/Food_cart/php-email-form/validate.js"></script>
    <script src="assets/web/js/Food_cart/main.js"></script>
    
    <!-- sweetalert -->

    <script src="assets/sweetalert/sweetalert.min.js" type="text/javascript"></script>
    <script src="assets/web/website_assets/js/script.js"></script>
    <script src="assets/web/website_assets/js/subscriber_email.js"></script>

    <script src="https://maps.googleapis.com/maps/api/js?key=">

    </script>

    <script src="assets/web/website_assets/js/loadMap.js"></script>


    

  </body>
</html>


