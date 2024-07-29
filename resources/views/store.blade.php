

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'RagamaGuru')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">


    @include('includes.css')

    <style>
        .card {
            height: 100%;
            width:300px;
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
        object-fit: cover; /* Ensures the image covers the container without stretching */
    }
</style>

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
   

<header>
        <div class="p-3 text-center bg-white border-bottom">
            <div class="container">
                <div class="row gy-3 justify-content-center">
                    <div class="col-lg-6 col-md-8 col-12">
                        <div class="input-group">
                            <div class="form-outline flex-grow-1">
                                <input type="search" id="searchInput" class="form-control" placeholder="Search"/>
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
                        <div class="card border-0 menu-item box-shadow-lg rounded-0">
                            <a href="{{ route('products.show', $item->id) }}" class="card2-img position-relative product-link">
                                <img src="{{ $item->image ? asset('images/items/' . $item->image) : asset('images/items/default.png') }}" 
                                class="product-image img-fluid wd_xs_100" alt="{{ $item->name }}">
                            </a>
                            <div class="card-body text-center">
                                <h6 class="card-title mb-0 weeklyoffer-title text-dark product-name">{{ $item->name }}</h6>
                                <h6 class="card-title mb-0 weeklyoffer-title text-primary price">Rs {{ number_format($item->price, 2) }}</h6>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>




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


