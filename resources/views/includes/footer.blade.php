<footer class="main-footer py-2 border-top-muted bg-dark">
    <div class="py-5 bg-dark mt-2">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 text-center">
                    @if($companyDetail)
                        <h2 class="text-white">{{ $companyDetail->title }}</h2>
                        <div class="mt-3">
                            <ul class="list-unstyled social-icon d-flex flex-column flex-md-row justify-content-center">
                                <li class="mb-3 mb-md-0 mx-md-3">
                                    <a href="#" rel="noopener noreferrer" class="text-white d-flex align-items-center">
                                        <i class="fas fa-map-marker-alt icon-wrap mr-2"></i>
                                        <span>{{ $companyDetail->address }}</span>
                                    </a>
                                </li>
                                <li class="mb-3 mb-md-0 mx-md-3">
                                    <a href="#" rel="noopener noreferrer" class="text-white d-flex align-items-center">
                                        <i class="fas fa-phone icon-wrap mr-2"></i>
                                        <span>{{ $companyDetail->contact }}</span>
                                    </a>
                                </li>
                                <li class="mx-md-3">
                                    <a href="#" rel="noopener noreferrer" class="text-white d-flex align-items-center">
                                        <i class="fas fa-envelope icon-wrap mr-2"></i>
                                        <span>{{ $companyDetail->email }}</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    @else
                        <h2 class="text-white">No Details Available</h2>
                    @endif
                </div>
            </div>
        </div>
    </div>
</footer>



<!-- /.End of footer -->

<div class="border-top-muted bg-dark py-3">
    <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="container2">
                <ul class="list-unstyled menus d-flex justify-content-center">
                    <li><a href="{{ route('welcome') }}" rel="noopener noreferrer">
                            <span>Entrance</span></a></li>
                    <li><a href="{{ route('home') }}" rel="noopener noreferrer">
                            <span>Home</span></a></li>
                    <li><a href="{{ route('home') }}" rel="noopener noreferrer">
                            <span>Appointments</span></a></li>
                    <li><a href="{{ route('store') }}" rel="noopener noreferrer">
                            <span>Store</span></a></li>
                </ul>
                <p style="color:#999999;">
                    All Rights Reserved by
                    {{ $companyDetail->website ?? 'RagamaGuru' }}
                </p>

            </div>

        </div>

    </div>

</div>

<!-- /.End of sub footer -->