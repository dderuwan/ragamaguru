<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'RagamaGuru')</title>
    <link rel="icon" href="{{ asset('images/logos/' . app(\App\Http\Controllers\CompanySettingController::class)->getCompanyLogo()) }}" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">


    <!-- Bootstrap CSS -->
    <link href="assets/web/website_assets/css/animate.min.css" rel="stylesheet">
    <link href="assets/web/website_assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/web/website_assets/plugins/themify/themify-icons.css" rel="stylesheet">
    <link href="assets/web/website_assets/plugins/fontawesome/css/all.min.css" rel="stylesheet">
    <link href="assets/web/website_assets/plugins/owl-carousel/dist/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="assets/sweetalert/sweetalert.css" rel="stylesheet" type="text/css" />
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
    @include('includes.css')

    <style>
        .hero1 {
            background-image: url('/assets/web/images/homeimg.jpg');
            background-size: cover;
            background-position: center;
            padding: 100px 0;
        }

        .hero-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
        }

        .content1 {
            text-align: center;
            color: white;
        }

        .register-form {
            max-width: 600px;
            margin: 0 auto;
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body>

    @include('includes.navbar')
    @yield('content')

    <!-- Home image -->
    <div class="hero1">
        <div class="hero-container">
            <div class="content1">
                <h2 id="content-title">REGISTER</h2>
            </div>
        </div>
    </div>

    <div class="container my-5">
        <div class="register-form">
            <h3 class="text-center mb-4">Register</h3>
            <form method="POST" action="{{route('register.store')}}">
                @csrf
                <div class="mb-3">
                    <label for="full_name" class="form-label">Full Name</label><i class="text-danger">*</i>
                    <input type="text" class="form-control" id="full_name" name="full_name" placeholder="Enter Full Name" required>
                    @error('full_name')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="contact" class="form-label">Contact (Whatsapp Number)</label><i class="text-danger">*</i>
                    <input type="text" class="form-control" id="contact" name="contact" placeholder="Enter Contact Number" required>
                    @error('contact')
                    <p class="text-danger">Please enter a valid contact number</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="address" class="form-label">Address</label>
                    <input type="text" class="form-control" id="address" name="address" placeholder="Enter Address (Optional)">
                    @error('address')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Country Type</label><i class="text-danger">*</i>
                    <div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="country_type" id="local" value="1" required>
                            <label class="form-check-label" for="local">Local</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="country_type" id="international" value="2" required>
                            <label class="form-check-label" for="international">International</label>
                        </div>
                    </div>
                    @error('country_type')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label><i class="text-danger">*</i>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password" required>
                    @error('password')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">Register</button>
                </div>
            </form>
            @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif
            @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
            @endif
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

    <script src="assets/web/js/pagination.js"></script>
    @include('includes.script')



    <script>

    </script>



    @include('includes.footer')



</body>

</html>