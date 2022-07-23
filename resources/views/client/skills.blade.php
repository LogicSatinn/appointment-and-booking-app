@section('title', 'Skills')

<x-client.master-layout>
    <!-- PAGE TITLE
================================================== -->
    <header class="py-8 py-md-11" style="background-image: none;">
        <div class="container text-center py-xl-2">
            <h1 class="display-4 fw-semi-bold mb-0">Skills</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-scroll justify-content-center">
                    <li class="breadcrumb-item">
                        <a class="text-gray-800" href="#">
                            Home
                        </a>
                    </li>
                    <li class="breadcrumb-item text-gray-800 active" aria-current="page">
                        Skills
                    </li>
                </ol>
            </nav>
        </div>
    </header>


    <!-- CONTROL BAR
    ================================================== -->
    <div class="container mb-6 mb-xl-8 z-index-2">
        <div class="d-xl-flex align-items-center">
            <p class="mb-xl-0">We have <span class="text-dark">{{ $skills->count() }} skill(s)</span> available for you</p>
            <div class="ms-xl-auto d-xl-flex flex-wrap">
                <div class="mb-4 mb-xl-0 ms-xl-6">
                    <!-- Search -->
                    <form class="">
                        <div class="input-group input-group-filter">
                            <input class="form-control form-control-sm placeholder-dark border-end-0 shadow-none" type="search" placeholder="Search our courses" aria-label="Search">
                            <div class="input-group-append">
                                <button class="btn btn-sm btn-outline-white border-start-0 text-dark bg-transparent" type="submit">
                                    <!-- Icon -->
                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M8.80758 0C3.95121 0 0 3.95121 0 8.80758C0 13.6642 3.95121 17.6152 8.80758 17.6152C13.6642 17.6152 17.6152 13.6642 17.6152 8.80758C17.6152 3.95121 13.6642 0 8.80758 0ZM8.80758 15.9892C4.8477 15.9892 1.62602 12.7675 1.62602 8.80762C1.62602 4.84773 4.8477 1.62602 8.80758 1.62602C12.7675 1.62602 15.9891 4.8477 15.9891 8.80758C15.9891 12.7675 12.7675 15.9892 8.80758 15.9892Z" fill="currentColor"/>
                                        <path d="M19.762 18.6121L15.1007 13.9509C14.7831 13.6332 14.2687 13.6332 13.9511 13.9509C13.6335 14.2682 13.6335 14.7831 13.9511 15.1005L18.6124 19.7617C18.7712 19.9205 18.9791 19.9999 19.1872 19.9999C19.395 19.9999 19.6032 19.9205 19.762 19.7617C20.0796 19.4444 20.0796 18.9295 19.762 18.6121Z" fill="currentColor"/>
                                    </svg>

                                </button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <!-- COURSE LIST V1
    ================================================== -->
    <div class="container pb-4 pb-xl-7">
        <div class="row row-cols-md-2 row-cols-xl-3 mb-6 mb-xl-3">
            @foreach($skills as $skill)
            <div class="col-md pb-4 pb-md-7">
                <!-- Card -->
                <div class="card border shadow p-2 lift sk-fade">
                    <!-- Image -->
                    <div class="card-zoom position-relative">
                        <a href="{{ route('skillDetails', $skill) }}" class="card-img sk-thumbnail d-block">
                            <img class="rounded shadow-light-lg" src="{{ asset('/media/' . $skill->image_path) }}" alt="{{ $skill->title }}">
                        </a>

{{--                        <span class="badge sk-fade-bottom badge-lg badge-orange badge-pill badge-float bottom-0 left-0 mb-4 ms-4">--}}
{{--                            <span class="text-white text-uppercase fw-bold font-size-xs">BEST SELLER</span>--}}
{{--                        </span>--}}
                    </div>

                    <!-- Footer -->
                    <div class="card-footer px-2 pb-2 mb-1 pt-4 position-relative">
{{--                        <a href="instructors-single.html" class="d-block">--}}
{{--                            <div class="avatar sk-fade-right avatar-xl badge-float position-absolute top-0 right-0 mt-n6 me-5 rounded-circle shadow border border-white border-w-lg">--}}
{{--                                <img src="assets/img/avatars/avatar-1.jpg" alt="..." class="avatar-img rounded-circle">--}}
{{--                            </div>--}}
{{--                        </a>--}}

                        <!-- Preheading -->
                        <a href="#"><span class="mb-1 d-inline-block text-gray-800" {{ $skill->category->name }}</span></a>

                        <!-- Heading -->
                        <div class="position-relative">
                            <a href="{{ route('skillDetails', $skill) }}" class="d-block stretched-link"><h4 class="line-clamp-2 h-md-48 h-lg-58 me-md-6 me-lg-10 me-xl-4 mb-2">
                                {{ $skill->title }}</h4></a>

                            <div class="d-lg-flex align-items-end flex-wrap mb-n1">
{{--                                <div class="star-rating mb-2 mb-lg-0 me-lg-3">--}}
{{--                                    <div class="rating" style="width:50%;"></div>--}}
{{--                                </div>--}}

{{--                                <div class="font-size-sm">--}}
{{--                                    <span>5.45 (5.8k+ reviews)</span>--}}
{{--                                </div>--}}
                            </div>

                            <div class="row mx-n2 align-items-end">
                                <div class="col px-2">
                                    <ul class="nav mx-n3">
                                        <li class="nav-item px-3">
                                            <div class="d-flex align-items-center">
                                                <div class="me-2 d-flex icon-uxs text-secondary">
                                                    <!-- Icon -->
                                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M17.1947 7.06802L14.6315 7.9985C14.2476 7.31186 13.712 6.71921 13.0544 6.25992C12.8525 6.11877 12.6421 5.99365 12.4252 5.88303C13.0586 5.25955 13.452 4.39255 13.452 3.43521C13.452 1.54098 11.9124 -1.90735e-06 10.0197 -1.90735e-06C8.12714 -1.90735e-06 6.58738 1.54098 6.58738 3.43521C6.58738 4.39255 6.98075 5.25955 7.61414 5.88303C7.39731 5.99365 7.1869 6.11877 6.98502 6.25992C6.32752 6.71921 5.79178 7.31186 5.40787 7.9985L2.8447 7.06802C2.33612 6.88339 1.79688 7.26044 1.79688 7.80243V16.5178C1.79688 16.8465 2.00256 17.14 2.31155 17.2522L9.75312 19.9536C9.93073 20.018 10.1227 20.0128 10.2863 19.9536L17.7278 17.2522C18.0368 17.14 18.2425 16.8465 18.2425 16.5178V7.80243C18.2425 7.26135 17.704 6.88309 17.1947 7.06802ZM10.0197 1.5625C11.0507 1.5625 11.8895 2.40265 11.8895 3.43521C11.8895 4.46777 11.0507 5.30792 10.0197 5.30792C8.98866 5.30792 8.14988 4.46777 8.14988 3.43521C8.14988 2.40265 8.98866 1.5625 10.0197 1.5625ZM9.23844 18.1044L3.35938 15.9703V8.91724L9.23844 11.0513V18.1044ZM10.0197 9.67255L6.90644 8.54248C7.58164 7.51892 8.75184 6.87042 10.0197 6.87042C11.2875 6.87042 12.4577 7.51892 13.1329 8.54248L10.0197 9.67255ZM16.68 15.9703L10.8009 18.1044V11.0513L16.68 8.91724V15.9703Z" fill="currentColor"/>
                                                    </svg>

                                                </div>
                                                <div class="font-size-sm">{{ $skill->timetables()->count() }} lessons</div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</x-client.master-layout>
