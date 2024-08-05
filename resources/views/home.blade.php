<?php
$channelId = 'channelID'; // Replace channel ID
$rssFeedUrl = "https://www.youtube.com/feeds/videos.xml?channel_id=$channelId";
$rss = simplexml_load_file($rssFeedUrl);
$videoIds = [];
for ($i = 0; $i < 2; $i++) {
  if (isset($rss->entry[$i])) {
    $videoIds[] = (string)$rss->entry[$i]->children('yt', true)->videoId;
  }
}
?>

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
    .product-image {
      width: 300px;
      height: 200px;
      object-fit: cover;
      /* Ensures the image covers the container without stretching */
    }
  </style>

  <style>
    .product-image {
      width: 300px;
      height: 200px;
      object-fit: cover;
    }

    .section-title {
      display: flex;
      align-items: center;
      position: relative;
    }

    .title-left {
      flex: 0 0 auto;
      margin-right: 15px;
    }

    .section-title::after {
      content: '';
      flex: 1;
      height: 2px;
      background-color: #000;
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
        <div class="col-12 ">
          <div class="section-title mb-5 ">
            <h2 class="title-left">Product Highlights</h2>
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


  <!-- special offers -->
  <div class="section">
    <div class="container">
      <div class="row">
        <div class="col-12 ">
          <div class="section-title mb-5 ">
            <h2 class="title-left">Special Offers</h2>
            <div class="sub-title fs-18"></div>
          </div>
        </div>
      </div>
      <div class="row">
        @if ($offer_items->isEmpty())
        <p class="text-danger">No special offers at this time..</p>
        @endif
        @foreach ($offer_items as $offeritem)
        <div class="col-lg-3 col-md-4 col-sm-6">
          <div class="card border-0 menu-item box-shadow-lg rounded-0 mb-4">
            <a href="{{ route('products.show', $offeritem->item_id) }}" class="card-img position-relative product-link">
              <img src="{{ $offeritem->image ? asset('images/items/' . $offeritem->image) : asset('images/items/default.png') }}" class="product-image img-fluid wd_xs_100" alt="{{ $offeritem->name }}">
              <button type="button" class="btn-buy position-absolute btn btn-primary btn-sm">Buy now</button>
              <div class="offer-badge position-absolute top-0 end-0 bg-danger text-white p-1">
                {{ rtrim(rtrim(number_format($offeritem->offer_rate, 2), '0'), '.') }}% OFF
              </div>
            </a>
            <div class="card-body text-center">
              <h6 class="card-title mb-0 weeklyoffer-title text-dark product-name">{{ $offeritem->name }}</h6>
              <h6 class="card-title mb-0 weeklyoffer-title text-muted" style="text-decoration: line-through;">Rs {{ number_format($offeritem->normal_price, 2) }}</h6>
              <h6 class="card-title mb-0 weeklyoffer-title text-primary price">Rs {{ number_format($offeritem->offer_price, 2) }}</h6>
            </div>
          </div>
        </div>
        @endforeach
      </div>
    </div>
  </div>


  <!-- special offers -->
  <div class="section">
    <div class="container">
      <div class="row">
        <div class="col-12 ">
          <div class="section-title mb-2 ">
            <h2 class="title-left">Youtube Videos</h2>
            <div class="sub-title fs-18"></div>
          </div>
        </div>
      </div>
      <div class="row mb-3">
        <div class="col-12 d-flex justify-content-end">
          <a href="https://www.youtube.com/channel/<?php echo $channelId; ?>" class="btn btn-primary btn-sm">
            View More >>
          </a>
        </div>
      </div>
      <div class="row">
        <?php foreach ($videoIds as $videoId) : ?>
          <div class="col-md-6 mb-4">
            <iframe width="100%" height="315" src="https://www.youtube.com/embed/<?php echo $videoId; ?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>


  <!-- special offers -->
  <div class="section">
    <div class="container">
      <div class="row">
        <div class="col-12 ">
          <div class="section-title mb-2 ">
            <h2 class="title-left">Facebook</h2>
            <div class="sub-title fs-18"></div>
          </div>
        </div>
      </div>
      <div class="row justify-content-center">
        <div class="col-md-6">
      <iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2Fesupporttechnolgies%3Fmibextid%3DLQQJ4d&tabs=timeline&width=500&height=600&small_header=true&adapt_container_width=true&hide_cover=false&show_facepile=false&appId" width="100%" height="550" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowfullscreen="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share"></iframe>
        </div>
      </div>
    </div>
  </div>



  @include('includes.footer')
  @include('includes.script')




  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  <!-- jQuery first, then Popper.js, then Bootstrap JS -->

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

  <script src="https://maps.googleapis.com/maps/api/js?key="></script>

  <script src="assets/web/website_assets/js/loadMap.js"></script>




</body>

</html>