
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'RagamaGuru')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    @include('includes.css')
    
    <style>
  .product-image {
    width: 300px; 
    height: 200px; 
    object-fit: cover; /* Ensures the image covers the container without stretching */
  }
</style>

  </head>
  <body>


  @include('includes.navbar')
  @yield('content')


  <!-- Home image -->
  <div class="hero1" style="background-image: url('{{ asset('assets/web/images/homeimg.jpg') }}');">
    <div class="hero-container">
        <div class="content1">
            <h2 id="content-title">HOME</h2>
        </div>
    </div>
  </div>

  <!-- Products -->
<div class="section">
    <div class="container">
      <div class="row">
        <div class="col-md-10 offset-md-1">
          <div class="section-title text-center mb-5 col-middle">
            <h1 class="block-title">Products</h1>
            <div class="sub-title fs-18"></div>
          </div>
        </div>
      </div>
      <div class="row">
        @foreach ($item_list as $item)
          <div class="col-lg-3 col-md-4 col-sm-6">
            <div class="card border-0 menu-item box-shadow-lg rounded-0 mb-4">
            <a href="{{ route('products.show', $item->id) }}" class="card-img position-relative product-link">
                <img src="{{ $item->image ? asset('images/items/' . $item->image) : asset('images/items/default.png') }}" class="product-image img-fluid wd_xs_100" alt="{{ $item->name }}">
                <button type="button" class="btn-buy position-absolute btn btn-primary btn-sm">Buy now</button>
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


  @include('includes.footer')



  @include('includes.script')




  </body>
</html>


