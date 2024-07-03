

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
      <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet">


    <link href="assets/web/css/foodcart/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/web/css/foodcart/aos/aos.css" rel="stylesheet">
    <link href="assets/web/css/foodcart/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="assets/web/css/foodcart/swiper/swiper-bundle.min.css" rel="stylesheet">
    <link href="assets/web/css/foodcart/main.css" rel="stylesheet">

  </head>
  <body>


  @include('includes.navbar')
  @yield('content')

  <header class="header-bg">
  <div class="p-3 text-center border-bottom">
    <div class="container4">
      <div class="row gy-3 justify-content-between align-items-center">
        <div class="col-lg-2 col-md-4 col-0"></div>
        <div class="order-lg-last col-lg-5 col-sm-8 col-12">
          <div class="d-flex justify-content-end">
            <a href="" class="me-1 border rounded py-1 px-3 nav-link d-flex align-items-center"> 
              <i class="fas fa-heart m-1 me-md-2 text-white"></i>
              <p class="d-none d-md-block mb-0">Wishlist</p>
            </a>
            <a href="{{ route('cart') }}" class="border rounded py-1 px-3 nav-link d-flex align-items-center position-relative"> 
                <i class="fas fa-shopping-cart m-1 me-md-2 text-white"></i>
                <p class="d-none d-md-block mb-0">My cart</p>
                <span id="cart-count" class="badge bg-warning text-dark rounded-circle position-absolute top-0 start-100 translate-middle p-1 small">0</span>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</header>








<!-- content -->
<section class="py-5">
    <div class="container">
      <div class="row gx-5">
        <aside class="col-lg-6">
          <div class=" rounded-4 mb-3 d-flex justify-content-end">
            <a href="/assets/web/images/image3.jpg" class="glightbox">
              <img style="max-width: 85%; max-height: 100vh; margin-left: 80px;" class="rounded-4 fit" src="/assets/web/images/image3.jpg" />
            </a>
          </div>
          <div class="d-flex justify-content-center mb-3">
            <a href="/assets/web/images/image3.1.jpg" class="glightbox">
              <img width="60" height="60" class="rounded-2" src="/assets/web/images/image3.1.jpg" />
            </a>
            <a href="/assets/web/images/image3.1.jpg" class="glightbox">
              <img width="60" height="60" class="rounded-2" src="/assets/web/images/image3.1.jpg" />
            </a>
          </div>
        </aside>

      
      <main class="col-lg-6">
      <div class="ps-lg-3">
        <h4 class="title text-dark fw-bold">{{ $name }}</h4>
        <div class="d-flex flex-row my-3">
            <span class="text-muted"><i class="fas fa-shopping-basket fa-sm mx-1"></i>30 orders</span>
            <span class="text-success ms-2">In stock</span>
        </div>
        <div class="mb-3">
            <span class="h5 text-primary fw-bold">Rs {{ $price }}</span>
        </div>


          <p>
          An incense stick producer manufactures and distributes aromatic sticks that release fragrant smoke when burned. 
          They typically use a blend of natural materials like wood powder, resins, and essential oils to create the incense sticks. 
          </p>

          <hr />

        
          <a href="#" class="btn btn-warning shadow-0"> Buy now </a>
          <a href="" class="btn btn-primary shadow-0" onclick="addToCart()"> 
            <i class="me-1 fas fa-shopping-cart"></i> Add to cart </a>
          <a href="#" class="btn btn-light border border-secondary py-2 icon-hover px-3"> <i class="me-1 fa fa-heart fa-lg"></i> Save </a>
        </div>
      </main>
    </div>
  </div>
</section>









                


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


   <!--adding an item to the cart and update -->
   <script>
    function addToCart() {
        // Get current count from localStorage or initialize to 0
        let currentCount = localStorage.getItem('cartCount') || 0;
        
        // Increment the count
        let newCount = parseInt(currentCount) + 1;
        
        // Update localStorage with the new count
        localStorage.setItem('cartCount', newCount);
        
        // Update cart count display
        updateCartCount(newCount);
        
        // Optionally, you can redirect to the cart page using window.location.href
        // Example: window.location.href = "{{ route('cart') }}";
    }

    // Function to update the cart count display
    function updateCartCount(count) {
        document.getElementById('cart-count').innerText = count;
    }

    // Function to initialize cart count on page load
    function initCartCount() {
        // Get count from localStorage
        let currentCount = localStorage.getItem('cartCount') || 0;
        
        // Update cart count display
        updateCartCount(currentCount);
    }

    // Initialize cart count on page load
    initCartCount();

</script>



    @include('includes.footer')

  </body>
</html>


