

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'RagamaGuru')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">


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

  </head>
  <body>


  @include('includes.navbar')
  @yield('content')






<div class="section section-feature bg-gray position-relative">
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-md-3 mb-4 mb-md-0">
                <div class="feature-box text-center">                   
                    <div class="feature-box-icon mb-3">
                    <img src="assets\img\banner\2023-08-30\i.png"
                            alt="Card image" class="img-fluid">
                    </div>
                    <h4 class="feature-box-title fs-21 font-weight-600">Premium Facilities</h4>
                    <p class="mb-0">Indulge in luxury at our resort's Premium Facilities, 
                      where opulent comfort meets exceptional service for an unforgettable retreat.</p>
                </div>
            </div>
            <!-- /.End of feature -->

            <div class="col-sm-6 col-md-3 mb-4 mb-md-0">
                <div class="feature-box text-center">
                    <div class="feature-box-icon mb-3">
                        <img src="assets\img\banner\2023-08-30\i1.png"
                            alt="Card image" class="img-fluid">
                    </div>
                    <h4 class="feature-box-title fs-21 font-weight-600">Delicious Foods
                    </h4>
                    <p class="mb-0">Savor exquisite flavors at our resort's Delicious Foods, 
                      where culinary artistry transforms every meal into a delectable experience.</p>
                </div>
            </div>
            <!-- /.End of feature -->

            <div class="col-sm-6 col-md-3 mb-4 mb-sm-0">
                <div class="feature-box text-center">
                    <div class="feature-box-icon mb-3">
                    <img src="assets\img\banner\2023-08-30\i2.png"
                            alt="Card image" class="img-fluid">
                    </div>
                    <h4 class="feature-box-title fs-21 font-weight-600">Free Wi-Fi
                    </h4>
                    <p class="mb-0">Stay connected seamlessly with complimentary Wi-Fi at our resort, 
                      ensuring you're always in touch while you unwind.</p>
                </div>
            </div>
            <!-- /.End of feature -->

            <div class="col-sm-6 col-md-3">
                <div class="feature-box text-center">
                    <div class="feature-box-icon mb-3">
                    <img src="assets\img\banner\2023-08-30\i3.png"
                            alt="Card image" class="img-fluid">
                    </div>
                    <h4 class="feature-box-title fs-21 font-weight-600">Swimming Pool
                    </h4>
                    <p class="mb-0">Dive into relaxation at our resort's refreshing pool, 
                      the perfect oasis to soak up leisure and sun.</p>
                </div>
            </div>
            <!-- /.End of feature -->
        </div>
    </div>
</div>
<!-- /.End of feature -->

<div class="section section-about">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-5 col-md-6 col-12">
                <div class="position-relative">
                <img src="assets\img\banner\2023-08-30\W1.jpg"
                        class="rounded img-fluid mx-auto d-block" alt=""  style="height: 400px;">
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
                        <span class="badge badge-pill badge-soft-primary">About</span>
                        <h4 class="title mt-3 mb-4">Comfort are Perfectly Combined Here<span class="text-primary"></span></h4>
                        <p class="text-muted para-desc mx-auto mb-0">This charming private 21th-century mansion, which originally belonged to the family, has been completely renovated with care &amp; 
                          passion while respecting the spirit of place. SRI LANKA BEACH HOTEL AND SPA</p>
                        <div class="mt-4">
                            <a href="#" class="btn btn-primary">We provide</a>
                        </div>
                    </div>
                </div>
              </div>
</div>
</div>
</div>

<div class="section container rounded join-content box-shadow mb-5 shadow">
    <div class="text-center col-middle">
        <h2 class="fs-32 text-white mb-4 ">This charming private 19th century mansion, which originally</h2>
        <a href="user/login" class="btn btn-outline-white mr-3">Sign In</a>
        <a href="register" class="btn btn-white">Join Us</a>
    </div>
</div>
<!-- /.End of join box -->


