<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
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
  </style>
</head>

<body>

  @include('includes.navbar')
  @yield('content')

  <!-- Home image -->
  <div class="hero1">
    <div class="hero-container">
      <div class="content1">
        <h2 id="content-title">Appointments</h2>
      </div>
    </div>
  </div>


  <div class="container mt-5">
    <!-- Customer Details Form -->
    <div class="card mb-4">
      <div class="card-header">
        <strong>Your Details</strong>
      </div>
      <div class="card-body">
        <form id="customer-details-form">
          <div class="mb-3">
            <label class="form-label">Name:</label> &nbsp;&nbsp;&nbsp;&nbsp;
            <strong><span> {{$customer->name}} </span></strong>
          </div>
          <div class="mb-3">
            <label class="form-label">Contact:</label>&nbsp;&nbsp;
            <strong><span> {{$customer->contact}} </span></strong>
          </div>
          <div class="mb-3">
            <label class="form-label">Address:</label>&nbsp;&nbsp;
            @if (empty($customer->address))
            <span>No Address</span>
            @endif
            <strong><span> {{$customer->address}} </span></strong>
          </div>
          <p>You can update this information if you want. If not necessary, you can book a date.</p>
          <button type="button" class="btn btn-sm btn-primary" id="update-customer">Update</button>
        </form>
      </div>
    </div>


    <!-- Date Picker -->
    <div class="card mb-4">
      <div class="card-header">
        <strong>Book Date For First Visit</strong>
      </div>
      <form id="bookingForm">
        <div class="card-body">
          @if ($first_visit==1)
          <p class="text-danger">You have already attended the first visit. Therefore, rebooking is not possible. Contact Ragama Guru office for additional details</p>
          <input type="date" class="form-control mb-3 col-md-6" disabled value="{{ \Carbon\Carbon::today()->format('Y-m-d') }}">
          <button type="button" class="btn btn-success mt-3" disabled>Book Now</button>
          @else
          <input type="hidden" value="{{$customer->id}}">

          @if ($customer->country_type_id==2)
          <!-- Select Country Type -->
          <div class="mb-3">
            <label for="country" class="form-label">Select Country:</label>
            <select class="form-control col-md-6" id="country" name="country">
              @foreach($countries as $country)
              <option value="{{ $country->id }}">{{ $country->name }}</option>
              @endforeach
            </select>
          </div>
          @endif

          <label for="bookingDate" class="form-label">Select Date:</label>
          <input type="date" class="form-control mb-3 col-md-6" id="bookingDate" name="bookingDate" value="{{ \Carbon\Carbon::today()->format('Y-m-d') }}">
          <button type="button" id="submitbtn" class="btn btn-success mt-3" onclick="checkDate();">Book Now</button>
          @endif
        </div>
      </form>
    </div>
  </div>

  <!-- OTP Modal -->
  <div class="modal fade" id="otpModal" tabindex="-1" aria-labelledby="otpModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="otpModalLabel">Verification</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="otp-form">
            <div class="mb-3">
              <label for="otp" class="form-label">Verify your contact number before booking. OTP will be sent to your contact number.</label>
              <input type="text" class="form-control" id="otp" placeholder="Enter OTP" required>
              <p class="text-danger" id="otpmsg"></p>
            </div>
            <button type="submit" class="btn btn-primary">Verify</button>
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


  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <!-- sweetalert -->

  <script src="assets/sweetalert/sweetalert.min.js" type="text/javascript"></script>
  <script src="assets/web/website_assets/js/script.js"></script>
  <script src="assets/web/website_assets/js/subscriber_email.js"></script>

  <script src="https://maps.googleapis.com/maps/api/js?key=">

  </script>

  <script src="assets/web/website_assets/js/loadMap.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <script src="assets/web/js/pagination.js"></script>
  @include('includes.script')



  <script>
    function checkDate() {
      var bookingDate = document.getElementById('bookingDate').value;
      let customerId = document.querySelector('input[type="hidden"]').value;

      fetch('/check-date', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
          },
          body: JSON.stringify({
            booking_date: bookingDate,
            customer_id: customerId
          })
        })
        .then(response => response.json())
        .then(data => {
          if (data.success) {
            sendOtp();
            // alert(data.message);
          } else {
            Swal.fire({
              title: 'Error!',
              text: data.message,
              icon: 'error',
              confirmButtonText: 'OK'
            });
          }
        });
    }

    function sendOtp() {
      let customerId = document.querySelector('input[type="hidden"]').value;
      var otpmsg = document.getElementById('otpmsg');
      otpmsg.innerText = " ";

      fetch('/generate-otp', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
          },
          body: JSON.stringify({
            customer_id: customerId
          })
        })
        .then(response => response.json())
        .then(data => {
          if (data.success) {
            $('#otpModal').modal('show');
          } else {
            alert(data.message);
          }
        });
    }

    document.getElementById('otp-form').addEventListener('submit', function(event) {
      event.preventDefault();

      let enteredOtp = document.getElementById('otp').value;
      let customerId = document.querySelector('input[type="hidden"]').value;
      var otpmsg = document.getElementById('otpmsg');

      fetch('/verify-otp', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
          },
          body: JSON.stringify({
            customer_id: customerId,
            otp: enteredOtp
          })
        })
        .then(response => response.json())
        .then(data => {
          if (data.success) {
            // Submit the booking form if OTP is correct
            saveBooking();
          } else {
            otpmsg.innerText = "Invalid OTP. Please try again.";
          }
        });
    });


    function saveBooking() {
      let customerId = document.querySelector('input[type="hidden"]').value;
      let bookingDate = document.getElementById('bookingDate').value;

      let countrySelect = document.getElementById('country');
      let country = null;

      if (countrySelect) {
        country = countrySelect.value;
      }

      fetch('/bookingstore', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
          },
          body: JSON.stringify({
            customer_id: customerId,
            booking_date: bookingDate,
            country: country
          })
        })
        .then(response => response.json())
        .then(data => {
          if (data.success) {
            $('#otpModal').modal('hide');
            Swal.fire({
              title: 'Success!',
              text: 'OTP verified and booking completed successfully.',
              icon: 'success',
              confirmButtonText: 'OK'
            }).then(() => {
              window.location.reload();
            });
          } else {
            alert(data.message);
          }
        });
    }
  </script>



  @include('includes.footer')



</body>

</html>