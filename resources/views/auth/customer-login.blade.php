<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="favicon.ico">
    <link rel="icon" href="{{ asset('images/logos/' . app(\App\Http\Controllers\CompanySettingController::class)->getCompanyLogo()) }}" />
    <title>@yield('title', 'RAGAMA GURU ADMIN SIDE')</title>

    <!-- Fonts CSS -->
    <link href="https://fonts.googleapis.com/css2?family=Overpass:ital,wght@0,100;0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    @include('layouts.main.css')
</head>

<body class="light ">
    <div class="container-fluid">
        <div class="wrapper vh-100">
            <div class="row align-items-center h-100">
                <form method="POST" action="{{ route('customer.login') }}" class="col-lg-3 col-md-4 col-10 mx-auto text-center">
                    @csrf
                    <a class="navbar-brand mx-auto mt-2 flex-fill text-center" href="#">
                        <img src="{{ asset('images/logos/' . app(\App\Http\Controllers\CompanySettingController::class)->getCompanyLogo()) }}"
                            style="width:auto; height: 100px;" class="mt-2" alt="Company Logo">
                    </a>
                    <h4 class=" mb-3">Sign in</h4>
                    <div class="form-group">
                        <label for="contact" class="sr-only">Contact Number</label>
                        <input type="text" id="contact" name="contact" class="form-control form-control-lg" placeholder="Contact Number" required="" autofocus="">
                    </div>
                    <div class="form-group">
                        <label for="inputPassword" class="sr-only">Password</label>
                        <input type="password" id="inputPassword" name="password" class="form-control form-control-lg" placeholder="Password" required="">
                    </div>
                    <div class="checkbox mb-3">
                        <label>
                            <input type="checkbox" name="remember" value="remember-me"> Stay logged in
                        </label>
                    </div>
                    <button class="btn btn-lg btn-primary btn-block" type="submit">Let me in</button>
                    <p class="mt-5 mb-3 text-muted">© 2024 RagamaGuru</p>
                </form>

            </div>
        </div>
    </div>

    @include('layouts.main.script')
    @yield('scripts')
    <x-notify::notify />
</body>

</html>
