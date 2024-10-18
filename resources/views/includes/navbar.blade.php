<nav class="navbar navbar-expand-lg navbar-light header-sticky shadow-sm">
    <a class="navbar-brand" href="{{ route('home') }}">
        <img src="{{ asset('images/logos/' . app(\App\Http\Controllers\CompanySettingController::class)->getCompanyLogo()) }}"
            style="width:auto; height:35px;" class="mt-4" alt="Company Logo">
    </a>
    <div class="d-flex order-lg-last">
        <ul class="navbar-right">
            @auth('customer') <!-- Check if the user is logged in as a customer -->
                <!-- Dropdown for Profile and Logout -->
                <div class="dropdown mt-4 btn-container" style="margin-right:20px;">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Hello, {{ Auth::guard('customer')->user()->name }}! <!-- Show user's name with dropdown arrow -->
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown" style="margin-top:20px;">
                        <li>
                            <!-- Profile link styled with blue color -->
                            <a class="dropdown-item" href="{{ route('goToProfile') }}" style="color: #007bff;">PROFILE</a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <!-- Add a logout button with red background and white text -->
                            <form id="logout-form" action="{{ route('customer.logout') }}" method="POST" style="display: inline;">
                                @csrf
                                <button type="submit" class="dropdown-item" style=" color: #dc3545; border: none; margin-left:20px;">LOGOUT</button>
                            </form>
                        </li>
                    </ul>

                </div>
            @else
                <!-- Show the Sign In button if the user is not authenticated -->
                <div class="mt-4 btn-container" style="margin-right:20px;">
                    <a href="{{ route('customer.login') }}" class="btn btn-primary btn-custom" style="padding: 7px 10px;color: #fff;font-size:12px;">SIGN IN</a>
                </div>
            @endauth
        </ul>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    </div>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="{{ route('welcome') }}">Entrance</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="{{ route('home') }}">Home</a>
            </li>

            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="{{route('bookingInfo')}}">Appointments</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="{{ route('store') }}">Online Store</a>
            </li>
        </ul>
    </div>
</nav>
