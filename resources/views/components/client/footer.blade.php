<!-- FOOTER
================================================== -->
<footer class="pt-8 pt-md-11 bg-white">
    <div class="container">
        <div class="row" id="accordionFooter">
            <div class="col-12 col-md-4 col-lg-4">

                <!-- Brand -->
                <img src="{{ asset('nia-lab.jpeg')}}" alt="..." class="footer-brand img-fluid mb-4 h-60p">

                <!-- Text -->
                <p class="text-gray-800 mb-4 font-size-sm-alone">
                    {{ setting('address') }}
                </p>

                <div class="mb-4">
                    <a href="tel:{{ setting('contact_phone_number') }}" class="text-gray-800 font-size-sm-alone">{{ setting('contact_phone_number') }}</a>
                </div>

                <div class="mb-4">
                    <a href="mailto:{{ setting('contact_email') }}" class="text-gray-800 font-size-sm-alone">{{ setting('contact_email') }}</a>
                </div>

                <!-- Social -->
                <ul class="list-unstyled list-inline list-social mb-4 mb-md-0">
                    <li class="list-inline-item list-social-item">
                        <a href="#" class="text-secondary font-size-sm w-36 h-36 shadow-dark-hover d-flex align-items-center justify-content-center rounded-circle border-hover">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                    </li>
                    <li class="list-inline-item list-social-item">
                        <a href="#" class="text-secondary font-size-sm w-36 h-36 shadow-dark-hover d-flex align-items-center justify-content-center rounded-circle border-hover">
                            <i class="fab fa-twitter"></i>
                        </a>
                    </li>
                    <li class="list-inline-item list-social-item">
                        <a href="#" class="text-secondary font-size-sm w-36 h-36 shadow-dark-hover d-flex align-items-center justify-content-center rounded-circle border-hover">
                            <i class="fab fa-instagram"></i>
                        </a>
                    </li>
                    <li class="list-inline-item list-social-item">
                        <a href="#" class="text-secondary font-size-sm w-36 h-36 shadow-dark-hover d-flex align-items-center justify-content-center rounded-circle border-hover">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    </li>
                </ul>
            </div>


            <div class="col-12 mt-md-5">
                <div class="border-top pb-5 pt-6 py-md-4 text-center text-xl-start d-flex flex-column d-md-block d-xl-flex flex-xl-row align-items-center">
                    <p class="text-gray-800 font-size-sm-alone d-block mb-0 mb-md-2 mb-xl-0 order-1 order-md-0 px-9 px-md-0">Copyright © {{ date('Y') }} {{ config('app.name') }}. All Right Reserved.</p>

                    <div class="ms-xl-auto d-flex flex-column flex-md-row align-items-stretch align-items-md-center justify-content-center">
                        <ul class="navbar-nav flex-row flex-wrap font-size-sm-alone mb-3 mb-md-0 mx-n4 me-md-5 justify-content-center justify-content-lg-start order-1 order-md-0">
                            <li class="nav-item py-2 py-md-0 px-0 border-top-0">
                                <a href="#" class="nav-link px-4 fw-normal text-gray-800">Home</a>
                            </li>
                            <li class="nav-item py-2 py-md-0 px-0 border-top-0">
                                <a href="#" class="nav-link px-4 fw-normal text-gray-800">Site Map</a>
                            </li>
                            <li class="nav-item py-2 py-md-0 px-0 border-top-0">
                                <a href="#" class="nav-link px-4 fw-normal text-gray-800">Privacy policy</a>
                            </li>
                            <li class="nav-item py-2 py-md-0 px-0 border-top-0">
                                <a href="#" class="nav-link px-4 fw-normal text-gray-800">Web Use Policy</a>
                            </li>
                            <li class="nav-item py-2 py-md-0 px-0 border-top-0">
                                <a href="#" class="nav-link px-4 fw-normal text-gray-800">Cookie Policy</a>
                            </li>
                        </ul>

                    </div>
                </div>
            </div>
        </div> <!-- / .row -->
    </div> <!-- / .container -->
</footer>
