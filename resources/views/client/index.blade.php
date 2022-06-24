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
                        Learn From <span class="text-orange fw-bold">Anywhere</span>
                    </h1>

                    <!-- Text -->
                    <p class="lead pe-md-8 text-capitalize" data-aos="fade-up" data-aos-duration="200">
                        Technology is bringing a massive wave of evolution on learning things in different ways.
                    </p>

                    <!-- Buttons -->
                    <a href="course-list-v1.html"
                       class="btn btn-wide btn-slide slide-primary shadow mb-4 mb-md-0 me-md-5" data-aos-duration="200"
                       data-aos="fade-up">GET STARTED</a>
                    <a href="course-list-v1.html" class="btn btn-primary btn-wide lift d-none d-lg-inline-block"
                       data-aos-duration="200" data-aos="fade-up">VIEW COURSES</a>

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
                    <h1 class="mb-1">Featured Courses</h1>
                    <p class="font-size-lg text-capitalize">Discover your perfect program in our courses.</p>
                </div>
                <div class="col-md-auto">
                    <select class="form-select form-select-sm text-primary fw-medium shadow" data-choices>
                        <option>All Subjects</option>
                        <option>Another option</option>
                        <option>Something else here</option>
                    </select>
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
                    <p class="font-size-lg mb-0 text-capitalize">Cum doctus civibus efficiantur in imperdiet
                        deterruisset.</p>
                </div>
                <div class="col-md-auto">
                    <a href="course-list-v3.html" class="d-flex align-items-center fw-medium">
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
                <div class="col mb-md-6 mb-4 px-2 px-md-4" data-aos="fade-up" data-aos-delay="50">
                    <!-- Card -->
                    <a href="course-list-v3.html"
                       class="card icon-category border shadow-dark p-md-5 p-3 text-center lift">
                        <!-- Image -->
                        <div class="position-relative text-light">
                            <div class="position-absolute bottom-0 right-0 left-0 icon-h-p">
                                <i class="fas fa-bezier-curve"></i>
                            </div>
                            <!-- Icon BG -->
                            <svg width="116" height="82" viewBox="0 0 116 82" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M11.9238 65.8391C11.9238 65.8391 20.4749 72.4177 35.0465 70.036C49.6182 67.6542 75.9897 78.4406 75.9897 78.4406C75.9897 78.4406 90.002 85.8843 104.047 79.2427C118.093 72.6012 115.872 58.8253 115.872 58.8253C115.743 56.8104 115.606 46.9466 97.5579 22.0066C91.0438 13.0024 84.1597 6.97958 75.9458 3.74641C58.8245 -2.99096 37.7881 -0.447684 22.9067 9.81852C15.5647 14.8832 7.65514 22.0695 3.0465 31.5007C-7.27017 52.6135 11.9238 65.8391 11.9238 65.8391Z"
                                    fill="currentColor"/>
                            </svg>

                        </div>

                        <!-- Footer -->
                        <div class="card-footer px-0 pb-0 pt-6">
                            <h5 class="mb-0 line-clamp-1">Design</h5>
                            <p class="mb-0 line-clamp-1">Over 960 Courses</p>
                        </div>
                    </a>
                </div>

                <div class="col mb-md-6 mb-4 px-2 px-md-4" data-aos="fade-up" data-aos-delay="100">
                    <!-- Card -->
                    <a href="course-list-v3.html"
                       class="card icon-category border shadow-dark p-md-5 p-3 text-center lift">
                        <!-- Image -->
                        <div class="position-relative text-light">
                            <div class="position-absolute bottom-0 right-0 left-0 icon-h-p">
                                <i class="fas fa-briefcase"></i>
                            </div>
                            <!-- Icon BG -->
                            <svg width="116" height="82" viewBox="0 0 116 82" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M11.9238 65.8391C11.9238 65.8391 20.4749 72.4177 35.0465 70.036C49.6182 67.6542 75.9897 78.4406 75.9897 78.4406C75.9897 78.4406 90.002 85.8843 104.047 79.2427C118.093 72.6012 115.872 58.8253 115.872 58.8253C115.743 56.8104 115.606 46.9466 97.5579 22.0066C91.0438 13.0024 84.1597 6.97958 75.9458 3.74641C58.8245 -2.99096 37.7881 -0.447684 22.9067 9.81852C15.5647 14.8832 7.65514 22.0695 3.0465 31.5007C-7.27017 52.6135 11.9238 65.8391 11.9238 65.8391Z"
                                    fill="currentColor"/>
                            </svg>

                        </div>

                        <!-- Footer -->
                        <div class="card-footer px-0 pb-0 pt-6">
                            <h5 class="mb-0 line-clamp-1">Business</h5>
                            <p class="mb-0 line-clamp-1">Over 43 Courses</p>
                        </div>
                    </a>
                </div>

                <div class="col mb-md-6 mb-4 px-2 px-md-4" data-aos="fade-up" data-aos-delay="150">
                    <!-- Card -->
                    <a href="course-list-v3.html"
                       class="card icon-category border shadow-dark p-md-5 p-3 text-center lift">
                        <!-- Image -->
                        <div class="position-relative text-light">
                            <div class="position-absolute bottom-0 right-0 left-0 icon-h-p">
                                <i class="fas fa-laptop-code"></i>
                            </div>
                            <!-- Icon BG -->
                            <svg width="116" height="82" viewBox="0 0 116 82" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M11.9238 65.8391C11.9238 65.8391 20.4749 72.4177 35.0465 70.036C49.6182 67.6542 75.9897 78.4406 75.9897 78.4406C75.9897 78.4406 90.002 85.8843 104.047 79.2427C118.093 72.6012 115.872 58.8253 115.872 58.8253C115.743 56.8104 115.606 46.9466 97.5579 22.0066C91.0438 13.0024 84.1597 6.97958 75.9458 3.74641C58.8245 -2.99096 37.7881 -0.447684 22.9067 9.81852C15.5647 14.8832 7.65514 22.0695 3.0465 31.5007C-7.27017 52.6135 11.9238 65.8391 11.9238 65.8391Z"
                                    fill="currentColor"/>
                            </svg>

                        </div>

                        <!-- Footer -->
                        <div class="card-footer px-0 pb-0 pt-6">
                            <h5 class="mb-0 line-clamp-1">Software Development</h5>
                            <p class="mb-0 line-clamp-1">Over 1209 Courses</p>
                        </div>
                    </a>
                </div>

                <div class="col mb-md-6 mb-4 px-2 px-md-4" data-aos="fade-up" data-aos-delay="200">
                    <!-- Card -->
                    <a href="course-list-v3.html"
                       class="card icon-category border shadow-dark p-md-5 p-3 text-center lift">
                        <!-- Image -->
                        <div class="position-relative text-light">
                            <div class="position-absolute bottom-0 right-0 left-0 icon-h-p">
                                <i class="far fa-file-alt"></i>
                            </div>
                            <!-- Icon BG -->
                            <svg width="116" height="82" viewBox="0 0 116 82" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M11.9238 65.8391C11.9238 65.8391 20.4749 72.4177 35.0465 70.036C49.6182 67.6542 75.9897 78.4406 75.9897 78.4406C75.9897 78.4406 90.002 85.8843 104.047 79.2427C118.093 72.6012 115.872 58.8253 115.872 58.8253C115.743 56.8104 115.606 46.9466 97.5579 22.0066C91.0438 13.0024 84.1597 6.97958 75.9458 3.74641C58.8245 -2.99096 37.7881 -0.447684 22.9067 9.81852C15.5647 14.8832 7.65514 22.0695 3.0465 31.5007C-7.27017 52.6135 11.9238 65.8391 11.9238 65.8391Z"
                                    fill="currentColor"/>
                            </svg>

                        </div>

                        <!-- Footer -->
                        <div class="card-footer px-0 pb-0 pt-6">
                            <h5 class="mb-0 line-clamp-1">Personal Development</h5>
                            <p class="mb-0 line-clamp-1">Over 921 Courses</p>
                        </div>
                    </a>
                </div>

                <div class="col mb-md-6 mb-4 px-2 px-md-4" data-aos="fade-up" data-aos-delay="250">
                    <!-- Card -->
                    <a href="course-list-v3.html"
                       class="card icon-category border shadow-dark p-md-5 p-3 text-center lift">
                        <!-- Image -->
                        <div class="position-relative text-light">
                            <div class="position-absolute bottom-0 right-0 left-0 icon-h-p">
                                <i class="fas fa-camera"></i>
                            </div>
                            <!-- Icon BG -->
                            <svg width="116" height="82" viewBox="0 0 116 82" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M11.9238 65.8391C11.9238 65.8391 20.4749 72.4177 35.0465 70.036C49.6182 67.6542 75.9897 78.4406 75.9897 78.4406C75.9897 78.4406 90.002 85.8843 104.047 79.2427C118.093 72.6012 115.872 58.8253 115.872 58.8253C115.743 56.8104 115.606 46.9466 97.5579 22.0066C91.0438 13.0024 84.1597 6.97958 75.9458 3.74641C58.8245 -2.99096 37.7881 -0.447684 22.9067 9.81852C15.5647 14.8832 7.65514 22.0695 3.0465 31.5007C-7.27017 52.6135 11.9238 65.8391 11.9238 65.8391Z"
                                    fill="currentColor"/>
                            </svg>

                        </div>

                        <!-- Footer -->
                        <div class="card-footer px-0 pb-0 pt-6">
                            <h5 class="mb-0 line-clamp-1">Photography</h5>
                            <p class="mb-0 line-clamp-1">Over 693 Courses</p>
                        </div>
                    </a>
                </div>

                <div class="col mb-md-6 mb-4 px-2 px-md-4" data-aos="fade-up" data-aos-delay="300">
                    <!-- Card -->
                    <a href="course-list-v3.html"
                       class="card icon-category border shadow-dark p-md-5 p-3 text-center lift">
                        <!-- Image -->
                        <div class="position-relative text-light">
                            <div class="position-absolute bottom-0 right-0 left-0 icon-h-p">
                                <i class="fas fa-music"></i>
                            </div>
                            <!-- Icon BG -->
                            <svg width="116" height="82" viewBox="0 0 116 82" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M11.9238 65.8391C11.9238 65.8391 20.4749 72.4177 35.0465 70.036C49.6182 67.6542 75.9897 78.4406 75.9897 78.4406C75.9897 78.4406 90.002 85.8843 104.047 79.2427C118.093 72.6012 115.872 58.8253 115.872 58.8253C115.743 56.8104 115.606 46.9466 97.5579 22.0066C91.0438 13.0024 84.1597 6.97958 75.9458 3.74641C58.8245 -2.99096 37.7881 -0.447684 22.9067 9.81852C15.5647 14.8832 7.65514 22.0695 3.0465 31.5007C-7.27017 52.6135 11.9238 65.8391 11.9238 65.8391Z"
                                    fill="currentColor"/>
                            </svg>

                        </div>

                        <!-- Footer -->
                        <div class="card-footer px-0 pb-0 pt-6">
                            <h5 class="mb-0 line-clamp-1">Audio + Music</h5>
                            <p class="mb-0 line-clamp-1">Over 53 Courses</p>
                        </div>
                    </a>
                </div>

                <div class="col mb-md-6 mb-4 px-2 px-md-4" data-aos="fade-up" data-aos-delay="350">
                    <!-- Card -->
                    <a href="course-list-v3.html"
                       class="card icon-category border shadow-dark p-md-5 p-3 text-center lift">
                        <!-- Image -->
                        <div class="position-relative text-light">
                            <div class="position-absolute bottom-0 right-0 left-0 icon-h-p">
                                <i class="fas fa-bullhorn"></i>
                            </div>
                            <!-- Icon BG -->
                            <svg width="116" height="82" viewBox="0 0 116 82" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M11.9238 65.8391C11.9238 65.8391 20.4749 72.4177 35.0465 70.036C49.6182 67.6542 75.9897 78.4406 75.9897 78.4406C75.9897 78.4406 90.002 85.8843 104.047 79.2427C118.093 72.6012 115.872 58.8253 115.872 58.8253C115.743 56.8104 115.606 46.9466 97.5579 22.0066C91.0438 13.0024 84.1597 6.97958 75.9458 3.74641C58.8245 -2.99096 37.7881 -0.447684 22.9067 9.81852C15.5647 14.8832 7.65514 22.0695 3.0465 31.5007C-7.27017 52.6135 11.9238 65.8391 11.9238 65.8391Z"
                                    fill="currentColor"/>
                            </svg>

                        </div>

                        <!-- Footer -->
                        <div class="card-footer px-0 pb-0 pt-6">
                            <h5 class="mb-0 line-clamp-1">Marketing</h5>
                            <p class="mb-0 line-clamp-1">Over 12 Courses</p>
                        </div>
                    </a>
                </div>

                <div class="col mb-md-6 mb-4 px-2 px-md-4" data-aos="fade-up" data-aos-delay="400">
                    <!-- Card -->
                    <a href="course-list-v3.html"
                       class="card icon-category border shadow-dark p-md-5 p-3 text-center lift">
                        <!-- Image -->
                        <div class="position-relative text-light">
                            <div class="position-absolute bottom-0 right-0 left-0 icon-h-p">
                                <i class="fas fa-wallet"></i>
                            </div>
                            <!-- Icon BG -->
                            <svg width="116" height="82" viewBox="0 0 116 82" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M11.9238 65.8391C11.9238 65.8391 20.4749 72.4177 35.0465 70.036C49.6182 67.6542 75.9897 78.4406 75.9897 78.4406C75.9897 78.4406 90.002 85.8843 104.047 79.2427C118.093 72.6012 115.872 58.8253 115.872 58.8253C115.743 56.8104 115.606 46.9466 97.5579 22.0066C91.0438 13.0024 84.1597 6.97958 75.9458 3.74641C58.8245 -2.99096 37.7881 -0.447684 22.9067 9.81852C15.5647 14.8832 7.65514 22.0695 3.0465 31.5007C-7.27017 52.6135 11.9238 65.8391 11.9238 65.8391Z"
                                    fill="currentColor"/>
                            </svg>

                        </div>

                        <!-- Footer -->
                        <div class="card-footer px-0 pb-0 pt-6">
                            <h5 class="mb-0 line-clamp-1">Finance & Accounting</h5>
                            <p class="mb-0 line-clamp-1">Over 322 Courses</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>


    <!-- EVENTS
    ================================================== -->
    <section class="bg-white py-5 pt-md-11 pb-md-10">
        <div class="container">
            <div class="row align-items-end mb-4 mb-md-7">
                <div class="col-md mb-4 mb-md-0">
                    <h1 class="mb-1">Upcoming Events</h1>
                    <p class="font-size-lg mb-0 text-capitalize">Discover your perfect program in our courses.</p>
                </div>
                <div class="col-md-auto">
                    <a href="event-list.html" class="d-flex align-items-center fw-medium">
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

            <div class="row row-cols-lg-2">
                <div class="col-lg mb-5 mb-md-6">
                    <!-- Card -->
                    <div class="card border shadow p-2 lift">
                        <div class="row gx-0">
                            <!-- Image -->
                            <a href="event-single.html" class="col-auto d-block mw-md-152" style="max-width: 120px;">
                                <img class="img-fluid rounded shadow-light-lg h-100 o-f-c"
                                     src="{{ asset('frontend/img/events/event-6.jpg')}}" alt="...">
                            </a>

                            <!-- Body -->
                            <div class="col">
                                <div class="card-body py-0 px-md-5 px-3">
                                    <div class="badge badge-lg badge-orange badge-pill mb-3 mt-1 px-5 py-2">
                                        <span class="text-white font-size-sm fw-normal">06 Aprıl</span>
                                    </div>

                                    <a href="event-single.html" class="d-block mb-2"><h5
                                            class="line-clamp-2 h-xl-52 mb-1">Kingston College undergraduate Open Events
                                            2019-20</h5></a>

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
                                                <div class="font-size-sm">8:00 am - 5:00 pm</div>
                                            </div>
                                        </li>
                                        <li class="nav-item px-3 mb-3 mb-md-0">
                                            <div class="d-flex align-items-center">
                                                <div class="me-2 d-flex text-secondary icon-uxs">
                                                    <!-- Icon -->
                                                    <svg width="18" height="18" viewBox="0 0 18 18"
                                                         xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M14.9748 3.12964C13.6007 1.14086 11.4229 0 9.0002 0C6.57754 0 4.39972 1.14086 3.02557 3.12964C1.65816 5.10838 1.34243 7.61351 2.17929 9.82677C2.40313 10.4312 2.75894 11.0184 3.23433 11.5687L8.52105 17.7784C8.64062 17.919 8.8158 18 9.0002 18C9.18459 18 9.35978 17.919 9.47934 17.7784L14.7646 11.5703C15.2421 11.0169 15.5974 10.4303 15.8194 9.83078C16.658 7.61351 16.3422 5.10838 14.9748 3.12964ZM14.6408 9.38999C14.4697 9.85257 14.1902 10.3099 13.8107 10.7498C13.8096 10.7509 13.8086 10.7519 13.8077 10.7532L9.0002 16.3999L4.1897 10.7497C3.8104 10.3101 3.53094 9.85282 3.35808 9.38581C2.66599 7.55539 2.92864 5.48413 4.06088 3.84546C5.19668 2.20155 6.9971 1.25873 9.0002 1.25873C11.0033 1.25873 12.8035 2.20152 13.9393 3.84546C15.0718 5.48413 15.3346 7.55539 14.6408 9.38999Z"
                                                            fill="currentColor"/>
                                                        <path
                                                            d="M9.00019 3.73438C7.0569 3.73438 5.47571 5.31535 5.47571 7.25886C5.47571 9.20237 7.05668 10.7833 9.00019 10.7833C10.9437 10.7833 12.5247 9.20237 12.5247 7.25886C12.5247 5.31556 10.9435 3.73438 9.00019 3.73438ZM9.00019 9.52457C7.75088 9.52457 6.73444 8.50814 6.73444 7.25882C6.73444 6.00951 7.75088 4.99307 9.00019 4.99307C10.2495 4.99307 11.2659 6.00951 11.2659 7.25882C11.2659 8.50814 10.2495 9.52457 9.00019 9.52457Z"
                                                            fill="currentColor"/>
                                                    </svg>

                                                </div>
                                                <div class="font-size-sm">London, UK</div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- INSTRUCTORS
    ================================================== -->
    <section class="py-5 py-md-11">
        <div class="container">
            <div class="row align-items-end mb-3 mb-md-5" data-aos="fade-up">
                <div class="col-md mb-4 mb-md-0">
                    <h1 class="mb-1">Top Rating Instructors</h1>
                    <p class="font-size-lg mb-0 text-capitalize">Discover your perfect program in our courses.</p>
                </div>
                <div class="col-md-auto">
                    <a href="instructors-list-v1.html" class="d-flex align-items-center fw-medium">
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

            <div class="mx-n3 mx-md-n4"
                 data-flickity='{"pageDots": false,"cellAlign": "left", "wrapAround": true, "imagesLoaded": true}'>
                <div class="col-6 col-md-4 col-lg-3 text-center py-5 text-md-left px-3 px-md-4" data-aos="fade-up"
                     data-aos-delay="50">
                    <div class="card border shadow p-2 lift">
                        <!-- Image -->
                        <div class="card-zoom position-relative" style="max-width: 250px;">
                            <div class="card-float card-hover right-0 left-0 bottom-0 mb-4">
                                <ul class="nav mx-n4 justify-content-center">
                                    <li class="nav-item px-4">
                                        <a href="#" class="d-block text-white">
                                            <i class="fab fa-facebook-f"></i>
                                        </a>
                                    </li>
                                    <li class="nav-item px-4">
                                        <a href="#" class="d-block text-white">
                                            <i class="fab fa-twitter"></i>
                                        </a>
                                    </li>
                                    <li class="nav-item px-4">
                                        <a href="#" class="d-block text-white">
                                            <i class="fab fa-instagram"></i>
                                        </a>
                                    </li>
                                    <li class="nav-item px-4">
                                        <a href="#" class="d-block text-white">
                                            <i class="fab fa-linkedin-in"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>

                            <a href="instructors-single.html"
                               class="card-img sk-thumbnail img-ratio-4 card-hover-overlay d-block"><img
                                    class="rounded shadow-light-lg img-fluid"
                                    src="{{ asset('frontend/img/instructors/instructor-1.jpg')}}" alt="..."></a>
                        </div>

                        <!-- Footer -->
                        <div class="card-footer px-3 pt-4 pb-1">
                            <a href="instructors-single.html" class="d-block"><h5 class="mb-0">Jack Wilson</h5></a>
                            <span class="font-size-d-sm">Developer</span>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-4 col-lg-3 text-center py-5 text-md-left px-3 px-md-4" data-aos="fade-up"
                     data-aos-delay="100">
                    <div class="card border shadow p-2 lift">
                        <!-- Image -->
                        <div class="card-zoom position-relative" style="max-width: 250px;">
                            <div class="card-float card-hover right-0 left-0 bottom-0 mb-4">
                                <ul class="nav mx-n4 justify-content-center">
                                    <li class="nav-item px-4">
                                        <a href="#" class="d-block text-white">
                                            <i class="fab fa-facebook-f"></i>
                                        </a>
                                    </li>
                                    <li class="nav-item px-4">
                                        <a href="#" class="d-block text-white">
                                            <i class="fab fa-twitter"></i>
                                        </a>
                                    </li>
                                    <li class="nav-item px-4">
                                        <a href="#" class="d-block text-white">
                                            <i class="fab fa-instagram"></i>
                                        </a>
                                    </li>
                                    <li class="nav-item px-4">
                                        <a href="#" class="d-block text-white">
                                            <i class="fab fa-linkedin-in"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>

                            <a href="instructors-single.html"
                               class="card-img sk-thumbnail img-ratio-4 card-hover-overlay d-block"><img
                                    class="rounded shadow-light-lg img-fluid"
                                    src="{{ asset('frontend/img/instructors/instructor-2.jpg')}}" alt="..."></a>
                        </div>

                        <!-- Footer -->
                        <div class="card-footer px-3 pt-4 pb-1">
                            <a href="instructors-single.html" class="d-block"><h5 class="mb-0">Anna Richard</h5></a>
                            <span class="font-size-d-sm">Travel Bloger</span>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-4 col-lg-3 text-center py-5 text-md-left px-3 px-md-4" data-aos="fade-up"
                     data-aos-delay="150">
                    <div class="card border shadow p-2 lift">
                        <!-- Image -->
                        <div class="card-zoom position-relative" style="max-width: 250px;">
                            <div class="card-float card-hover right-0 left-0 bottom-0 mb-4">
                                <ul class="nav mx-n4 justify-content-center">
                                    <li class="nav-item px-4">
                                        <a href="#" class="d-block text-white">
                                            <i class="fab fa-facebook-f"></i>
                                        </a>
                                    </li>
                                    <li class="nav-item px-4">
                                        <a href="#" class="d-block text-white">
                                            <i class="fab fa-twitter"></i>
                                        </a>
                                    </li>
                                    <li class="nav-item px-4">
                                        <a href="#" class="d-block text-white">
                                            <i class="fab fa-instagram"></i>
                                        </a>
                                    </li>
                                    <li class="nav-item px-4">
                                        <a href="#" class="d-block text-white">
                                            <i class="fab fa-linkedin-in"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>

                            <a href="instructors-single.html"
                               class="card-img sk-thumbnail img-ratio-4 card-hover-overlay d-block"><img
                                    class="rounded shadow-light-lg img-fluid"
                                    src="{{ asset('frontend/img/instructors/instructor-3.jpg')}}" alt="..."></a>
                        </div>

                        <!-- Footer -->
                        <div class="card-footer px-3 pt-4 pb-1">
                            <a href="instructors-single.html" class="d-block"><h5 class="mb-0">Kathelen Monero</h5></a>
                            <span class="font-size-d-sm">Designer</span>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-4 col-lg-3 text-center py-5 text-md-left px-3 px-md-4" data-aos="fade-up"
                     data-aos-delay="200">
                    <div class="card border shadow p-2 lift">
                        <!-- Image -->
                        <div class="card-zoom position-relative" style="max-width: 250px;">
                            <div class="card-float card-hover right-0 left-0 bottom-0 mb-4">
                                <ul class="nav mx-n4 justify-content-center">
                                    <li class="nav-item px-4">
                                        <a href="#" class="d-block text-white">
                                            <i class="fab fa-facebook-f"></i>
                                        </a>
                                    </li>
                                    <li class="nav-item px-4">
                                        <a href="#" class="d-block text-white">
                                            <i class="fab fa-twitter"></i>
                                        </a>
                                    </li>
                                    <li class="nav-item px-4">
                                        <a href="#" class="d-block text-white">
                                            <i class="fab fa-instagram"></i>
                                        </a>
                                    </li>
                                    <li class="nav-item px-4">
                                        <a href="#" class="d-block text-white">
                                            <i class="fab fa-linkedin-in"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>

                            <a href="instructors-single.html"
                               class="card-img sk-thumbnail img-ratio-4 card-hover-overlay d-block"><img
                                    class="rounded shadow-light-lg img-fluid"
                                    src="{{ asset('frontend/img/instructors/instructor-4.jpg')}}" alt="..."></a>
                        </div>

                        <!-- Footer -->
                        <div class="card-footer px-3 pt-4 pb-1">
                            <a href="instructors-single.html" class="d-block"><h5 class="mb-0">Kristen Pala</h5></a>
                            <span class="font-size-d-sm">User Experience Design</span>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-4 col-lg-3 text-center py-5 text-md-left px-3 px-md-4" data-aos="fade-up"
                     data-aos-delay="250">
                    <div class="card border shadow p-2 lift">
                        <!-- Image -->
                        <div class="card-zoom position-relative" style="max-width: 250px;">
                            <div class="card-float card-hover right-0 left-0 bottom-0 mb-4">
                                <ul class="nav mx-n4 justify-content-center">
                                    <li class="nav-item px-4">
                                        <a href="#" class="d-block text-white">
                                            <i class="fab fa-facebook-f"></i>
                                        </a>
                                    </li>
                                    <li class="nav-item px-4">
                                        <a href="#" class="d-block text-white">
                                            <i class="fab fa-twitter"></i>
                                        </a>
                                    </li>
                                    <li class="nav-item px-4">
                                        <a href="#" class="d-block text-white">
                                            <i class="fab fa-instagram"></i>
                                        </a>
                                    </li>
                                    <li class="nav-item px-4">
                                        <a href="#" class="d-block text-white">
                                            <i class="fab fa-linkedin-in"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>

                            <a href="instructors-single.html"
                               class="card-img sk-thumbnail img-ratio-4 card-hover-overlay d-block"><img
                                    class="rounded shadow-light-lg img-fluid"
                                    src="{{ asset('frontend/img/instructors/instructor-2.jpg')}}" alt="..."></a>
                        </div>

                        <!-- Footer -->
                        <div class="card-footer px-3 pt-4 pb-1">
                            <a href="instructors-single.html" class="d-block"><h5 class="mb-0">Anna Richard</h5></a>
                            <span class="font-size-d-sm">Travel Bloger</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CALL ACTION
    ================================================== -->
    <section class="py-6 py-md-11 border-top border-bottom jarallax" data-jarallax data-speed=".8"
             style="background-image: url({{ asset('frontend/img/illustrations/illustration-1.jpg')}})">
        <div class="container text-center py-xl-4" data-aos="fade-up">
            <h1 class="text-capitalize">Get personal learning recommendations</h1>
            <div class="font-size-lg mb-md-6 mb-4">Enhance your skills with best Online courses</div>
            <div class="mx-auto">
                <a href="course-list-v1.html" class="btn btn-primary btn-x-wide lift d-inline-block">GET STARTED NOW</a>
            </div>
        </div>
    </section>

</x-client.master-layout>