<!-- Products-->
<div class="section bg-gray">
    <div class="container">
        <div class="row">
            <div class="col-md-10 offset-md-1">
                <div class="section-title text-center mb-5 col-middle">
                    <h1 class="block-title fs-25 mb-2 font-weight-bold">Products
                    </h1>
                    <div class="sub-title fs-18">
                    A resort is a self-contained destination that can provide for all of your travel needs in one location.
                    </div>
                </div>
                <!-- /.End of section title -->
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="card border-0 box-shadow rounded-0 mb-4">
                <a href="" class="card-img position-relative">
                        <img src="assets/img/Home-page/below_slider_second.png" class="img-fluid wd_xs_100" alt="...">
                        <button type="button"
                            class="position-absolute btn btn-primary btn-sm">Buy</button>
                    </a>
                    <div class="card-body">
                        <h5 class="card-title mb-0 weeklyoffer-title"><a href=""
                                class="text-dark"></a></h5>
                    </div>
                </div>
                <!-- /.End of card -->
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="card border-0 box-shadow rounded-0 mb-4">
                <a href="" class="card-img position-relative">
                        <img src="assets/img/Home-page/below_slider_second.png" class="img-fluid wd_xs_100" alt="...">
                        <button type="button"
                            class="position-absolute btn btn-primary btn-sm">Buy</button>
                    </a>
                    <div class="card-body">
                        <h5 class="card-title mb-0 weeklyoffer-title"><a href=""
                                class="text-dark"></a></h5>
                    </div>
                </div>
                <!-- /.End of card -->
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="card border-0 box-shadow rounded-0 mb-4">
                <a href="" class="card-img position-relative">
                        <img src="assets/img/Home-page/below_slider_second.png" class="img-fluid wd_xs_100" alt="...">
                        <button type="button"
                            class="position-absolute btn btn-primary btn-sm">Buy</button>
                    </a>
                    <div class="card-body">
                        <h5 class="card-title mb-0 weeklyoffer-title"><a href=""
                                class="text-dark"></a></h5>
                    </div>
                </div>
                <!-- /.End of card -->
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="card border-0 box-shadow rounded-0 mb-4">
                <a href="" class="card-img position-relative">
                        <img src="assets/img/Home-page/below_slider_second.png" class="img-fluid wd_xs_100" alt="...">
                        <button type="button"
                            class="position-absolute btn btn-primary btn-sm">Buy</button>
                    </a>
                    <div class="card-body">
                        <h5 class="card-title mb-0 weeklyoffer-title"><a href=""
                                class="text-dark"></a></h5>
                    </div>
                </div>
                <!-- /.End of card -->
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="card border-0 box-shadow rounded-0 mb-4">
                <a href="" class="card-img position-relative">
                        <img src="assets/img/Home-page/below_slider_second.png" class="img-fluid wd_xs_100" alt="...">
                        <button type="button"
                            class="position-absolute btn btn-primary btn-sm">Buy</button>
                    </a>
                    <div class="card-body">
                        <h5 class="card-title mb-0 weeklyoffer-title"><a href=""
                                class="text-dark"></a></h5>
                    </div>
                </div>
                <!-- /.End of card -->
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="card border-0 box-shadow rounded-0 mb-4">
                <a href="" class="card-img position-relative">
                        <img src="assets/img/Home-page/below_slider_second.png" class="img-fluid wd_xs_100" alt="...">
                        <button type="button"
                            class="position-absolute btn btn-primary btn-sm">Buy</button>
                    </a>
                    <div class="card-body">
                        <h5 class="card-title mb-0 weeklyoffer-title"><a href=""
                                class="text-dark"></a></h5>
                    </div>
                </div>
                <!-- /.End of card -->
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="card border-0 box-shadow rounded-0 mb-4">
                <a href="" class="card-img position-relative">
                        <img src="assets/img/Home-page/below_slider_second.png" class="img-fluid wd_xs_100" alt="...">
                        <button type="button"
                            class="position-absolute btn btn-primary btn-sm">Buy</button>
                    </a>
                    <div class="card-body">
                        <h5 class="card-title mb-0 weeklyoffer-title"><a href=""
                                class="text-dark"></a></h5>
                    </div>
                </div>
                <!-- /.End of card -->
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="card border-0 box-shadow rounded-0 mb-4">
                <a href="" class="card-img position-relative">
                        <img src="assets/img/Home-page/below_slider_second.png" class="img-fluid wd_xs_100" alt="...">
                        <button type="button"
                            class="position-absolute btn btn-primary btn-sm">Buy</button>
                    </a>
                    <div class="card-body">
                        <h5 class="card-title mb-0 weeklyoffer-title"><a href=""
                                class="text-dark"></a></h5>
                    </div>
                </div>
                <!-- /.End of card -->
            </div>
         
        </div>
    </div>
