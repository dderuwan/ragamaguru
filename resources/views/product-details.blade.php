

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



    <link href="assets/web/css/foodcart/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/web/css/foodcart/aos/aos.css" rel="stylesheet">
    <link href="assets/web/css/foodcart/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="assets/web/css/foodcart/swiper/swiper-bundle.min.css" rel="stylesheet">
    <link href="assets/web/css/foodcart/main.css" rel="stylesheet">

  </head>
  <body>


  @include('includes.navbar')
  @yield('content')

         

  <div class="card">
    <div class="card-body">
        <div class="section section-about">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-5 col-md-6 col-12">
                        <div class="position-relative">
                            <img src="assets/web/images/image3.jpg"
                                class="rounded img-fluid mx-auto d-block" alt="" style="height: 400px;">
                            <div class="play-icon">
                                <a href="" class="play-btn video-play-icon">
                                    <i class="mdi mdi-play text-primary rounded-circle bg-white shadow"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <!--end col-->

                    <div class="col-lg-7 col-md-6 col-12 mt-4 mt-sm-0 pt-2 pt-sm-0">
                        <div class="ml-lg-5 ml-md-4">
                            <div class="section-title">
                                <h4 class="title">Product 01<span class="text-primary"></span></h4>
                                <p class="section-price text-primary para-desc mx-auto mb-0">Rs 100.00</p>
                                <div class="mt-4">
                                    <a href="#" class="btn btn-primary">We provide</a>
                                </div>
                                <span class="badge badge-pill badge-soft-primary">About</span>
                            </div>
                        </div>
                    </div>
                    <!--end col-->
                </div>
                <!--end row-->
            </div>
            <!--end container-->
        </div>
        <!--end section section-about-->
    </div>
</div>





                   

          

            

             


 





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



    @include('includes.footer')

  </body>
</html>


