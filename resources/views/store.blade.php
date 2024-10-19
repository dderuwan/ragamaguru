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
        .card {
            height: 100%;
            width: 300px;
        }

        .card-body {
            padding: 10px;
        }

        .card2-img {
            max-height: 200px;
            overflow: hidden;
        }

        .product-image {
            width: 300px;
            height: 200px;
            object-fit: cover;
            /* Ensures the image covers the container without stretching */
        }

        .logoContent {
            color: black;
            margin-top: 30px;
        }


        .product-image {
            width: 300px;
            height: 200px;
            object-fit: cover;
            /* Ensures the image covers the container without stretching */
        }

        .center-icon {
            display: flex;
            align-items: center;
            justify-content: center;
        }
    </style>
</head>

<body>


    @include('includes.navbar')
    @yield('content')


    <!-- Home image-->
    <div class="hero1" style="background-image: url('/assets/web/images/homeimg.jpg');">
        <div class="hero-container">
            <div class="content1">
                <h2 id="content-title">ONLINE STORE</h2>
            </div>
        </div>
    </div>
    </div>



    <header>
        <div class="p-3 text-center bg-white border-bottom">
            <div class="container">
                <div class="row gy-3 justify-content-center">
                    <div class="col-lg-6 col-md-8 col-12">
                        <div class="row">
                            <div class="input-group col-10">
                                <div class="form-outline flex-grow-1">
                                    <input type="search" id="searchInput" class="form-control" placeholder="Search" />
                                </div>
                                <button type="button" class="btn btn-primary shadow-0" style="min-width: 100px;">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                            <a href="{{route('cart')}}" type="button" class="col-1 ms-1 btn btn-primary center-icon">
                                <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                            </a>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </header>

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
    @if (session('warning'))
    <div class="alert alert-warning">
        {{ session('warning') }} 
    </div>
    @endif


    <!-- Products -->
    <div class="section menu" id="product-list">
        <div class="container" data-aos="fade-up">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-title text-center mb-5 col-middle">
                        <h1 class="block-title">Products</h1>
                    </div>
                </div>
            </div>
            <div class="row" id="products-container">
                @foreach ($item_list as $item)




                <div class="col-lg-4 col-md-6 mb-4 product-item" data-name="{{ $item->name }}">
                    <div class="card border-0 menu-item box-shadow-lg rounded-0 ">
                        <a href="{{ route('products.show', $item->id) }}" class="card2-img position-relative product-link">
                            <img src="{{ $item->image ? asset('images/items/' . $item->image) : asset('images/items/default.png') }}" class="product-image img-fluid wd_xs_100" alt="{{ $item->name }}">
                            @if ($item->offer_rate)
                            <div class="offer-badge position-absolute top-0 end-0 bg-danger text-white p-1">
                                {{ rtrim(rtrim(number_format($item->offer_rate, 2), '0'), '.') }}% OFF
                            </div>
                            @endif
                        </a>
                        <div class="card-body text-center">
                            <h6 class="card-title mb-0 weeklyoffer-title text-dark product-name">{{ $item->name }}</h6>
                            @if ($item->offer_price)
                            <h6 class="card-title mb-0 weeklyoffer-title text-muted" style="text-decoration: line-through;">Rs {{ number_format($item->normal_price, 2) }}</h6>
                            <h6 class="card-title mb-0 weeklyoffer-title text-primary price">Rs {{ number_format($item->offer_price, 2) }}</h6>
                            @else
                            <h6 class="card-title mb-0 weeklyoffer-title text-primary price">Rs {{ number_format($item->price, 2) }}</h6>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach

            </div>
        </div>
    </div>




    <!--pagination-->
    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center mb-4" id="pagination">
            <li class="page-item" id="prevPage">
                <a class="page-link" href="#" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
            <li class="page-item active"><a class="page-link" href="#" data-page="1">1</a></li>
            <li class="page-item"><a class="page-link" href="#" data-page="2">2</a></li>
            <!-- Add more page links dynamically using JavaScript -->
            <li class="page-item" id="nextPage">
                <a class="page-link" href="#" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        </ul>
    </nav>










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
        document.getElementById('searchInput').addEventListener('input', searchProducts);

        function searchProducts() {
            var query = document.getElementById('searchInput').value.toLowerCase();
            var products = document.querySelectorAll('.product-item');

            products.forEach(function(product) {
                var productName = product.getAttribute('data-name').toLowerCase();
                if (productName.includes(query)) {
                    product.style.display = 'block';
                } else {
                    product.style.display = 'none';
                }
            });
        }
    </script>



    @include('includes.footer')



</body>

</html>