</div>



<section id="menu" class="menu">
      <div class="container" data-aos="fade-up">

        <div class="section-header">
          <h2>Our Menu</h2>
          <p>Check Our <span>Yummy Menu</span></p>
        </div>

        <ul class="nav nav-tabs d-flex justify-content-center" data-aos="fade-up" data-aos-delay="200">

          <li class="nav-item">
            <a class="nav-link active show" data-bs-toggle="tab" data-bs-target="#menu-starters">
              <h4>Starters</h4>
            </a>
          </li><!-- End tab nav item -->

          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" data-bs-target="#menu-breakfast">
              <h4>Breakfast</h4>
            </a><!-- End tab nav item -->

          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" data-bs-target="#menu-lunch">
              <h4>Lunch</h4>
            </a>
          </li><!-- End tab nav item -->

          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" data-bs-target="#menu-dinner">
              <h4>Dinner</h4>
            </a>
          </li><!-- End tab nav item -->

        </ul>

        <div class="tab-content" data-aos="fade-up" data-aos-delay="300">

          <div class="tab-pane fade active show" id="menu-starters">

            <div class="tab-header text-center">
              <p>Menu</p>
              <h3>Starters</h3>
            </div>

            <div class="row gy-5">

              <div class="col-lg-4 menu-item">
                <a href="assets/img/Food_cart/menu/menu-item-1.png" class="glightbox"><img src="assets/img/Food_cart/menu/menu-item-1.png" class="menu-img img-fluid" alt=""></a>
                <h4>Magnam Tiste</h4>
                <p class="ingredients">
                  Lorem, deren, trataro, filede, nerada
                </p>
                <p class="price">
                  $5.95
                </p>
              </div><!-- Menu Item -->

              <div class="col-lg-4 menu-item">
                <a href="assets/img/Food_cart/menu/menu-item-2.png" class="glightbox"><img src="assets/img/Food_cart/menu/menu-item-2.png" class="menu-img img-fluid" alt=""></a>
                <h4>Aut Luia</h4>
                <p class="ingredients">
                  Lorem, deren, trataro, filede, nerada
                </p>
                <p class="price">
                  $14.95
                </p>
              </div><!-- Menu Item -->

              <div class="col-lg-4 menu-item">
                <a href="assets/img/Food_cart/menu/menu-item-3.png" class="glightbox"><img src="assets/img/Food_cart/menu/menu-item-3.png" class="menu-img img-fluid" alt=""></a>
                <h4>Est Eligendi</h4>
                <p class="ingredients">
                  Lorem, deren, trataro, filede, nerada
                </p>
                <p class="price">
                  $8.95
                </p>
              </div><!-- Menu Item -->

              <div class="col-lg-4 menu-item">
                <a href="assets/img/Food_cart/menu/menu-item-4.png" class="glightbox"><img src="assets/img/Food_cart/menu/menu-item-4.png" class="menu-img img-fluid" alt=""></a>
                <h4>Eos Luibusdam</h4>
                <p class="ingredients">
                  Lorem, deren, trataro, filede, nerada
                </p>
                <p class="price">
                  $12.95
                </p>
              </div><!-- Menu Item -->

              <div class="col-lg-4 menu-item">
                <a href="assets/img/Food_cart/menu/menu-item-5.png" class="glightbox"><img src="assets/img/Food_cart/menu/menu-item-5.png" class="menu-img img-fluid" alt=""></a>
                <h4>Eos Luibusdam</h4>
                <p class="ingredients">
                  Lorem, deren, trataro, filede, nerada
                </p>
                <p class="price">
                  $12.95
                </p>
              </div><!-- Menu Item -->

              <div class="col-lg-4 menu-item">
                <a href="assets/img/Food_cart/menu/menu-item-6.png" class="glightbox"><img src="assets/img/Food_cart/menu/menu-item-6.png" class="menu-img img-fluid" alt=""></a>
                <h4>Laboriosam Direva</h4>
                <p class="ingredients">
                  Lorem, deren, trataro, filede, nerada
                </p>
                <p class="price">
                  $9.95
                </p>
              </div><!-- Menu Item -->

            </div>
          </div><!-- End Starter Menu Content -->

          <div class="tab-pane fade" id="menu-breakfast">

            <div class="tab-header text-center">
              <p>Menu</p>
              <h3>Breakfast</h3>
            </div>

            <div class="row gy-5">

              <div class="col-lg-4 menu-item">
                <a href="assets/img/Food_cart/menu/menu-item-1.png" class="glightbox"><img src="assets/img/Food_cart/menu/menu-item-1.png" class="menu-img img-fluid" alt=""></a>
                <h4>Magnam Tiste</h4>
                <p class="ingredients">
                  Lorem, deren, trataro, filede, nerada
                </p>
                <p class="price">
                  $5.95
                </p>
              </div><!-- Menu Item -->

              <div class="col-lg-4 menu-item">
                <a href="assets/img/Food_cart/menu/menu-item-2.png" class="glightbox"><img src="assets/img/Food_cart/menu/menu-item-2.png" class="menu-img img-fluid" alt=""></a>
                <h4>Aut Luia</h4>
                <p class="ingredients">
                  Lorem, deren, trataro, filede, nerada
                </p>
                <p class="price">
                  $14.95
                </p>
              </div><!-- Menu Item -->

              <div class="col-lg-4 menu-item">
                <a href="assets/img/Food_cart/menu/menu-item-3.png" class="glightbox"><img src="assets/img/Food_cart/menu/menu-item-3.png" class="menu-img img-fluid" alt=""></a>
                <h4>Est Eligendi</h4>
                <p class="ingredients">
                  Lorem, deren, trataro, filede, nerada
                </p>
                <p class="price">
                  $8.95
                </p>
              </div><!-- Menu Item -->

              <div class="col-lg-4 menu-item">
                <a href="assets/img/Food_cart/menu/menu-item-4.png" class="glightbox"><img src="assets/img/Food_cart/menu/menu-item-4.png" class="menu-img img-fluid" alt=""></a>
                <h4>Eos Luibusdam</h4>
                <p class="ingredients">
                  Lorem, deren, trataro, filede, nerada
                </p>
                <p class="price">
                  $12.95
                </p>
              </div><!-- Menu Item -->

              <div class="col-lg-4 menu-item">
                <a href="assets/img/Food_cart/menu/menu-item-5.png" class="glightbox"><img src="assets/img/Food_cart/menu/menu-item-5.png" class="menu-img img-fluid" alt=""></a>
                <h4>Eos Luibusdam</h4>
                <p class="ingredients">
                  Lorem, deren, trataro, filede, nerada
                </p>
                <p class="price">
                  $12.95
                </p>
              </div><!-- Menu Item -->

              <div class="col-lg-4 menu-item">
                <a href="assets/img/Food_cart/menu/menu-item-6.png" class="glightbox"><img src="assets/img/Food_cart/menu/menu-item-6.png" class="menu-img img-fluid" alt=""></a>
                <h4>Laboriosam Direva</h4>
                <p class="ingredients">
                  Lorem, deren, trataro, filede, nerada
                </p>
                <p class="price">
                  $9.95
                </p>
              </div><!-- Menu Item -->

            </div>
          </div><!-- End Breakfast Menu Content -->

          <div class="tab-pane fade" id="menu-lunch">

            <div class="tab-header text-center">
              <p>Menu</p>
              <h3>Lunch</h3>
            </div>

            <div class="row gy-5">

              <div class="col-lg-4 menu-item">
                <a href="assets/img/Food_cart/menu/menu-item-1.png" class="glightbox"><img src="assets/img/Food_cart/menu/menu-item-1.png" class="menu-img img-fluid" alt=""></a>
                <h4>Magnam Tiste</h4>
                <p class="ingredients">
                  Lorem, deren, trataro, filede, nerada
                </p>
                <p class="price">
                  $5.95
                </p>
              </div><!-- Menu Item -->

              <div class="col-lg-4 menu-item">
                <a href="assets/img/Food_cart/menu/menu-item-2.png" class="glightbox"><img src="assets/img/Food_cart/menu/menu-item-2.png" class="menu-img img-fluid" alt=""></a>
                <h4>Aut Luia</h4>
                <p class="ingredients">
                  Lorem, deren, trataro, filede, nerada
                </p>
                <p class="price">
                  $14.95
                </p>
              </div><!-- Menu Item -->

              <div class="col-lg-4 menu-item">
                <a href="assets/img/Food_cart/menu/menu-item-3.png" class="glightbox"><img src="assets/img/Food_cart/menu/menu-item-3.png" class="menu-img img-fluid" alt=""></a>
                <h4>Est Eligendi</h4>
                <p class="ingredients">
                  Lorem, deren, trataro, filede, nerada
                </p>
                <p class="price">
                  $8.95
                </p>
              </div><!-- Menu Item -->

              <div class="col-lg-4 menu-item">
                <a href="assets/img/Food_cart/menu/menu-item-4.png" class="glightbox"><img src="assets/img/Food_cart/menu/menu-item-4.png" class="menu-img img-fluid" alt=""></a>
                <h4>Eos Luibusdam</h4>
                <p class="ingredients">
                  Lorem, deren, trataro, filede, nerada
                </p>
                <p class="price">
                  $12.95
                </p>
              </div><!-- Menu Item -->

              <div class="col-lg-4 menu-item">
                <a href="assets/img/Food_cart/menu/menu-item-5.png" class="glightbox"><img src="assets/img/Food_cart/menu/menu-item-5.png" class="menu-img img-fluid" alt=""></a>
                <h4>Eos Luibusdam</h4>
                <p class="ingredients">
                  Lorem, deren, trataro, filede, nerada
                </p>
                <p class="price">
                  $12.95
                </p>
              </div><!-- Menu Item -->

              <div class="col-lg-4 menu-item">
                <a href="assets/img/Food_cart/menu/menu-item-6.png" class="glightbox"><img src="assets/img/Food_cart/menu/menu-item-6.png" class="menu-img img-fluid" alt=""></a>
                <h4>Laboriosam Direva</h4>
                <p class="ingredients">
                  Lorem, deren, trataro, filede, nerada
                </p>
                <p class="price">
                  $9.95
                </p>
              </div><!-- Menu Item -->

            </div>
          </div><!-- End Lunch Menu Content -->

          <div class="tab-pane fade" id="menu-dinner">

            <div class="tab-header text-center">
              <p>Menu</p>
              <h3>Dinner</h3>
            </div>

            <div class="row gy-5">

              <div class="col-lg-4 menu-item">
                <a href="assets/img/Food_cart/menu/menu-item-1.png" class="glightbox"><img src="assets/img/Food_cart/menu/menu-item-1.png" class="menu-img img-fluid" alt=""></a>
                <h4>Magnam Tiste</h4>
                <p class="ingredients">
                  Lorem, deren, trataro, filede, nerada
                </p>
                <p class="price">
                  $5.95
                </p>
              </div><!-- Menu Item -->

              <div class="col-lg-4 menu-item">
                <a href="assets/img/Food_cart/menu/menu-item-2.png" class="glightbox"><img src="assets/img/Food_cart/menu/menu-item-2.png" class="menu-img img-fluid" alt=""></a>
                <h4>Aut Luia</h4>
                <p class="ingredients">
                  Lorem, deren, trataro, filede, nerada
                </p>
                <p class="price">
                  $14.95
                </p>
              </div><!-- Menu Item -->

              <div class="col-lg-4 menu-item">
                <a href="assets/img/Food_cart/menu/menu-item-3.png" class="glightbox"><img src="assets/img/Food_cart/menu/menu-item-3.png" class="menu-img img-fluid" alt=""></a>
                <h4>Est Eligendi</h4>
                <p class="ingredients">
                  Lorem, deren, trataro, filede, nerada
                </p>
                <p class="price">
                  $8.95
                </p>
              </div><!-- Menu Item -->

              <div class="col-lg-4 menu-item">
                <a href="assets/img/Food_cart/menu/menu-item-4.png" class="glightbox"><img src="assets/img/Food_cart/menu/menu-item-4.png" class="menu-img img-fluid" alt=""></a>
                <h4>Eos Luibusdam</h4>
                <p class="ingredients">
                  Lorem, deren, trataro, filede, nerada
                </p>
                <p class="price">
                  $12.95
                </p>
              </div><!-- Menu Item -->

              <div class="col-lg-4 menu-item">
                <a href="assets/img/Food_cart/menu/menu-item-5.png" class="glightbox"><img src="assets/img/Food_cart/menu/menu-item-5.png" class="menu-img img-fluid" alt=""></a>
                <h4>Eos Luibusdam</h4>
                <p class="ingredients">
                  Lorem, deren, trataro, filede, nerada
                </p>
                <p class="price">
                  $12.95
                </p>
              </div><!-- Menu Item -->

              <div class="col-lg-4 menu-item">
                <a href="assets/img/Food_cart/menu/menu-item-6.png" class="glightbox"><img src="assets/img/Food_cart/menu/menu-item-6.png" class="menu-img img-fluid" alt=""></a>
                <h4>Laboriosam Direva</h4>
                <p class="ingredients">
                  Lorem, deren, trataro, filede, nerada
                </p>
                <p class="price">
                  $9.95
                </p>
              </div><!-- Menu Item -->

            </div>
          </div><!-- End Dinner Menu Content -->

        </div>

      </div>
    </section><!-- End Menu Section -->



 
