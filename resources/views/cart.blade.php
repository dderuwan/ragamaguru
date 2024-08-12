<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'RagamaGuru')</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Additional CSS files -->
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
  <link href="https://fonts.googleapis.com/css?family=Caveat:400,700|Playfair+Display:400,400i,700,700i,900,900i|Sarabun:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800&display=swap" rel="stylesheet">
  <link href="assets/web/website_assets/css/style.css?v=3" rel="stylesheet">
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet">
  <link href="assets/web/css/foodcart/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/web/css/foodcart/aos/aos.css" rel="stylesheet">
  <link href="assets/web/css/foodcart/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/web/css/foodcart/swiper/swiper-bundle.min.css" rel="stylesheet">
  <link href="assets/web/css/foodcart/main.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <style>
    .title {
      margin-left: 600px;
    }

    @media (max-width: 992px) {
      .title {
        margin-left: 0;
        text-align: center;
      }
    }
  </style>

</head>

<body style="background-color: #f8f8f8b3">

  @include('includes.navbar')

  <header class="header-bg">
    <div class="p-3 text-center border-bottom">
      <div class="container4">
        <div class="row gy-3 align-items-center">
          <div class="col-12 col-lg-7 d-flex justify-content-center">
            <h4 class="text-white title mb-0">Shopping Cart</h4>
          </div>
          <div class="col-12 col-lg-5 d-flex justify-content-end">
            <a href="{{ route('cart') }}" class="border rounded py-1 px-3 nav-link d-flex align-items-center position-relative">
              <i class="fas fa-shopping-cart m-1 me-md-2 text-white"></i>
              <p class="d-none d-md-block mb-0">My cart</p>
              <span id="cart-count" class="badge bg-warning text-dark rounded-circle position-absolute top-0 start-100 translate-middle p-1 small">0</span>
            </a>
          </div>
        </div>
      </div>
    </div>
  </header>


  <section class="h-100 h-custom">
    <div class="container h-80 py-1">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col">
          <div class="table-responsive">
            <table class="table section-border">
              <thead>
                <tr>
                  <th scope="col"></th>
                  <th scope="col">Products</th>
                  <th scope="col" class="text-center">Price</th>
                  <th scope="col" class="text-center">Quantity</th>
                  <th scope="col" class="text-center">Total</th>
                  <th scope="col">Delete</th>
                </tr>
              </thead>
              <tbody>
                  @foreach($cart as $index => $item)
                  <tr id="product-row-{{ $index }}">

                      <!-- Image -->
                      <td>
                          <div class="d-flex align-items-center">
                              <img src="{{ isset($item['image']) ? asset('images/items/' . $item['image']) : asset('images/items/default.png') }}" class="img-fluid rounded-3" style="width: 80px;" alt="product">
                          </div>
                      </td>

                      <!-- Product -->
                      <td class="align-middle">
                          <p class="mb-0" style="font-weight: 500;" name="item_name">{{ $item['name'] ?? 'Unknown' }}</p>
                          <input type="hidden" name="item_code" value="{{ $item['item_code'] ?? 'N/A' }}">
                      </td>

                      <!-- Price -->
                      <td class="align-middle text-center price-column">
                          <p class="mb-0" style="font-weight: 500;" name="price" id="unit-price-{{ $index }}">{{ $item['price'] ?? 'N/A' }}</p>
                      </td>

                      <!-- Quantity -->
                      <td class="align-middle text-center quantity-column">
                          <div class="d-flex flex-row justify-content-center">
                              <button type="button" class="btn btn-link px-2" onclick="updateQuantity(-1, '{{ $index }}', {{ $item['available_quantity'] ?? 0 }})">
                                  <i class="fas fa-minus"></i>
                              </button>
                              <input id="quantity-{{ $index }}" min="1" name="quantity" value="1" type="number" class="form-control form-control-sm no-spinner text-center" style="width: 50px;" onchange="updateTotalPrice('{{ $index }}')" />
                              <button type="button" class="btn btn-link px-2" onclick="updateQuantity(1, '{{ $index }}', {{ $item['available_quantity'] ?? 0 }})">
                                  <i class="fas fa-plus"></i>
                              </button>
                          </div>
                      </td>

                      <!-- Total -->
                      <td class="align-middle text-center total-column">
                          <p class="mb-0" style="font-weight: 500;" name="total_price" id="total-price-{{ $index }}">Rs {{ $item['price'] ?? '0.00' }}</p>
                      </td>

                      <!-- Delete -->
                      <td class="align-middle">
                          <div class="col-md-1 col-lg-1 col-xl-1 text-end">
                              <a href="#!" class="text-danger" onclick="deleteProduct('product-row-{{ $index }}', {{ $index }})">
                                  <i class="fas fa-trash fa-lg"></i></a>
                          </div>
                      </td>
                  </tr>
                  @endforeach
              </tbody>

            </table>
          </div>


          <div class="row mt-3 justify-content-end">
            <div class="col-md-4">
              <div class="card section-border shadow-2-strong" style="border-radius: 16px;">
                <div class="card-body p-4">
                  <div class="d-flex justify-content-between mb-4" style="font-weight: 500;">
                    <p class="mb-2" style="font-weight: bold;">Total Price</p>
                    <p class="mb-2" style="font-weight: bold;" id="total-cart-price"></p>
                  </div>
                  <!-- check -->
                  <button type="button" id="checkout-button" onclick="goToCheckout()" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-block btn-lg text-center checkout-button">
                    Proceed To Checkout
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <button onclick="clearCart()" class="btn">Clear Cart</button>



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
  <script src="assets/web/website_assets/plugins/theia-sticky-sidebar/dist/theia-sticky-sidebar.min.js"></script>
  <script src="assets/web/website_assets/plugins/numscroller/numscroller-1.0.js"></script>
  <!-- Food Cart JS -->
  <script src="assets/web/js/Food_cart/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/web/js/Food_cart/aos/aos.js"></script>
  <script src="assets/web/js/Food_cart/glightbox/js/glightbox.min.js"></script>
  <script src="assets/web/js/Food_cart/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/web/js/Food_cart/swiper/swiper-bundle.min.js"></script>
  <script src="assets/web/js/Food_cart/php-email-form/validate.js"></script>
  <script src="assets/web/js/Food_cart/main.js"></script>
  <!-- SweetAlert -->
  <script src="assets/sweetalert/sweetalert.min.js" type="text/javascript"></script>
  <script src="assets/web/website_assets/js/script.js"></script>
  <script src="assets/web/website_assets/js/subscriber_email.js"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key="></script>
  <script src="assets/web/website_assets/js/loadMap.js"></script>
  <script src="assets/web/js/product.js"></script>
  <script src="assets/js/cart.js"></script>

  <script>
    var storeCartDetailsUrl = "{{ route('storeCartDetails') }}";
    var cartCheckoutUrl = "{{ route('cartCheckout') }}";
  </script>

  <script>
    // Function to delete product from cart

    function deleteProduct(rowId, index) {
      fetch('{{ route("deleteFromCart") }}', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
          },
          body: JSON.stringify({
            rowId: index
          })
        })
        .then(response => response.json())
        .then(data => {
          if (data.success) {
            // Remove the product row from the UI
            const row = document.getElementById(rowId);
            row.parentNode.removeChild(row);
            // Update cart count and total price
            updateCartCount();
            updateCartTotal();
          } else {
            console.error('Failed to delete item from cart.');
          }
        })
        .catch(error => {
          console.error('Error deleting item:', error);
        });
    }

    // Function to update cart count
    function updateCartCount() {
      fetch('{{ route("cartItemCount") }}')
        .then(response => response.json())
        .then(data => {
          document.getElementById('cart-count').innerText = data.count; // Update cart count in the UI
        })
        .catch(error => {
          console.error('Error:', error);
        });
    }

    // Initialize cart count on page load
    updateCartCount();
    updateCartTotal();

    // clear cart
    function clearCart() {
      fetch('{{ route("clearCart") }}', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
          }
        })
        .then(response => response.json())
        .then(data => {
          if (data.success) {
            // Update cart count to zero or update UI as needed
            document.getElementById('cart-count').innerText = 0;
            // Clear cart items UI
            const tbody = document.querySelector('tbody');
            tbody.innerHTML = ''; // Clear all rows from the table
          } else {
            console.error('Failed to clear cart.');
          }
        })
        .catch(error => {
          console.error('Error clearing cart:', error);
        });
    }
  </script>





  @include('includes.footer')

</body>

</html>