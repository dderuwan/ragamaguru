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

  <!-- Booking Step by Step Process -->
  <div class="container my-5">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="progress">
          <div class="progress-bar" id="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="33" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
      </div>
    </div>


    <!-- Step 1: Personal Details (Card Layout) -->
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card mt-4" id="step1">
          <div class="card-body">
            <h4 class="card-title">Step 1: Personal Details</h4>
            <form id="personalDetailsForm">
              <div class="row">
                <div class="col-md-6 mb-3">
                  <label for="name" class="form-label">Name<i class="text-danger">*</i></label>
                  <input type="text" class="form-control" id="name" value="{{$customer->name}}" disabled required>
                </div>
                <div class="col-md-6 mb-3">
                  <label for="contact" class="form-label">Contact<i class="text-danger">*</i></label>
                  <input type="text" class="form-control" id="contact" value="{{$customer->contact}}" required disabled>
                </div>
                <div class="{{ $customer->countryType->name == 'International' ? 'col-md-6' : 'col-md-12' }} mb-3">
                  <label for="address" class="form-label">Address<i class="text-danger">*</i></label>
                  @if ($customer->address)
                  <input type="text" class="form-control" id="address" value="{{$customer->address}}" disabled required>
                  @endif
                </div>
                @if ($customer->countryType->name=='International')
                <div class="col-md-6 mb-3">
                  <label for="country" class="form-label">Country<i class="text-danger">*</i></label>
                  <select class="form-control" id="country" required>
                    <option value="" disabled selected>Select your country</option> 
                    <!-- Add options dynamically here -->
                  </select>
                  <p id="countrymsg" class="text-danger"></p>
                </div>
                @endif
              </div>
              <a type="button" href="{{route('goToProfile')}}" class="btn btn-secondary">Update</a>
              <button type="button" class="btn btn-primary float-end" id="nextToStep2">Next</button>
            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- Step 2: Date Booking (Card Layout) -->
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card mt-4" id="step2" style="display: none;">
          <div class="card-body">
            <h4 class="card-title">Step 2: Booking</h4>
            <input type="hidden" id="customerId" value="{{$customer->id}}">
            <div class="row">
              <div class="col-md-12 mb-2">
                <label for="bookingType" class="form-label">Select Booking Type</label>
                <select class="form-control" id="bookingType" name="bookingType" required>
                  <option value="" disabled selected>Select booking type</option>
                  @foreach($appointmentTypes as $type)
                  <option value="{{ $type->id }}" data-price="{{ $type->price }}">
                    {{ $type->type }} - LKR {{ number_format($type->price, 2) }}
                  </option>
                  @endforeach
                </select>
                <p id="bookingtypemsg" class="text-danger"></p>
              </div>
              <div class="col-md-12 mb-2">
                <label for="bookingDate" class="form-label">Select Date</label>
                <input type="date" class="form-control" id="bookingDate" required>
                <p id="bookingdatemsg" class="text-danger"></p>
              </div>
            </div>
            <button type="button" class="btn btn-secondary" id="backToStep1">Back</button>
            <button type="button" class="btn btn-primary float-end" id="nextToStep3">Next</button>
          </div>

        </div>
      </div>
    </div>

    <!-- Step 3: appointment show Process (Card Layout) -->
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card mt-4" id="step3" style="display: none;">
          <div class="card-body">
            <h4 class="card-title">Step 3: Appointment </h4>
            <div class="form-group mb-3">
              <label for="bookedDate" class="form-label">Booked Date</label>
              <input type="text" class="form-control" id="bookedDate" readonly>
            </div>
            <div class="form-group mb-3">
              <label for="apNumber" class="form-label">Available Appointment Number</label>
              <input type="text" class="form-control" id="apNumber" readonly>
            </div>
            <button type="button" class="btn btn-secondary" id="backToStep2">Back</button>
            <button type="button" class="btn btn-primary float-end" id="nextToStep4">Next</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Step 3: Payment Process (Card Layout) -->
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card mt-4" id="step4" style="display: none;">
          <div class="card-body">
            <h4 class="card-title">Step 4: Payment </h4>
            <div class="form-group mb-3">
              <label for="paymentMethod" class="form-label">Payment Method</label>
              <select class="form-control" id="paymentMethod" required>
                <option value="" disabled selected>Select Method</option>
                <option value="Office">Pay At Office</option>
                <option value="Online">Pay At Online</option>
              </select>
              <p id="pmethodmsg" class="text-danger"></p>
            </div>
            <div class="form-group mb-3">
              <label for="amount" class="form-label">Amount</label>
              <input type="text" class="form-control" id="amount" readonly>
            </div>
            <button type="button" class="btn btn-secondary" id="backToStep3">Back</button>
            <button type="submit" class="btn btn-success float-end" id="submitBooking">Confirm Booking</button>
          </div>
        </div>
      </div>
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

  <script>
    $(document).ready(function() {
      $.ajax({
        url: 'https://restcountries.com/v3.1/all',
        method: 'GET',
        success: function(data) {
          var countrySelect = $('#country');

          data.sort(function(a, b) {
            return a.name.common.localeCompare(b.name.common);
          });

          data.forEach(function(country) {
            countrySelect.append('<option value="' + country.cca2 + '">' + country.name.common + '</option>');
          });
        },
        error: function(error) {
          console.log("Error fetching country data: ", error);
        } 
      });
    });

    $(document).ready(function() {
      var savedCountryId = "{{ $customer->country_id ?? '' }}"; // The saved country ID from the database

      $.ajax({
        url: 'https://restcountries.com/v3.1/all',
        method: 'GET',
        success: function(data) {
          var countrySelect = $('#country');

          data.sort(function(a, b) {
            return a.name.common.localeCompare(b.name.common);
          });

          data.forEach(function(country) {
            countrySelect.append('<option value="' + country.cca2 + '">' + country.name.common + '</option>');
          });

          if (savedCountryId) {
            countrySelect.val(savedCountryId); 
            countrySelect.prop('disabled', true);
          }
        },
        error: function(error) {
          console.log("Error fetching country data: ", error);
        }
      });
    });


  </script>


  <script>
    document.addEventListener('DOMContentLoaded', function() {

      // Step 1 validation: Ensure country is selected
      document.getElementById('nextToStep2').addEventListener('click', function() {
        const countryElement = document.getElementById('country');
        if (countryElement) {
          const country = countryElement.value;
          var countrymsg = document.getElementById('countrymsg');
          countrymsg.innerText = '';
          if (!country) {
            countrymsg.innerText = 'Please select a country';
            return;
          }
          // Hide Step 2 and show Step 3
          document.getElementById('step1').style.display = 'none';
          document.getElementById('step2').style.display = 'block';
          document.getElementById('progress-bar').style.width = '50%';
        }else{
          document.getElementById('step1').style.display = 'none';
          document.getElementById('step2').style.display = 'block';
          document.getElementById('progress-bar').style.width = '50%';
        }

      });

      // Step 2 validation: Ensure booking type and date are selected
      document.getElementById('nextToStep3').addEventListener('click', function() {
        const bookingType = document.getElementById('bookingType').value;
        const bookingDate = document.getElementById('bookingDate').value;
        const bookingtypemsg = document.getElementById('bookingtypemsg');
        const bookingdatemsg = document.getElementById('bookingdatemsg');
        bookingtypemsg.innerText = '';
        bookingdatemsg.innerText = '';
        if (!bookingType && !bookingDate) {
          bookingtypemsg.innerText = 'Please select a booking type';
          bookingdatemsg.innerText = 'Please select a booking date';
          return;
        }
        if (!bookingType) {
          bookingtypemsg.innerText = 'Please select a booking type';
          return;
        }
        if (!bookingDate) {
          bookingdatemsg.innerText = 'Please select a booking date';
          return;
        }

        checkDate();

      });

      // Step 2 validation: Ensure otp is entered
      document.getElementById('nextToStep4').addEventListener('click', function() {
        // Hide Step 2 and show Step 3
        document.getElementById('step3').style.display = 'none';
        document.getElementById('step4').style.display = 'block';
        document.getElementById('progress-bar').style.width = '100%';
      });

      // Back buttons functionality
      document.getElementById('backToStep1').addEventListener('click', function() {
        document.getElementById('step2').style.display = 'none';
        document.getElementById('step1').style.display = 'block';
        document.getElementById('progress-bar').style.width = '25%';
      });

      document.getElementById('backToStep2').addEventListener('click', function() {
        document.getElementById('step3').style.display = 'none';
        document.getElementById('step2').style.display = 'block';
        document.getElementById('progress-bar').style.width = '50%';
      });

      document.getElementById('backToStep3').addEventListener('click', function() {
        document.getElementById('step4').style.display = 'none';
        document.getElementById('step3').style.display = 'block';
        document.getElementById('progress-bar').style.width = '75%';
      });
    });

    function checkDate() {
      var bookingDate = document.getElementById('bookingDate').value;
      let customerId = document.getElementById('customerId').value;

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
            setApNumber();
            // Hide Step 2 and show Step 3
            document.getElementById('step2').style.display = 'none';
            document.getElementById('step3').style.display = 'block';
            document.getElementById('progress-bar').style.width = '75%';
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

    var apNumberId;

    function setApNumber() {
      const bookingDate = document.getElementById('bookingDate');
      const apNumber = document.getElementById('apNumber');
      const selectedDate = bookingDate.value;
      if (selectedDate) {

        fetch('/get-apnumber', {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json',
              'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
              selected_date: selectedDate
            })
          })
          .then(response => response.json())
          .then(data => {
            if (data.success) {
              bookedDate.value = selectedDate;
              apNumber.value = data.ap_number;
              apNumberId = data.ap_number_id;
            } else {
              alert(data.message);
            }
          });

      }
    }


    document.addEventListener('DOMContentLoaded', function() {
      const bookingTypeSelect = document.getElementById('bookingType');
      const amountInput = document.getElementById('amount');
      const bookedDate = document.getElementById('bookedDate');
      const nextToStep3Button = document.getElementById('nextToStep3');
      const step2 = document.getElementById('step2');
      const step3 = document.getElementById('step3');
      const backToStep2Button = document.getElementById('backToStep2');

      bookingTypeSelect.addEventListener('change', function() {
        const selectedOption = bookingTypeSelect.options[bookingTypeSelect.selectedIndex];
        const selectedPrice = selectedOption.getAttribute('data-price');

        if (selectedPrice) {
          amountInput.value = 'LKR ' + parseFloat(selectedPrice).toFixed(2);
        }
      });

    });



    document.getElementById('submitBooking').addEventListener('click', function() {
      const pMethod = document.getElementById('paymentMethod').value;
      const pmethodmsg = document.getElementById('pmethodmsg');
      pmethodmsg.innerText = '';
      if (!pMethod) {
        pmethodmsg.innerText = 'Please select a method';
        return;
      }
      sendOtp();
    });

    var otpModal = new bootstrap.Modal(document.getElementById('otpModal'), {
      backdrop: 'static',
      keyboard: false
    });

    function sendOtp() {
      let customerId = document.getElementById('customerId').value;
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
            otpModal.show();
          } else {
            alert(data.message);
          }
        });
    }

    document.getElementById('otp-form').addEventListener('submit', function(event) {
      event.preventDefault();

      let enteredOtp = document.getElementById('otp').value;
      let customerId = document.getElementById('customerId').value;
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
            $('#otpModal').modal('hide');
            saveBooking();
          } else {
            otpmsg.innerText = "Invalid OTP. Please try again.";   
          }
        });
    });



    function saveBooking() {
      let customerId = document.getElementById('customerId').value;
      let countrySelect = document.getElementById('country');
      let country = null;
      if (countrySelect) {
        country = countrySelect.value;
      }
      let bookingDate = document.getElementById('bookingDate').value;
      let bookingType = document.getElementById('bookingType').value;
      let paymentMethod = document.getElementById('paymentMethod').value;

      if (paymentMethod == 'Office') {

        let url = window.location.origin + '/bookingstore';
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        fetch(url, {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json',
              'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify({
              customer_id: customerId,
              country_id: country,
              booking_date: bookingDate,
              booking_type: bookingType,
              payment_method: paymentMethod,
              ap_number_id: apNumberId
            })
          })
          .then(response => {
            if (!response.ok) {
              throw new Error('Network response was not ok');
            }
            return response.json();
          })
          .then(data => {
            if (data.success) {
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
          })
          .catch(error => {
            console.error('There was a problem with the fetch operation:', error);
          });


      } else if (paymentMethod == 'Online') {

      }
    }
  </script>







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






  @include('includes.footer')



</body>

</html>