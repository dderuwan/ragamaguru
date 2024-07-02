<nav class="navbar navbar-expand-lg navbar-light header-sticky shadow-sm">
     <a class="navbar-brand" href=""><img src="assets/img/2023-12-25/I.png" alt=""></a>
        <div class="d-flex order-lg-last">
        <ul class="navbar-right">
            <div class="mt-4 btn-container" style="margin-right:50px; ">
                <a href="{{ route('login') }}" class="btn btn-primary btn-custom" style="padding: 7px 10px;color: #fff;font-size:12px;">SIGN IN</a>
            </div>
            <div class="mt-4 btn-container" style="margin-right:50px; ">
                <a href="{{ route('register') }}" class="btn btn-primary btn-custom" style="padding: 7px 10px;color: #fff;font-size:12px;">JOIN US</a>
            </div>
            
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
                <a class="nav-link active" aria-current="page" href="{{ route('appointment') }}">Appointments</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="{{ route('store') }}">Online Store</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="{{ route('products') }}">Products</a>
            </li>
            </ul>
        </div>
    </nav>
<!-- /.End of navbar -->