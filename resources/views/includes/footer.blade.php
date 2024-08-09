<footer class="main-footer py-5 border-top-muted bg-dark">
    <div class="py-5 bg-dark mt-2">
        <div class="container1">
            <div class="row justify-content-center">
                <div class="col-md-12 col-lg-12">
                    <div class="">
                        @if($companyDetail)
                            <h2 class="text-center text-white">{{ $companyDetail->title }}</h2>
                            <div class="container1 mt-3">
                                <ul class="list-unstyled social-icon d-flex justify-content-around">
                                    <li>
                                        <a href="" rel="noopener noreferrer">
                                            <i class="fas fa-map-marker-alt icon-wrap"></i>
                                            <span>{{ $companyDetail->address }}</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="" rel="noopener noreferrer">
                                            <i class="fas fa-phone icon-wrap"></i>
                                            <span>{{ $companyDetail->contact }}</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="" rel="noopener noreferrer">
                                            <i class="fas fa-envelope icon-wrap"></i>
                                            <span>{{ $companyDetail->email }}</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        @else
                            <h2 class="text-center text-white">No Details Available</h2>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>



<!-- /.End of footer -->

<div class="border-top-muted bg-dark py-3">
        <div class="container">
            <div class="row justify-content-end align-items-center">
                <div class="container2">
                            <ul class="list-unstyled menus d-flex justify-content-around">
                                <li><a href="{{ route('welcome') }}"  rel="noopener noreferrer">
                                   <span>Entrance</span></a></li>
                                <li><a href="{{ route('home') }}"  rel="noopener noreferrer">
                                    <span>Home</span></a></li>
                                <li><a href="{{ route('home') }}"  rel="noopener noreferrer">
                                   <span>Appointments</span></a></li>
                                   
                            </ul>
                            <p style="color:#999999;">All Rights Reserved by RaagamaGuru.lk</p>
                        </div>

            </div>

        </div>

    </div>

    <!-- /.End of sub footer -->

