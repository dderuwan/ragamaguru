

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


  <!-- Home image-->
  <div class="hero1">
    <div class="hero-container">
        <div class="content1">
            <h2 id="content-title">ONLINE STORE</h2>
        </div>
    </div>
</div>
   

<header>
  <div class="p-3 text-center bg-white border-bottom">
    <div class="container">
      <div class="row gy-3 justify-content-center">
        <div class="col-lg-6 col-md-8 col-12">
          <div class="input-group">
            <div class="form-outline flex-grow-1">
              <input type="search" id="form1" class="form-control" placeholder="Search"/>
            </div>
            <button type="button" class="btn btn-primary shadow-0" style="min-width: 100px;">
              <i class="fas fa-search"></i>
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</header>



            
<!--products-->
<section id="menu" class="menu">
      <div class="container" data-aos="fade-up">

        <div class="section-header">
          <p>Products</p>
        </div>
  
<div id="product-list" class="tab-content mt-5" data-aos="fade-up" data-aos-delay="300">
    <div class="tab-pane fade active show" id="menu-starters">
                <div class="row gy-5">
                    <div class="col-lg-4 menu-item">
                        <a href="#" class="product-link">
                            <img src="assets/web/images/image3.jpg" class="menu-img img-fluid" alt="Product 01">
                        </a>
                        <h4 class="product-name">Product 01</h4>
                        <p class="price">Rs 100.00</p>
                    </div>

                    <div class="col-lg-4 menu-item">
                        <a href="#" class="product-link">
                            <img src="assets/web/images/image3.jpg" class="menu-img img-fluid" alt="Product 02">
                        </a>
                        <h4 class="product-name">Product 02</h4>
                        <p class="price">Rs 300.00</p>
                    </div>

                    <div class="col-lg-4 menu-item">
                        <a href="#" class="product-link">
                            <img src="assets/web/images/image3.jpg" class="menu-img img-fluid" alt="Product 03">
                        </a>
                        <h4 class="product-name">Product 03</h4>
                        <p class="price">Rs 100.00</p>
                    </div>

                   <div class="col-lg-4 menu-item">
                        <a href="#" class="product-link">
                            <img src="assets/web/images/image3.jpg" class="menu-img img-fluid" alt="Product 04">
                        </a>
                        <h4 class="product-name">Product 04</h4>
                        <p class="price">Rs 100.00</p>
                    </div>

                    <div class="col-lg-4 menu-item">
                        <a href="#" class="product-link">
                            <img src="assets/web/images/image3.jpg" class="menu-img img-fluid" alt="Product 05">
                        </a>
                        <h4 class="product-name">Product 05</h4>
                        <p class="price">Rs 50.00</p>
                    </div>

                   <div class="col-lg-4 menu-item">
                        <a href="#" class="product-link">
                            <img src="assets/web/images/image3.jpg" class="menu-img img-fluid" alt="Product 06">
                        </a>
                        <h4 class="product-name">Product 06</h4>
                        <p class="price">Rs 100.00</p>
                    </div>

                    <div class="col-lg-4 menu-item">
                        <a href="#" class="product-link">
                            <img src="assets/web/images/image3.jpg" class="menu-img img-fluid" alt="Product 07">
                        </a>
                        <h4 class="product-name">Product 07</h4>
                        <p class="price">Rs 100.00</p>
                    </div>

                    <div class="col-lg-4 menu-item">
                        <a href="#" class="product-link">
                            <img src="assets/web/images/image3.jpg" class="menu-img img-fluid" alt="Product 08">
                        </a>
                        <h4 class="product-name">Product 08</h4>
                        <p class="price">Rs 100.00</p>
                    </div>
        </div>
    </div>
</div>
</section>

<!--pagination-->
<nav aria-label="Page navigation example">
    <ul class="pagination justify-content-center mb-4"  id="pagination">
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



<!--pagination JS-->
<script>
    document.addEventListener("DOMContentLoaded", function() {
    const itemsPerPage = 6;
    let currentPage = 1;

    const products = document.querySelectorAll("#product-list .menu-item");
    const totalPages = Math.ceil(products.length / itemsPerPage);

    function showPage(page) {
        products.forEach((item, index) => {
            if (index >= (page - 1) * itemsPerPage && index < page * itemsPerPage) {
                item.style.display = "block";
            } else {
                item.style.display = "none";
            }
        });
        updatePagination(page);
    }

    function updatePagination(currentPage) {
        const paginationItems = document.querySelectorAll("#pagination .page-item");

        paginationItems.forEach(item => {
            item.classList.remove("active");
        });

        paginationItems[currentPage].classList.add("active");
    }

    // Click event listeners for pagination links
    document.querySelectorAll("#pagination .page-link").forEach(link => {
        link.addEventListener("click", function(e) {
            e.preventDefault();
            currentPage = parseInt(this.getAttribute("data-page"));
            showPage(currentPage);
        });
    });

    // Previous page button
    document.getElementById("prevPage").addEventListener("click", function(e) {
        e.preventDefault();
        if (currentPage > 1) {
            currentPage--;
            showPage(currentPage);
        }
    });

    // Next page button
    document.getElementById("nextPage").addEventListener("click", function(e) {
        e.preventDefault();
        if (currentPage < totalPages) {
            currentPage++;
            showPage(currentPage);
        }
    });

    // Initial page load
    showPage(currentPage);
});

</script>
 
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const productLinks = document.querySelectorAll('.product-link');

        productLinks.forEach(link => {
            link.addEventListener('click', function(event) {
                event.preventDefault();

                const productContainer = this.closest('.menu-item');
                const productName = productContainer.querySelector('.product-name').textContent;
                const productPrice = productContainer.querySelector('.price').textContent.replace('Rs ', '');

                const url = new URL(window.location.origin + "/products");
                url.searchParams.set('name', productName.trim());
                url.searchParams.set('price', productPrice.trim());

                window.location.href = url.toString();
            });
        });
    });
</script>
                



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

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const productLinks = document.querySelectorAll('.product-link');

        productLinks.forEach(link => {
            link.addEventListener('click', function(event) {
                event.preventDefault();

                const productContainer = this.closest('.menu-item');
                const productName = productContainer.querySelector('.product-name').textContent;
                const productPrice = productContainer.querySelector('.price').textContent.replace('Rs ', '');

                const url = new URL(window.location.origin + "{{ route('products') }}");
                url.searchParams.set('name', productName.trim());
                url.searchParams.set('price', productPrice.trim());

                window.location.href = url.toString();
            });
        });
    });
</script>


    @include('includes.footer')

  </body>
</html>


