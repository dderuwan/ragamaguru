<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'RagamaGuru')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    @include('includes.css')
 
    <style>
.product-section {
  min-height:500px;
}


</style>
</head>
<body>
    @include('includes.navbar')

    <header class="header-bg">
      <div class="p-3 text-center border-bottom">
        <div class="container4">
          <div class="row gy-3 justify-content-between align-items-center">
            <div class="col-lg-2 col-md-4 col-0"></div>
            <div class="order-lg-last col-lg-5 col-sm-8 col-12">
              <div class="d-flex justify-content-end">               
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

    <!-- Product Details Section -->
    <section class="product-section py-5 mb-5 mt-5">
        <div class="container">
            <div class="row gx-5">
                <aside class="col-lg-6">
                    <div class="rounded-4 mb-3 d-flex justify-content-end">
                    <a href="{{ $item->image ? asset('images/items/' . $item->image) : asset('images/items/default.png') }}" class="glightbox">
                        <img style="max-width: 85%; max-height: 100vh; margin-left: 80px;" class="rounded-4 fit" 
                        src="{{ $item->image ? asset('images/items/' . $item->image) : asset('images/items/default.png') }}" /></a>
                    </div>
                </aside>

                <main class="col-lg-6">
                  <div class="ps-lg-3">
                      <h4 class="title text-dark fw-bold">{{ $item->name }}</h4>
                      <div class="d-flex flex-row my-3">
                          <span class="text-muted"><i class="fas fa-shopping-basket fa-sm mx-1"></i>orders</span>
                          @if($item->quantity > 0)
                              <span class="text-success ms-2">In stock</span>
                          @else
                              <span class="text-danger ms-2">Out of stock</span>
                          @endif
                      </div>
                      <div class="mb-3">
                          <span class="h5 text-primary fw-bold">Rs {{ number_format($item->price, 2) }}</span>
                      </div>
                      <p>{{ $item->description }}</p>
                      <hr />
                      <div class="btn-group" role="group">
                          @if($item->quantity > 0)
                              <form id="addToCartForm" action="{{ route('addToCart') }}" method="POST">
                                  @csrf
                                  <input type="hidden" name="name" value="{{ $item->name }}">
                                  <input type="hidden" name="price" value="{{ $item->price }}">
                                  <input type="hidden" name="image" value="{{ $item->image }}">
                                  <button type="submit" class="btn btn-primary shadow-0">
                                      <i class="me-1 fas fa-shopping-cart"></i> Add to cart
                                  </button>
                              </form>
                          @else
                              <button type="button" class="btn btn-primary shadow-0" disabled>
                                  <i class="me-1 fas fa-shopping-cart"></i> Out of stock
                              </button>
                          @endif
                          <a href="#" class="btn btn-warning shadow-0 me-2">Buy now</a>
                      </div>
                  </div>
              </main>
            </div>
        </div>
    </section>

    @include('includes.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>



<!-- jQuery first, then Popper.js, then Bootstrap JS -->

<script src="{{ asset('assets/web/website_assets/plugins/bootstrap/js/popper.min.js') }}"></script>
<script src="{{ asset('assets/web/website_assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/web/website_assets/plugins/owl-carousel/dist/owl.carousel.min.js') }}"></script>
<script src="{{ asset('assets/web/website_assets/plugins/select2/dist/js/select2.min.js') }}"></script>
<script src="{{ asset('assets/web/website_assets/plugins/daterangepicker/moment.min.js') }}"></script>
<script src="{{ asset('assets/web/website_assets/plugins/daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ asset('assets/web/website_assets/plugins/isotope/isotope.pkgd.js') }}"></script>
<script src="{{ asset('assets/web/website_assets/plugins/fancybox/dist/jquery.fancybox.min.js') }}"></script>
<script src="{{ asset('assets/web/website_assets/plugins/theia-sticky-sidebar/dist/ResizeSensor.min.js') }}"></script>
<script src="{{ asset('assets/web/website_assets/plugins/theia-sticky-sidebar/dist/theia-sticky-sidebar.min.js') }}"></script>
<script src="{{ asset('assets/web/website_assets/plugins/numscroller/numscroller-1.0.js') }}"></script>
<script src="{{ asset('assets/web/website_assets/plugins/jQuery/jquery-3.5.1.min.js') }}"></script>
<!-- Food Cart JS-->
<script src="{{ asset('assets/web/js/Food_cart/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/web/js/Food_cart/aos/aos.js') }}"></script>
<script src="{{ asset('assets/web/js/Food_cart/glightbox/js/glightbox.min.js') }}"></script>
<script src="{{ asset('assets/web/js/Food_cart/purecounter/purecounter_vanilla.js') }}"></script>
<script src="{{ asset('assets/web/js/Food_cart/swiper/swiper-bundle.min.js') }}"></script>
<script src="{{ asset('assets/web/js/Food_cart/php-email-form/validate.js') }}"></script>
<script src="{{ asset('assets/web/js/Food_cart/main.js') }}"></script>

<!-- sweetalert -->
<script src="{{ asset('assets/sweetalert/sweetalert.min.js') }}"></script>
<script src="{{ asset('assets/web/website_assets/js/script.js') }}"></script>
<script src="{{ asset('assets/web/website_assets/js/subscriber_email.js') }}"></script>
<script src="{{ asset('assets/web/website_assets/js/loadMap.js') }}"></script>

<script src="https://maps.googleapis.com/maps/api/js?key="></script>




   <!--adding an item to the cart and update -->
   <script>
      // Function to add item to car
      function addToCart(event) {
        event.preventDefault(); // Prevent form submission

        // Get form data
        let formData = new FormData(document.getElementById('addToCartForm'));

        // add item to cart
        fetch('{{ route("addToCart") }}', {
          method: 'POST',
          body: formData
        })
        .then(response => response.json())
        .then(data => {
          if (data.success) {
            // Update cart count on product and cart pages
            updateCartCount();
            localStorage.setItem('cartCount', data.cartCount); 

            // Redirect to cart page
            window.location.href = '{{ route("cart") }}';
          }
        })
        .catch(error => {
          console.error('Error:', error);
          alert('An error occurred.');
        });
      }

      // Function to update the cart count display
      function updateCartCount() {
        fetch('{{ route("cartItemCount") }}')
        .then(response => response.json())
        .then(data => {
          document.getElementById('cart-count').innerText = data.count;
        })
        .catch(error => {
          console.error('Error:', error);
        });
      }

      // Initialize cart count on page load
      function initCartCount() {
        let currentCount = localStorage.getItem('cartCount') || 0;
        updateCartCount(currentCount);
      }

      initCartCount(); // Initialize cart count when the page loads
</script>



   

  </body>
</html>


