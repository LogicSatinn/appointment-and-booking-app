@section('title', 'Home')

<x-client.master-layout>

    <!-- HERO
    ================================================== -->
    <section class="py-4 py-md-13 position-relative bg-white">
        <!-- Cursor position parallax -->
        <div class="position-absolute right-0 left-0 top-0 bottom-0">
            <div class="cs-parallax">
                <div class="cs-parallax-layer" data-depth="0.1">
                    <img class="img-fluid" src="{{ asset('frontend/img/parallax/layer-01.svg')}}" alt="Layer">
                </div>
                <div class="cs-parallax-layer" data-depth="0.3">
                    <img class="img-fluid" src="{{ asset('frontend/img/parallax/layer-02.svg')}}" alt="Layer">
                </div>
                <div class="cs-parallax-layer" data-depth="0.2">
                    <img class="img-fluid" src="{{ asset('frontend/img/parallax/layer-03.svg')}}" alt="Layer">
                </div>
                <div class="cs-parallax-layer" data-depth="0.2">
                    <img class="img-fluid" src="{{ asset('frontend/img/parallax/layer-04.svg')}}" alt="Layer">
                </div>
                <div class="cs-parallax-layer" data-depth="0.4">
                    <img class="img-fluid" src="{{ asset('frontend/img/parallax/layer-05.svg')}}" alt="Layer">
                </div>
                <div class="cs-parallax-layer" data-depth="0.3">
                    <img class="img-fluid" src="{{ asset('frontend/img/parallax/layer-06.svg')}}" alt="Layer">
                </div>
                <div class="cs-parallax-layer" data-depth="0.2">
                    <img class="img-fluid" src="{{ asset('frontend/img/parallax/layer-07.svg')}}" alt="Layer">
                </div>
                <div class="cs-parallax-layer" data-depth="0.2">
                    <img class="img-fluid" src="{{ asset('frontend/img/parallax/layer-08.svg')}}" alt="Layer">
                </div>
                <div class="cs-parallax-layer" data-depth="0.4">
                    <img class="img-fluid" src="{{ asset('frontend/img/parallax/layer-09.svg')}}" alt="Layer">
                </div>
                <div class="cs-parallax-layer" data-depth="0.3">
                    <img class="img-fluid" src="{{ asset('frontend/img/parallax/layer-10.svg')}}" alt="Layer">
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row align-items-center">
                <div class="col-12 col-md-5 col-lg-6 order-md-2" data-aos="fade-in" data-aos-delay="50">

                    <!-- Image -->
                    <img src="{{ asset('frontend/img/illustrations/illustration-1.png')}}"
                         class="img-fluid mw-md-150 mw-lg-130 mb-6 mb-md-0" alt="...">

                </div>
                <div class="col-12 col-md-7 col-lg-6 order-md-1 px-md-0">
                    <!-- Heading -->
                    <h1 class="display-2" data-aos="fade-left" data-aos-duration="150">
                        Learn With <span class="text-orange fw-bold">Us</span>
                    </h1>

                    <!-- Text -->
                    <p class="lead pe-md-8 text-capitalize" data-aos="fade-up" data-aos-duration="200">
                        Technology is bringing a massive wave of evolution on learning things in different ways.
                    </p>

                    <!-- Buttons -->
                    <a href="course-list-v1.html" class="btn btn-primary btn-wide lift d-none d-lg-inline-block"
                       data-aos-duration="200" data-aos="fade-up">View Skills</a>

                </div>
            </div> <!-- / .row -->
        </div> <!-- / .container -->
    </section>

    <!-- FEATURED PRODUCT
    ================================================== -->
    <section class="pt-5 pb-9 py-md-11">
        <div class="container">
            <div class="row align-items-center mb-5" data-aos="fade-up">
                <div class="col-md mb-2 mb-md-0">
                    <h1 class="mb-1">Featured Skills</h1>
                </div>
            </div>

            <div class="mx-n4"
                 data-flickity='{"pageDots": true, "prevNextButtons": false, "cellAlign": "left", "wrapAround": true, "imagesLoaded": true}'>
                @foreach($skills as $skill)
                    <x-client.featured-skill-card :skill="$skill"/>
                @endforeach
            </div>
        </div>
    </section>

    <!-- CATEGORIES
    ================================================== -->
    <section class="py-5 py-md-11 bg-white">
        <div class="container">
            <div class="row align-items-end mb-md-7 mb-4" data-aos="fade-up">
                <div class="col-md mb-4 mb-md-0">
                    <h1 class="mb-1">Trending Categories</h1>
                </div>
                <div class="col-md-auto">
                    <a href="#" class="d-flex align-items-center fw-medium">
                        Browse All
                        <div class="ms-2 d-flex">
                            <!-- Icon -->
                            <svg width="10" height="10" viewBox="0 0 10 10" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M7.7779 4.6098L3.32777 0.159755C3.22485 0.0567475 3.08745 0 2.94095 0C2.79445 0 2.65705 0.0567475 2.55412 0.159755L2.2264 0.487394C2.01315 0.700889 2.01315 1.04788 2.2264 1.26105L5.96328 4.99793L2.22225 8.73895C2.11933 8.84196 2.0625 8.97928 2.0625 9.1257C2.0625 9.27228 2.11933 9.4096 2.22225 9.51269L2.54998 9.84025C2.65298 9.94325 2.7903 10 2.9368 10C3.0833 10 3.2207 9.94325 3.32363 9.84025L7.7779 5.38614C7.88107 5.2828 7.93774 5.14484 7.93741 4.99817C7.93774 4.85094 7.88107 4.71305 7.7779 4.6098Z"
                                    fill="currentColor"/>
                            </svg>

                        </div>
                    </a>
                </div>
            </div>

            <div class="row row-cols-2 row-cols-lg-3 row-cols-xl-4">
                @foreach($categories as $category)
                    <x-client.category-card :category="$category"/>
                @endforeach
            </div>
        </div>
    </section>

    <!-- EVENTS
    ================================================== -->
    <section class="bg-white py-5 pt-md-11 pb-md-10">
        <div class="container">
            <div class="row align-items-end mb-4 mb-md-7">
                <div class="col-md mb-4 mb-md-0">
                    <h1 class="mb-1">Upcoming Timetables</h1>
                    <p class="font-size-lg mb-0 text-capitalize">Don't miss this amazing lectures.</p>
                </div>
                <div class="col-md-auto">
                    <div class="ms-2 d-flex">
                        <!-- Icon -->
                        <svg width="10" height="10" viewBox="0 0 10 10" fill="none"
                             xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M7.7779 4.6098L3.32777 0.159755C3.22485 0.0567475 3.08745 0 2.94095 0C2.79445 0 2.65705 0.0567475 2.55412 0.159755L2.2264 0.487394C2.01315 0.700889 2.01315 1.04788 2.2264 1.26105L5.96328 4.99793L2.22225 8.73895C2.11933 8.84196 2.0625 8.97928 2.0625 9.1257C2.0625 9.27228 2.11933 9.4096 2.22225 9.51269L2.54998 9.84025C2.65298 9.94325 2.7903 10 2.9368 10C3.0833 10 3.2207 9.94325 3.32363 9.84025L7.7779 5.38614C7.88107 5.2828 7.93774 5.14484 7.93741 4.99817C7.93774 4.85094 7.88107 4.71305 7.7779 4.6098Z"
                                fill="currentColor"/>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="row row-cols-lg-2">
                @foreach($upcomingTimetables as $upcomingTimetable)
                    <div class="col-lg mb-5 mb-md-6">

                        <div class="card border shadow p-2 lift">
                            <div class="row gx-0">
                                <!-- Image -->
                                <a href="{{ route('timetableDetails', $upcomingTimetable) }}"
                                   class="col-auto d-block mw-md-152" style="max-width: 120px;">
                                    <img class="img-fluid rounded shadow-light-lg h-100 o-f-c"
                                         src="{{ asset('/media/' . $upcomingTimetable->skill?->image_path)}}"
                                         alt="{{ $upcomingTimetable->skill?->title }}">
                                </a>

                                <!-- Body -->
                                <div class="col">
                                    <div class="card-body py-0 px-md-5 px-3">
                                        <div class="badge badge-lg badge-orange badge-pill mb-3 mt-1 px-5 py-2">
                                            <span
                                                class="text-white font-size-sm fw-normal">{{ $upcomingTimetable->from }}</span>
                                        </div>

                                        <a href="{{ route('timetableDetails', $upcomingTimetable) }}"
                                           class="d-block mb-2"><h5
                                                class="line-clamp-2 h-xl-52">{{ $upcomingTimetable->title }}</h5>
                                        </a>
                                        <h6><span class="badge badge-black ">{{ $upcomingTimetable->skill?->category->name }}</span></h6>
                                        <ul class="nav mx-n3 d-block d-md-flex">
                                            <li class="nav-item px-3 mb-3 mb-md-0">
                                                <div class="d-flex align-items-center">
                                                    <div class="me-2 d-flex text-secondary icon-uxs">
                                                        <!-- Icon -->
                                                        <svg width="16" height="16" viewBox="0 0 16 16"
                                                             xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M14.3164 4.20996C13.985 4.37028 13.8464 4.76904 14.0067 5.10026C14.4447 6.00505 14.6667 6.98031 14.6667 8C14.6667 11.6759 11.6759 14.6667 8 14.6667C4.32406 14.6667 1.33333 11.6759 1.33333 8C1.33333 4.32406 4.32406 1.33333 8 1.33333C9.52328 1.33333 10.9543 1.83073 12.1387 2.77165C12.4259 3.00098 12.846 2.95296 13.0754 2.66471C13.3047 2.37663 13.2567 1.95703 12.9683 1.72803C11.5661 0.613607 9.8016 0 8 0C3.58903 0 0 3.58903 0 8C0 12.411 3.58903 16 8 16C12.411 16 16 12.411 16 8C16 6.77767 15.7331 5.60628 15.2067 4.51969C15.0467 4.18766 14.6466 4.04932 14.3164 4.20996Z"
                                                                fill="currentColor"/>
                                                            <path
                                                                d="M7.99967 2.66663C7.63167 2.66663 7.33301 2.96529 7.33301 3.33329V7.99996C7.33301 8.36796 7.63167 8.66663 7.99967 8.66663H11.333C11.701 8.66663 11.9997 8.36796 11.9997 7.99996C11.9997 7.63196 11.701 7.33329 11.333 7.33329H8.66634V3.33329C8.66634 2.96529 8.36768 2.66663 7.99967 2.66663Z"
                                                                fill="currentColor"/>
                                                        </svg>

                                                    </div>
                                                    <div class="font-size-sm">{{ $upcomingTimetable->start }}
                                                        - {{ $upcomingTimetable->end }}</div>
                                                </div>
                                            </li>
                                            <li class="nav-item px-3 mb-3 mb-md-0">
                                                <div class="d-flex align-items-center">
                                                    <div
                                                        class="font-size-sm">{{ $upcomingTimetable->representablePrice }}</div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- INSTRUCTORS
    ================================================== -->
    {{--    <section class="py-5 py-md-11">--}}
    {{--        <div class="container">--}}
    {{--            <div class="row align-items-end mb-3 mb-md-5" data-aos="fade-up">--}}
    {{--                <div class="col-md mb-4 mb-md-0">--}}
    {{--                    <h1 class="mb-1">Top Rating Instructors</h1>--}}
    {{--                    <p class="font-size-lg mb-0 text-capitalize">Discover your perfect program in our courses.</p>--}}
    {{--                </div>--}}
    {{--                <div class="col-md-auto">--}}
    {{--                    <a href="instructors-list-v1.html" class="d-flex align-items-center fw-medium">--}}
    {{--                        Browse All--}}
    {{--                        <div class="ms-2 d-flex">--}}
    {{--                            <!-- Icon -->--}}
    {{--                            <svg width="10" height="10" viewBox="0 0 10 10" fill="none"--}}
    {{--                                 xmlns="http://www.w3.org/2000/svg">--}}
    {{--                                <path--}}
    {{--                                    d="M7.7779 4.6098L3.32777 0.159755C3.22485 0.0567475 3.08745 0 2.94095 0C2.79445 0 2.65705 0.0567475 2.55412 0.159755L2.2264 0.487394C2.01315 0.700889 2.01315 1.04788 2.2264 1.26105L5.96328 4.99793L2.22225 8.73895C2.11933 8.84196 2.0625 8.97928 2.0625 9.1257C2.0625 9.27228 2.11933 9.4096 2.22225 9.51269L2.54998 9.84025C2.65298 9.94325 2.7903 10 2.9368 10C3.0833 10 3.2207 9.94325 3.32363 9.84025L7.7779 5.38614C7.88107 5.2828 7.93774 5.14484 7.93741 4.99817C7.93774 4.85094 7.88107 4.71305 7.7779 4.6098Z"--}}
    {{--                                    fill="currentColor"/>--}}
    {{--                            </svg>--}}

    {{--                        </div>--}}
    {{--                    </a>--}}
    {{--                </div>--}}
    {{--            </div>--}}

    {{--            <div class="mx-n3 mx-md-n4"--}}
    {{--                 data-flickity='{"pageDots": false,"cellAlign": "left", "wrapAround": true, "imagesLoaded": true}'>--}}
    {{--                <div class="col-6 col-md-4 col-lg-3 text-center py-5 text-md-left px-3 px-md-4" data-aos="fade-up"--}}
    {{--                     data-aos-delay="50">--}}
    {{--                    <div class="card border shadow p-2 lift">--}}
    {{--                        <!-- Image -->--}}
    {{--                        <div class="card-zoom position-relative" style="max-width: 250px;">--}}
    {{--                            <div class="card-float card-hover right-0 left-0 bottom-0 mb-4">--}}
    {{--                                <ul class="nav mx-n4 justify-content-center">--}}
    {{--                                    <li class="nav-item px-4">--}}
    {{--                                        <a href="#" class="d-block text-white">--}}
    {{--                                            <i class="fab fa-facebook-f"></i>--}}
    {{--                                        </a>--}}
    {{--                                    </li>--}}
    {{--                                    <li class="nav-item px-4">--}}
    {{--                                        <a href="#" class="d-block text-white">--}}
    {{--                                            <i class="fab fa-twitter"></i>--}}
    {{--                                        </a>--}}
    {{--                                    </li>--}}
    {{--                                    <li class="nav-item px-4">--}}
    {{--                                        <a href="#" class="d-block text-white">--}}
    {{--                                            <i class="fab fa-instagram"></i>--}}
    {{--                                        </a>--}}
    {{--                                    </li>--}}
    {{--                                    <li class="nav-item px-4">--}}
    {{--                                        <a href="#" class="d-block text-white">--}}
    {{--                                            <i class="fab fa-linkedin-in"></i>--}}
    {{--                                        </a>--}}
    {{--                                    </li>--}}
    {{--                                </ul>--}}
    {{--                            </div>--}}

    {{--                            <a href="instructors-single.html"--}}
    {{--                               class="card-img sk-thumbnail img-ratio-4 card-hover-overlay d-block"><img--}}
    {{--                                    class="rounded shadow-light-lg img-fluid"--}}
    {{--                                    src="{{ asset('frontend/img/instructors/instructor-1.jpg')}}" alt="..."></a>--}}
    {{--                        </div>--}}

    {{--                        <!-- Footer -->--}}
    {{--                        <div class="card-footer px-3 pt-4 pb-1">--}}
    {{--                            <a href="instructors-single.html" class="d-block"><h5 class="mb-0">Jack Wilson</h5></a>--}}
    {{--                            <span class="font-size-d-sm">Developer</span>--}}
    {{--                        </div>--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--                <div class="col-6 col-md-4 col-lg-3 text-center py-5 text-md-left px-3 px-md-4" data-aos="fade-up"--}}
    {{--                     data-aos-delay="100">--}}
    {{--                    <div class="card border shadow p-2 lift">--}}
    {{--                        <!-- Image -->--}}
    {{--                        <div class="card-zoom position-relative" style="max-width: 250px;">--}}
    {{--                            <div class="card-float card-hover right-0 left-0 bottom-0 mb-4">--}}
    {{--                                <ul class="nav mx-n4 justify-content-center">--}}
    {{--                                    <li class="nav-item px-4">--}}
    {{--                                        <a href="#" class="d-block text-white">--}}
    {{--                                            <i class="fab fa-facebook-f"></i>--}}
    {{--                                        </a>--}}
    {{--                                    </li>--}}
    {{--                                    <li class="nav-item px-4">--}}
    {{--                                        <a href="#" class="d-block text-white">--}}
    {{--                                            <i class="fab fa-twitter"></i>--}}
    {{--                                        </a>--}}
    {{--                                    </li>--}}
    {{--                                    <li class="nav-item px-4">--}}
    {{--                                        <a href="#" class="d-block text-white">--}}
    {{--                                            <i class="fab fa-instagram"></i>--}}
    {{--                                        </a>--}}
    {{--                                    </li>--}}
    {{--                                    <li class="nav-item px-4">--}}
    {{--                                        <a href="#" class="d-block text-white">--}}
    {{--                                            <i class="fab fa-linkedin-in"></i>--}}
    {{--                                        </a>--}}
    {{--                                    </li>--}}
    {{--                                </ul>--}}
    {{--                            </div>--}}

    {{--                            <a href="instructors-single.html"--}}
    {{--                               class="card-img sk-thumbnail img-ratio-4 card-hover-overlay d-block"><img--}}
    {{--                                    class="rounded shadow-light-lg img-fluid"--}}
    {{--                                    src="{{ asset('frontend/img/instructors/instructor-2.jpg')}}" alt="..."></a>--}}
    {{--                        </div>--}}

    {{--                        <!-- Footer -->--}}
    {{--                        <div class="card-footer px-3 pt-4 pb-1">--}}
    {{--                            <a href="instructors-single.html" class="d-block"><h5 class="mb-0">Anna Richard</h5></a>--}}
    {{--                            <span class="font-size-d-sm">Travel Bloger</span>--}}
    {{--                        </div>--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--                <div class="col-6 col-md-4 col-lg-3 text-center py-5 text-md-left px-3 px-md-4" data-aos="fade-up"--}}
    {{--                     data-aos-delay="150">--}}
    {{--                    <div class="card border shadow p-2 lift">--}}
    {{--                        <!-- Image -->--}}
    {{--                        <div class="card-zoom position-relative" style="max-width: 250px;">--}}
    {{--                            <div class="card-float card-hover right-0 left-0 bottom-0 mb-4">--}}
    {{--                                <ul class="nav mx-n4 justify-content-center">--}}
    {{--                                    <li class="nav-item px-4">--}}
    {{--                                        <a href="#" class="d-block text-white">--}}
    {{--                                            <i class="fab fa-facebook-f"></i>--}}
    {{--                                        </a>--}}
    {{--                                    </li>--}}
    {{--                                    <li class="nav-item px-4">--}}
    {{--                                        <a href="#" class="d-block text-white">--}}
    {{--                                            <i class="fab fa-twitter"></i>--}}
    {{--                                        </a>--}}
    {{--                                    </li>--}}
    {{--                                    <li class="nav-item px-4">--}}
    {{--                                        <a href="#" class="d-block text-white">--}}
    {{--                                            <i class="fab fa-instagram"></i>--}}
    {{--                                        </a>--}}
    {{--                                    </li>--}}
    {{--                                    <li class="nav-item px-4">--}}
    {{--                                        <a href="#" class="d-block text-white">--}}
    {{--                                            <i class="fab fa-linkedin-in"></i>--}}
    {{--                                        </a>--}}
    {{--                                    </li>--}}
    {{--                                </ul>--}}
    {{--                            </div>--}}

    {{--                            <a href="instructors-single.html"--}}
    {{--                               class="card-img sk-thumbnail img-ratio-4 card-hover-overlay d-block"><img--}}
    {{--                                    class="rounded shadow-light-lg img-fluid"--}}
    {{--                                    src="{{ asset('frontend/img/instructors/instructor-3.jpg')}}" alt="..."></a>--}}
    {{--                        </div>--}}

    {{--                        <!-- Footer -->--}}
    {{--                        <div class="card-footer px-3 pt-4 pb-1">--}}
    {{--                            <a href="instructors-single.html" class="d-block"><h5 class="mb-0">Kathelen Monero</h5></a>--}}
    {{--                            <span class="font-size-d-sm">Designer</span>--}}
    {{--                        </div>--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--                <div class="col-6 col-md-4 col-lg-3 text-center py-5 text-md-left px-3 px-md-4" data-aos="fade-up"--}}
    {{--                     data-aos-delay="200">--}}
    {{--                    <div class="card border shadow p-2 lift">--}}
    {{--                        <!-- Image -->--}}
    {{--                        <div class="card-zoom position-relative" style="max-width: 250px;">--}}
    {{--                            <div class="card-float card-hover right-0 left-0 bottom-0 mb-4">--}}
    {{--                                <ul class="nav mx-n4 justify-content-center">--}}
    {{--                                    <li class="nav-item px-4">--}}
    {{--                                        <a href="#" class="d-block text-white">--}}
    {{--                                            <i class="fab fa-facebook-f"></i>--}}
    {{--                                        </a>--}}
    {{--                                    </li>--}}
    {{--                                    <li class="nav-item px-4">--}}
    {{--                                        <a href="#" class="d-block text-white">--}}
    {{--                                            <i class="fab fa-twitter"></i>--}}
    {{--                                        </a>--}}
    {{--                                    </li>--}}
    {{--                                    <li class="nav-item px-4">--}}
    {{--                                        <a href="#" class="d-block text-white">--}}
    {{--                                            <i class="fab fa-instagram"></i>--}}
    {{--                                        </a>--}}
    {{--                                    </li>--}}
    {{--                                    <li class="nav-item px-4">--}}
    {{--                                        <a href="#" class="d-block text-white">--}}
    {{--                                            <i class="fab fa-linkedin-in"></i>--}}
    {{--                                        </a>--}}
    {{--                                    </li>--}}
    {{--                                </ul>--}}
    {{--                            </div>--}}

    {{--                            <a href="instructors-single.html"--}}
    {{--                               class="card-img sk-thumbnail img-ratio-4 card-hover-overlay d-block"><img--}}
    {{--                                    class="rounded shadow-light-lg img-fluid"--}}
    {{--                                    src="{{ asset('frontend/img/instructors/instructor-4.jpg')}}" alt="..."></a>--}}
    {{--                        </div>--}}

    {{--                        <!-- Footer -->--}}
    {{--                        <div class="card-footer px-3 pt-4 pb-1">--}}
    {{--                            <a href="instructors-single.html" class="d-block"><h5 class="mb-0">Kristen Pala</h5></a>--}}
    {{--                            <span class="font-size-d-sm">User Experience Design</span>--}}
    {{--                        </div>--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--                <div class="col-6 col-md-4 col-lg-3 text-center py-5 text-md-left px-3 px-md-4" data-aos="fade-up"--}}
    {{--                     data-aos-delay="250">--}}
    {{--                    <div class="card border shadow p-2 lift">--}}
    {{--                        <!-- Image -->--}}
    {{--                        <div class="card-zoom position-relative" style="max-width: 250px;">--}}
    {{--                            <div class="card-float card-hover right-0 left-0 bottom-0 mb-4">--}}
    {{--                                <ul class="nav mx-n4 justify-content-center">--}}
    {{--                                    <li class="nav-item px-4">--}}
    {{--                                        <a href="#" class="d-block text-white">--}}
    {{--                                            <i class="fab fa-facebook-f"></i>--}}
    {{--                                        </a>--}}
    {{--                                    </li>--}}
    {{--                                    <li class="nav-item px-4">--}}
    {{--                                        <a href="#" class="d-block text-white">--}}
    {{--                                            <i class="fab fa-twitter"></i>--}}
    {{--                                        </a>--}}
    {{--                                    </li>--}}
    {{--                                    <li class="nav-item px-4">--}}
    {{--                                        <a href="#" class="d-block text-white">--}}
    {{--                                            <i class="fab fa-instagram"></i>--}}
    {{--                                        </a>--}}
    {{--                                    </li>--}}
    {{--                                    <li class="nav-item px-4">--}}
    {{--                                        <a href="#" class="d-block text-white">--}}
    {{--                                            <i class="fab fa-linkedin-in"></i>--}}
    {{--                                        </a>--}}
    {{--                                    </li>--}}
    {{--                                </ul>--}}
    {{--                            </div>--}}

    {{--                            <a href="instructors-single.html"--}}
    {{--                               class="card-img sk-thumbnail img-ratio-4 card-hover-overlay d-block"><img--}}
    {{--                                    class="rounded shadow-light-lg img-fluid"--}}
    {{--                                    src="{{ asset('frontend/img/instructors/instructor-2.jpg')}}" alt="..."></a>--}}
    {{--                        </div>--}}

    {{--                        <!-- Footer -->--}}
    {{--                        <div class="card-footer px-3 pt-4 pb-1">--}}
    {{--                            <a href="instructors-single.html" class="d-block"><h5 class="mb-0">Anna Richard</h5></a>--}}
    {{--                            <span class="font-size-d-sm">Travel Bloger</span>--}}
    {{--                        </div>--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--    </section>--}}

</x-client.master-layout>