<div class="section section-destination">
    <div class="container">
        <div class="row">
            <div class="col-md-10 offset-md-1">
                <div class="section-title text-center mb-5 col-middle">
                    <h2 class="block-title fs-25 mb-2 font-weight-bold">Explore Destinations & Experiences
                      </h2>
                    <div class="sub-title fs-18">
                    Our guests always travel the world in style. Mention @Kempinski on Instagram for a chance to be featured!
                    </div>
                </div>
                <!-- /.End of section title -->
            </div>
        </div>
                
        <div class="destinations-carousel owl-carousel owl-theme">
            <div class="card card-poster text-white flex-row align-items-end border-0">
                <a href=""
                    class="tile-link position-absolute w-100 h-100 top-0 left-0"></a>
                    <img src="assets/img/Home-page/explore_destinations.png"
                    alt="Card image" class="bg-image">
                <div class="card-body overlay-content position-relative">
                    <div class="mb-3">
                        <button type="button"
                            class="btn btn-primary btn-sm book-btn">Book now</button>
                    </div>
                    <span
                        class="item-tag text-uppercase bg-white font-weight-500 mb-2 d-inline-block"></span>
                    <h5 class="card-title font-weight-bold text-white">
                    </h5>
                </div>
            </div>
        </div>

    </div>
</div>
<!-- /.End of destination -->




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


    @include('includes.footer')

  </body>
</html>


