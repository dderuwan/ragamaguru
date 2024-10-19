<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'RagamaGuru')</title>
    <link rel="icon" href="{{ asset('images/logos/' . app(\App\Http\Controllers\CompanySettingController::class)->getCompanyLogo()) }}" />

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
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <!-- sweetalert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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

        .logoContent {
            color: black;
            margin-top: 30px;
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
                        <h4 class="text-white title mb-0">Checkout</h4>
                    </div>

                </div>
            </div>
        </div>
    </header>


    <div class="section section-checkout bg-gray">
        <div class="container">
            <div class="row">
                <div class="col-md-6 mb-4 mb-md-0">
                    <h4 class="custom-title position-relative font-weight-bold mb-4">Check Details
                    </h4>
                    <div class="card card-body border-0 p-5">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <h6 class="font-weight-bold col-md-5">Name:</h6>
                                    <h6 class="col-md-7">{{$userDetails->name}}</h6>
                                </div>
                                <div class="row">
                                    <h6 class="font-weight-bold col-md-5">Contact Number:</h6>
                                    <h6 class="col-md-7">{{$userDetails->contact}}</h6>
                                </div>
                                <div class="row">
                                    <h6 class="font-weight-bold col-md-5">Delivery Address:</h6>
                                    @if ($deliveryAddress)
                                    <div class="col-md-7" id="address">
                                        <h6>{{ $deliveryAddress->line1 }},</h6>
                                        <h6>{{ $deliveryAddress->line2 }},</h6>
                                        <h6>{{ $deliveryAddress->postal_code }},</h6>
                                        <h6>{{ $deliveryAddress->city }},</h6>
                                        <h6 id="countryName"></h6>
                                    </div>
                                    @else
                                    <h6 id="address" class="col-md-7 text-danger">Please update your address.</h6>
                                    @endif
                                    <button class="btn btn-sm btn-info mt-2 col-md-4 offset-md-5" data-toggle="modal" data-target="#updateAddressModal">Update Address</button>
                                </div>

                            </div>
                            <!-- <table class="table">
                                <thead>
                                    <tr>
                                        <th>Item Code</th>
                                        <th>Quantity</th>
                                        <th>Name</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($checkoutDetails['cartDetails'] as $item)
                                    <tr>
                                        <td>{{ $item['item_code'] }}</td>
                                        <td>{{ $item['quantity'] }}</td>
                                        <td>{{ $item['item_name'] }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table> -->
                        </div>

                    </div>
                </div>

                <div class="col-md-6">
                    <h4 class="custom-title position-relative font-weight-bold mb-4">
                        Payment Details</h4>
                    <div class="card card-body p-5 border-0">

                        <div class="row mb-4">

                            <div class="col-md-12">
                                <h5 class="font-weight-bold mb-3">Total Amount</h5>
                                <div class="row">
                                    <h6 class="text-dark font-weight-bold col-sm-6">Sub Total: </h6>
                                    <h6 class="font-weight-bold text-secondary col-sm-6">Rs. {{ $checkoutDetails['subTotal'] }}</h6>
                                </div>
                                <div class="row">
                                    <h6 class="text-dark font-weight-bold col-sm-6">Shipping Cost: </h6>
                                    <h6 class="font-weight-bold text-secondary col-sm-6">
                                        @if ($deliveryAddress)
                                        @if ($checkoutDetails['shippingCost'] == '0.00' || $checkoutDetails['shippingCost'] == 0)
                                        Free
                                        @elseif ($checkoutDetails['shippingCost'] > 0)
                                        Rs. {{ $checkoutDetails['shippingCost'] }}
                                        @endif
                                        @else
                                        Not Updated
                                        @endif
                                    </h6>

                                </div>
                                <div class="row">
                                    <h6 class="text-dark font-weight-bold col-sm-6">Grand Total: </h6>
                                    <h6 class="font-weight-bold text-success col-sm-6">Rs. {{ $checkoutDetails['grandTotal']}}</h6>
                                </div>
                            </div>

                            <div class="col-md-12 mt-3">
                                <label class="text-dark font-weight-600">Payment Method</label>
                                <select class="custom-select mr-sm-2" id="pmethod" name="pmethod">
                                    @foreach ($paymentTypes as $payment_type)
                                    <option value="{{$payment_type->id}}">{{$payment_type->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                @if ($deliveryAddress)
                                <button type="button" data-toggle="modal" data-target="#confirmModal" class="btn btn-primary">Submit</button>
                                @else
                                <button type="button" id="noaddress" class="btn btn-primary">Submit</button>
                                @endif
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>


    <!--UpdateAddress Modal -->
    <div class="modal fade" id="updateAddressModal" tabindex="-1" role="dialog" aria-labelledby="updateAddressModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateAddressModalLabel">Update Address</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('updateAddress', $userDetails->id) }}">
                        @csrf
                        <div class="form-group">
                            <label for="line1">Address Line 01</label>
                            <input type="text" class="form-control" id="line1" name="line1" placeholder="Enter Line 01" required>
                            @error('line1')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="line2">Address Line 02</label>
                            <input type="text" class="form-control" id="line2" name="line2" placeholder="Enter Line 02">
                            @error('line2')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="postal_code">Postal Code / Zip Code</label>
                            <input type="text" class="form-control" id="postal_code" name="postal_code" placeholder="Enter Code" required>
                            @error('postal_code')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="city">City</label>
                            <input type="text" class="form-control" id="city" name="city" placeholder="Enter City" required>
                            @error('city')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="country">Country</label>
                            <select class="form-control" id="country" name="country">
                                <option value="" disabled selected>Select your country</option>
                                <!-- Add options dynamically here -->
                            </select>
                            @error('country')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>

                </div>

            </div>
        </div>
    </div>
    

    <!-- Confirmation Modal -->
    <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="confirmModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmModalLabel">Order Confirmation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to create this order?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" id="confirmButton">Yes, Order</button>
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script src="assets/web/js/product.js"></script>
    <script src="assets/web/js/cart.js"></script>

    <script>
        document.getElementById('confirmButton').addEventListener('click', function() {
            var paymentMethodSelect = document.getElementById('pmethod').value;
            if (paymentMethodSelect == 1) { //card
                //online payment
                initiatePaymentGateway();
            } else if (paymentMethodSelect == 2) { //cod
                //cash on delivery
                orderAdd(paymentMethodSelect);
            }

        });


        function initiatePaymentGateway() {
            let data = {
                merchantRID: "{{ uniqid('ORD_') }}", // Unique order reference
                mode: 'WEB',
                paymentMethod: 'VISA_MASTERCARD',
                orderSummary: 'RagamaGuru Order',
                customerMobile: '{{$userDetails->contact}}', 
                threeDSecure: true
            };

            fetch('{{ route("createPaymentOrder") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify(data)
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        window.location.href = data.paymentUrl; // Redirect to payment gateway
                    } else {
                        alert(data.message);
                    }
                })
                .catch(error => console.error('Error:', error));
        }


        function orderAdd(paymentMethodSelect) {
            var data = {
                pmethod: paymentMethodSelect
            };

            fetch('{{ route("placeOrder") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify(data)
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        $('#confirmModal').modal('hide');
                        Swal.fire({
                            icon: 'success',
                            title: 'Orders Added!',
                            text: 'You can check your order in order details.',
                            confirmButtonText: 'OK'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = "{{ route('store') }}";
                            }
                        });

                    } else {
                        alert(data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }



        document.addEventListener('DOMContentLoaded', function() {
            var noAddressButton = document.getElementById('noaddress');

            if (noAddressButton) {
                noAddressButton.addEventListener('click', function(e) {
                    e.preventDefault();

                    Swal.fire({
                        icon: 'warning',
                        title: 'Address Missing',
                        text: 'Please update your address.',
                        confirmButtonText: 'OK'
                    });
                });
            }
        });


        $(document).ready(function() {
            // Fetch the list of countries from the API
            $.ajax({
                url: 'https://restcountries.com/v3.1/all',
                method: 'GET',
                success: function(data) {
                    var countrySelect = $('#country');
                    var savedCountryCode = '{{ $deliveryAddress->country ?? "" }}'; // Get saved country code from the server

                    // Sort the countries alphabetically
                    data.sort(function(a, b) {
                        return a.name.common.localeCompare(b.name.common);
                    });

                    // Append countries as options
                    data.forEach(function(country) {
                        var option = $('<option></option>')
                            .attr('value', country.cca2) // Use cca2 for country code
                            .text(country.name.common);

                        // Check if the country code matches the saved value
                        if (country.cca2 === savedCountryCode) {
                            option.attr('selected', 'selected'); // Pre-select the saved country
                            $('#countryName').text(country.name.common); // Display saved country name in the address section
                        }

                        countrySelect.append(option);
                    });
                },
                error: function(error) {
                    console.log('Error fetching country data:', error);
                }
            });
        });
    </script>

    @include('includes.footer')

</body>

</html>