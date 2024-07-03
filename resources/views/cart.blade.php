

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
    <div class="container4 p-2">
          <div class="d-flex align-items-center">
            <h4 class="text-white">My Cart</h4>
          </div>
    </div>
  </header>


  <section class="h-100 h-custom">
  <div class="container h-100 py-5">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col">

        <div class="table-responsive">
          <table class="table">
            <thead>
              <tr>
                <th scope="col" class="h5">Products</th>
                <th scope="col">Price</th>
                <th scope="col">Quantity</th>
                <th scope="col">Total</th>
                <th scope="col">Delete</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>
                  <div class="d-flex align-items-center">
                    <!--image-->
                    <img src="assets\web\images\image3.jpg" class="img-fluid rounded-3" style="width: 120px;" alt="Book">
                    <div class="flex-column ms-4">
                      <p class="mb-0">Product 01</p>
                    </div>
                  </div>
                </td>
                <!--price-->
                <td class="align-middle">
                  <p class="mb-0" style="font-weight: 500;">$9.99</p>
                </td>
                <!--quantity-->
                <td class="align-middle">
                  <div class="d-flex flex-row">
                    <button data-mdb-button-init data-mdb-ripple-init class="btn btn-link px-2" onclick="this.parentNode.querySelector('input[type=number]').stepDown()">
                      <i class="fas fa-minus"></i>
                    </button>
                    <input min="0" name="quantity" value="0" type="number" class="form-control form-control-sm" style="width: 50px;" />
                    <button data-mdb-button-init data-mdb-ripple-init class="btn btn-link px-2" onclick="this.parentNode.querySelector('input[type=number]').stepUp()">
                      <i class="fas fa-plus"></i>
                    </button>
                  </div>
                </td>
                <!--total-->
                <td class="align-middle">
                  <p class="mb-0" style="font-weight: 500;">$9.99</p>
                </td>
                <!--delete-->
                <td class="align-middle">
                  <div class="col-md-1 col-lg-1 col-xl-1 text-end">
                    <a href="#!" class="text-danger"><i class="fas fa-trash fa-lg"></i></a>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>

        <div class="row mt-4 justify-content-end">
          <div class="col-md-4">
            <div class="card shadow-2-strong" style="border-radius: 16px;">
              <div class="card-body p-4">
                <div class="d-flex justify-content-between mb-4" style="font-weight: 500;">
                  <p class="mb-2">Total Price</p>
                  <p class="mb-2">$26.48</p>
                </div>
                <button type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-block btn-lg">
                  <div class="d-flex justify-content-between">
                    <span>Checkout</span>
                    <span>$26.48</span>
                  </div>
                </button>
              </div>
            </div>
          </div>
        </div>

      </div>
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
  
    <script>
    function changeQuantity(productId, change) {
        var quantityInput = document.getElementById('quantity-' + productId);
        var currentQuantity = parseInt(quantityInput.value);
        var newQuantity = currentQuantity + change;
        if (newQuantity >= 0) {
            quantityInput.value = newQuantity;
            updatePrice(productId);
        }
    }

    function updatePrice(productId) {
        var quantityInput = document.getElementById('quantity-' + productId);
        var priceElement = document.getElementById('price-' + productId);
        var pricePerUnit = 100; // Replace with your actual price per unit
        var quantity = parseInt(quantityInput.value);
        var totalPrice = quantity * pricePerUnit;
        priceElement.textContent = 'Rs ' + totalPrice.toFixed(2);
    }

        
    // Function to handle item deletion
    function deleteItem(event) {
        event.preventDefault(); // Prevent default anchor behavior

        // Get the item ID from the data attribute
        const itemId = event.currentTarget.getAttribute('data-item-id');

        // Assuming you have a function to remove the item from the cart array or database
        console.log('Deleting item:', itemId);

        // Here you would typically call a function to remove the item from the cart
        // Example: removeItemFromCart(itemId);

        // Find the parent card element and remove it
        const cardElement = event.currentTarget.closest('.card3');
        if (cardElement) {
            cardElement.remove();
        }
    }

    // Attach event listener to all delete buttons with class 'delete-item'
    const deleteButtons = document.querySelectorAll('.delete-item');
    deleteButtons.forEach(button => {
        button.addEventListener('click', deleteItem);
    });


    </script>

    @include('includes.footer')

  </body>
</html>


