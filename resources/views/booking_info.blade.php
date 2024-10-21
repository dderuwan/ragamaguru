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
    <!-- Include Flatpickr CSS and JS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
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
    <!-- Add Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
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


    <div class="container my-5">

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
        @if (session('warning'))
        <div class="alert alert-warning">
            {{ session('warning') }}
        </div>
        @endif

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mt-2 mb-5" id="booking-info-card" style="border: 1px solid #ddd; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
                    <div class="card-header bg-info text-white text-center">
                        <h4 class="mb-0 text-white">Booking</h4>
                    </div>
                    <div class="card-body">
                        <div class="booking-info">
                            <h5 class="text-secondary"><i class="fas fa-calendar-alt"></i> Booking Schedule</h5>
                            <p class="lead font-weight-normal text-dark">
                                {!! $bookingInfo->info_text ?? 'No booking information available.' !!}
                            </p>
                        </div>
                        <hr>

                        <!-- Events Section -->

                    </div>
                    <div class="card-footer text-muted text-center">
                        <a type="button" class="btn btn-sm btn-primary mb-2" href="{{route('cusAppointmentCreate')}}" id="bookNowBtn">Book Now >></a>
                        <p class="mb-0">For more information, please contact our office at {{$companyDetail->contact ?? 'RagamaGuru Office'}}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mt-2 mb-5" id="booking-info-card" style="border: 1px solid #ddd; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
                    <div class="card-header bg-info text-white text-center">
                        <h4 class="mb-0 text-white">Events</h4>
                    </div>
                    <div class="card-body">


                        <!-- Events Section -->
                        <div class="event-info">
                            <h5 class="text-secondary"><i class="fas fa-bell"></i> Upcoming Events</h5>
                            @if($events->isNotEmpty())
                            <ul class="list-unstyled mt-3">
                                @foreach ($events as $event)
                                <li class="media mb-3">
                                    <div class="media-body">
                                        <h6 class="mt-0 mb-1 font-weight-bold">{{ $event->name }}</h6>
                                        <span class="text-muted">Date(s):
                                            @php
                                            $dates = json_decode($event->dates);
                                            echo implode(', ', $dates);
                                            @endphp
                                        </span> <br />
                                        <span class="text-muted">Time: {{ $event->start_time }} - {{ $event->end_time }} | Location: {{ $event->location }}</span>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                            @else
                            <p class="text-muted">No upcoming events available.</p>
                            @endif
                        </div>
                    </div>
                    <div class="card-footer text-muted text-center">
                        <a type="button" class="btn btn-sm btn-primary mb-2" href="{{route('cusAppointmentCreate')}}" id="bookNowBtn">Book Now >></a>
                        <p class="mb-0">For more information, please contact our office at {{$companyDetail->contact ?? 'RagamaGuru Office'}}</p>
                    </div>
                </div>
            </div>
        </div>






    </div>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>











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