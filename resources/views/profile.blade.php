<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
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

        .profile-view .card {
            border: 1px solid #ddd;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .profile-view .card-header {
            font-weight: bold;
            background-color: #f8f9fa;
        }

        .profile-view .nav-link {
            font-size: 15px;
            padding: 10px;
            color: #333;
            border-radius: 5px;
            transition: background-color 0.3s, color 0.3s;
        }

        .profile-view .nav-link.active {
            background-color: #007bff;
            color: white;
        }

        .profile-view .nav-link:hover {
            background-color: #e9ecef;
        }

        .profile-view .tab-pane {
            padding-top: 20px;
        }

        .profile-view .list-group-item {
            background-color: transparent;
            border-bottom: 1px solid #ddd;
            padding: 8px 0;
        }

        .table-wrapper {
            max-height: 300px;
            overflow-y: auto;
        }

        .table-responsive {
            overflow-x: auto;
        }

        .table thead th {
            position: sticky;
            top: 0;
            background-color: white;
            z-index: 1;
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
                <h2 id="content-title">PROFILE</h2>
            </div>
        </div>
    </div>

    <div class="container mt-5 profile-view">
        <div class="row">
            <!-- Sidebar Navigation -->
            <div class="col-lg-3 mt-3">
                <div class="card">
                    <div class="card-body text-center">
                        <h5 class="font-weight-bold">My Profile</h5>
                        <ul class="nav flex-column mt-4">
                            <li class="nav-item">
                                <a class="nav-link active" href="#personal-details" data-toggle="tab">Personal Details</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#booking-details" data-toggle="tab">Booking Details</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#order-details" data-toggle="tab">Order Details</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#change-password" data-toggle="tab">Change Password</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Content Area -->
            <div class="col-lg-9">

                <div class="tab-content">
                    <!-- Personal Details Tab -->
                    <div class="tab-pane fade show active" id="personal-details">
                        <div class="card">
                            <div class="card-header bg-info text-white">
                                <h5 style="color:white;">Personal Details</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h6 class="font-weight-bold">Name:</h6>
                                        <p>{{$customer->name}}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <h6 class="font-weight-bold">Contact:</h6>
                                        <p>{{$customer->contact}}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <h6 class="font-weight-bold">Address:</h6>
                                        @if ($customer->address)
                                        <p>{{$customer->address}}</p>
                                        @else
                                        <p>No Address</p>
                                        @endif
                                    </div>
                                    <div class="col-md-6">
                                        <h6 class="font-weight-bold">Country Type:</h6>
                                        <p>{{$customer->countryType->name}}</p>
                                    </div>
                                    @if ($customer->countryType->name==='International')
                                    <div class="col-md-6">
                                        <h6 class="font-weight-bold">Country:</h6>
                                        <p id="countryName"></p>
                                    </div>
                                    @endif
                                    <div class="col-md-6">
                                        <button class="btn btn-info" data-toggle="modal" data-target="#updateCustomerModal">Update</button>
                                    </div>
                                </div>
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

                    <!-- Booking Details Tab -->
                    <div class="tab-pane fade" id="booking-details">
                        <div class="card">
                            <div class="card-header bg-info text-white">
                                <h5 style="color:white;">Booking Details</h5>
                            </div>
                            <div class="card-body">
                                @if ($bookings && $bookings->count() > 0)
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover">
                                        <thead class="">
                                            <tr>
                                                <th>Booked Date</th>
                                                <th>Appointment Number</th>
                                                <th>Appointment Type</th>
                                                <th>Created By</th>
                                                <th>Total Amount (LKR)</th>
                                                <th>Paid Amount (LKR)</th>
                                                <th>Due Amount (LKR)</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($bookings as $booking)
                                            <tr>
                                                <!-- Booked Date -->
                                                <td>{{ \Carbon\Carbon::parse($booking->date)->format('M d, Y') }}</td>

                                                <!-- Appointment Number -->
                                                <td>{{ $booking->apNumber->number }}</td>

                                                <!-- Appointment Type and Price -->
                                                <td>
                                                    {{ $booking->appointmentType->type }} (LKR {{ number_format($booking->appointmentType->price, 2) }})
                                                </td>

                                                <!-- Created By -->
                                                <td>{{ $booking->created_by }}</td>

                                                <!-- Total Amount -->
                                                <td>{{ number_format($booking->total_amount, 2) }}</td>

                                                <!-- Paid Amount -->
                                                <td>{{ number_format($booking->paid_amount, 2) }}</td>

                                                <!-- Due Amount -->
                                                <td>{{ number_format($booking->due_amount, 2) }}</td>

                                                <td>{{$booking->status == 0 ? 'Canceled' : 'Active'}}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                @else
                                <p>You haven't booked a date yet. Go To <a href="{{route('cusAppointmentCreate')}}">Appointments</a> to book a date</p>
                                @endif

                            </div>
                        </div>
                    </div>

                    <!-- Order Details Tab -->
                    <div class="tab-pane fade" id="order-details">
                        <div class="card">
                            <div class="card-header bg-info text-white">
                                <h5 style="color:white;">Order Details</h5>
                            </div>
                            <div class="card-body">
                                @if ($orders->isEmpty())
                                <p>You haven't orders yet. Go To <a href="{{route('store')}}">Online Store</a> to place order.</p>
                                @else
                                <div class="table-wrapper">
                                    <div class="table-responsive">
                                        <table class="table table-striped text-center">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Order ID</th>
                                                    <th scope="col">Ordered Date</th>
                                                    <th scope="col">Total Amount</th>
                                                    <th scope="col">Payment Type</th>
                                                    <th scope="col">Order Status</th>
                                                    <th scope="col">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($orders as $order)
                                                <tr>
                                                    <td>{{ $order->order_code }}</td>
                                                    <td>{{ $order->date }}</td>
                                                    <td class="text-end">LKR {{ $order->total_cost_payment }}</td>
                                                    <td>{{ $order->payment_type }}</td>
                                                    <td>{{ $order->orderStatus->name }}</td>
                                                    <td>
                                                        <button class="btn btn-sm btn-info view-order-details" data-order-id="{{ $order->id }}">
                                                            <i class="fa fa-eye"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="change-password">
                        <div class="card">
                            <div class="card-header bg-info text-white">
                                <h5 style="color:white;">Change Password</h5>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('password.update') }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="current_password" class="form-label">Current Password</label>
                                        <input type="password" class="form-control" id="current_password" name="current_password" required>
                                        @error('current_password')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="new_password" class="form-label">New Password</label>
                                        <input type="password" class="form-control" id="new_password" name="new_password" required>
                                        @error('new_password')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="new_password_confirmation" class="form-label">Confirm New Password</label>
                                        <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation" required>
                                        @error('new_password_confirmation')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <button type="submit" class="btn btn-success">Save Password</button>
                                </form>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Update Customer Modal -->
    <div class="modal fade" id="updateCustomerModal" tabindex="-1" role="dialog" aria-labelledby="updateCustomerModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateCustomerModalLabel">Update Customer Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="updateCustomerForm" method="POST" action="{{route('updateCusDetails',$customer->id)}}">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ $customer->name }}" required>
                            @error('name')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="address">Address</label>
                            <input type="text" class="form-control" id="address" name="address" value="{{ $customer->address }}">
                            @error('address')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="contact">Contact</label>
                            <input type="text" class="form-control" id="contact" name="contact" readonly value="{{ $customer->contact }}">
                        </div>
                        @if ($customer->countryType->name === 'International')
                        <div class="form-group">
                            <label for="country">Country</label>
                            <select class="form-control" id="country" name="country_id">
                                <option value="" disabled selected>Select your country</option>
                                <!-- Add options dynamically here -->
                            </select>
                            @error('country_id')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        @endif
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="orderDetailsModal" tabindex="-1" aria-labelledby="orderDetailsModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="orderDetailsModalLabel">Order Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p><strong>Order Code:</strong> <span id="modalOrderCode"></span></p>
                    <p><strong>Date:</strong> <span id="modalOrderDate"></span></p>

                    <p><strong>Items:</strong></p>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">Item Name</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Total Cost</th>
                            </tr>
                        </thead>
                        <tbody id="modalOrderItems">

                        </tbody>
                    </table>

                    <table class="table table-bordered mt-3">
                        <tbody>
                            <tr>
                                <th scope="row">Sub Total:</th>
                                <td>LKR <span id="modalSubTotal"></span></td>
                            </tr>
                            <tr>
                                <th scope="row">Shipping Cost:</th>
                                <td>LKR <span id="modalShippingCost"></span></td>
                            </tr>
                            <tr>
                                <th scope="row">Total Amount:</th>
                                <td>LKR <span id="modalTotalAmount"></span></td>
                            </tr>
                        </tbody>
                    </table>

                    <p><strong>Payment Type:</strong> <span id="modalPaymentType"></span></p>
                    <p><strong>Order Status:</strong> <span id="modalOrderStatus"></span></p>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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

    <!-- sweetalert -->

    <script src="assets/sweetalert/sweetalert.min.js" type="text/javascript"></script>
    <script src="assets/web/website_assets/js/script.js"></script>
    <script src="assets/web/website_assets/js/subscriber_email.js"></script>

    <script src="https://maps.googleapis.com/maps/api/js?key=">

    </script>

    <script src="assets/web/website_assets/js/loadMap.js"></script>

    <script src="assets/web/js/pagination.js"></script>
    @include('includes.script')



    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const viewButtons = document.querySelectorAll('.view-order-details');

            viewButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const orderId = this.getAttribute('data-order-id');

                    fetch('{{ route("showOrderDetails", ":orderId") }}'.replace(':orderId', orderId))
                        .then(response => response.json())
                        .then(order => {
                            document.getElementById('modalOrderCode').textContent = order.order_code;
                            document.getElementById('modalOrderDate').textContent = order.date;

                            const itemsTableBody = document.getElementById('modalOrderItems');
                            itemsTableBody.innerHTML = '';
                            order.items.forEach(item => {
                                const row = document.createElement('tr');
                                row.innerHTML = `
                                    <td>${item.item_name}</td>
                                    <td>${item.quantity}</td>
                                    <td>LKR ${item.total_cost}</td>
                                `;
                                itemsTableBody.appendChild(row);
                            });

                            document.getElementById('modalSubTotal').textContent = order.sub_total;
                            document.getElementById('modalShippingCost').textContent = order.shipping_cost;
                            document.getElementById('modalTotalAmount').textContent = order.total_cost_payment;
                            document.getElementById('modalPaymentType').textContent = order.payment_type;
                            document.getElementById('modalOrderStatus').textContent = order.order_status.name;

                            const orderModal = new bootstrap.Modal(document.getElementById('orderDetailsModal'));
                            orderModal.show();
                        });
                });
            });
        });


        $(document).ready(function() {
            var countryId = "{{ $customer->country_id ?? '' }}";

            if (countryId) {
                // Fetch all country data from the API
                $.ajax({
                    url: 'https://restcountries.com/v3.1/all',
                    method: 'GET',
                    success: function(data) {
                        // Find the country with the matching `cca2` code
                        const country = data.find(country => country.cca2 === countryId);

                        if (country) {
                            $('#countryName').text(country.name.common); // Update the country name
                        } else {
                            $('#countryName').text('Country not found');
                        }
                    },
                    error: function() {
                        $('#countryName').text('Error fetching country name');
                    }
                });
            }
        });
    </script>

    <script>
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
                    }
                },
                error: function(error) {
                    console.log("Error fetching country data: ", error);
                }
            });
        });
    </script>



    @include('includes.footer')



</body>

</html>