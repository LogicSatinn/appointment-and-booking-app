@section('title', $skill->title)

<x-client.master-layout>
    <!-- BREADCRUMBS
================================================== -->
    <div class="container">
        <nav class="mb-5 mb-md-8 mt-2" aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-scroll">
                <li class="breadcrumb-item">
                    <a class="text-gray-800" href="{{ url('/') }}">
                        Home
                    </a>
                </li>
                <li class="breadcrumb-item">
                    <a class="text-gray-800" href="#">
                        Skills
                    </a>
                </li>
                <li class="breadcrumb-item text-gray-800 active" aria-current="page">
                    {{ $skill->title }}
                </li>
            </ol>
        </nav>
    </div>

    <!-- COURSE
 ================================================== -->
    <div class="container">
        <div class="row mb-8">
            <div class="col-lg-12 mb-6 mb-lg-0 position-relative">
                <h1 class="me-xl-14">
                    {{ $skill->title }}
                </h1>

                <!-- COURSE META
                ================================================== -->
                <div class="d-md-flex align-items-center mb-5">
                    <div class="mb-4 mb-md-0 me-md-8 me-lg-4 me-xl-8">
                        <h6 class="mb-0">Category</h6>
                        <a href="#" class="font-size-sm text-gray-800">{{ $skill->category->name }}</a>
                    </div>
                </div>

                <a href="https://www.youtube.com/watch?v=9I-Y6VQ6tyI" class="d-block sk-thumbnail rounded mb-6" data-fancybox>
                    <img class="rounded shadow-light-lg" src="{{ asset('/media/' . $skill->image_path) }}" alt="...">
                </a>

                <!-- COURSE INFO TAB
                ================================================== -->
                <div class="border rounded shadow p-3 mb-6">
                    <ul id="pills-tab" class="nav nav-pills course-tab-v2 h5 mb-0 flex-nowrap overflow-auto" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="pills-overview-tab" data-bs-toggle="pill" href="#pills-overview" role="tab" aria-controls="pills-overview" aria-selected="true">Overview</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-modeOfDelivery-tab" data-bs-toggle="pill" href="#pills-modeOfDelivery" role="tab" aria-controls="pills-modeOfDelivery" aria-selected="false">Mode of Delivery</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-prerequisite-tab" data-bs-toggle="pill" href="#pills-prerequisite" role="tab" aria-controls="pills-prerequisite" aria-selected="false">Pre-requisite</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-suitableFor-tab" data-bs-toggle="pill" href="#pills-suitableFor" role="tab" aria-controls="pills-suitableFor" aria-selected="false">Suitable For</a>
                        </li>
                    </ul>
                </div>

                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-overview" role="tabpanel" aria-labelledby="pills-overview-tab">
                        <h3 class="mb-6">Skill Description</h3>
                        <p>{!! $skill->description !!}</p>
                    </div>

                    <div class="tab-pane fade" id="pills-modeOfDelivery" role="tabpanel" aria-labelledby="pills-modeOfDelivery-tab">
                        <h3 class="mb-6">Mode Of Delivery</h3>
                        <p>{!! $skill->mode_of_delivery !!}</p>
                    </div>

                    <div class="tab-pane fade" id="pills-prerequisite" role="tabpanel" aria-labelledby="pills-prerequisite-tab">
                        <h3 class="mb-6">Pre-requisite</h3>
                        <p>{!! $skill->prerequisite !!}</p>
                    </div>

                    <div class="tab-pane fade" id="pills-suitableFor" role="tabpanel" aria-labelledby="pills-suitableFor-tab">
                        <h3 class="mb-6">Suitable For</h3>
                        <p>{!! $skill->suitable_for !!}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center mb-5 mb-md-8">
            <h1>Schedule</h1>
        </div>


        <div class="mx-n4 mb-12" data-flickity='{"pageDots": true, "prevNextButtons": false, "cellAlign": "left", "wrapAround": true, "imagesLoaded": true}'>
            @foreach($timetables as $timetable)
                <div class="col-xl-8 m-3">
                    <!-- Card -->
                    <div
                        class="card border shadow p-2 lift sk-fade mb-6 flex-md-row align-items-center row gx-0">
                        <!-- Image -->
                        <div class="col-md-4 card-zoom position-relative">
                            <div class="badge-float sk-fade-top top-0 right-0 mt-4 me-4">
                                <a href="{{ route('timetableDetails', $timetable) }}"
                                   class="btn btn-xs btn-dark text-white rounded-circle lift opacity-dot-7 me-1 p-2 d-inline-flex justify-content-center align-items-center w-36 h-36">
                                    <!-- Icon -->
                                    <svg width="18" height="18" viewBox="0 0 18 18"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M17.8856 8.64995C17.7248 8.42998 13.8934 3.26379 8.99991 3.26379C4.10647 3.26379 0.274852 8.42998 0.114223 8.64974C-0.0380743 8.85843 -0.0380743 9.14147 0.114223 9.35016C0.274852 9.57013 4.10647 14.7363 8.99991 14.7363C13.8934 14.7363 17.7248 9.5701 17.8856 9.35034C18.0381 9.14169 18.0381 8.85843 17.8856 8.64995ZM8.99991 13.5495C5.39537 13.5495 2.27345 10.1206 1.3493 8.99965C2.27226 7.87771 5.38764 4.4506 8.99991 4.4506C12.6043 4.4506 15.726 7.8789 16.6505 9.00046C15.7276 10.1224 12.6122 13.5495 8.99991 13.5495Z"
                                            fill="currentColor"/>
                                        <path
                                            d="M8.9999 5.43958C7.03671 5.43958 5.43945 7.03683 5.43945 9.00003C5.43945 10.9632 7.03671 12.5605 8.9999 12.5605C10.9631 12.5605 12.5603 10.9632 12.5603 9.00003C12.5603 7.03683 10.9631 5.43958 8.9999 5.43958ZM8.9999 11.3736C7.69103 11.3736 6.62629 10.3089 6.62629 9.00003C6.62629 7.6912 7.69107 6.62642 8.9999 6.62642C10.3087 6.62642 11.3735 7.6912 11.3735 9.00003C11.3735 10.3089 10.3088 11.3736 8.9999 11.3736Z"
                                            fill="currentColor"/>
                                    </svg>

                                </a>

                            </div>

                            <a href="#" class="card-img sk-thumbnail img-ratio-2 d-block">
                                <img class="rounded shadow-light-lg"
                                     src="{{ asset('/media/' . $skill->image_path)}}"
                                     alt="...">
                            </a>

                            <span
                                class="badge sk-fade-bottom badge-lg badge-orange badge-pill badge-float bottom-0 left-0 mb-4 ms-4">
                            <span class="text-white text-uppercase fw-bold font-size-xs">{{ $timetable->level->value }}</span>
                        </span>
                        </div>

                        <!-- Footer -->
                        <div class="col-md-8 card-footer px-2 px-md-5 py-4 py-md-0 position-relative">
                            <!-- Preheading -->
                            <a href="#"><span
                                    class="mb-1 d-inline-block text-gray-800">{{ $skill->category->name }}</span></a>

                            <!-- Heading -->
                            <div class="position-relative">
                                <a href="{{ route('timetableDetails', $timetable) }}"
                                   class="d-block stretched-link"><h4
                                        class="line-clamp-2 me-md-6 me-lg-10 me-xl-4 mb-3">{{ $timetable->title }}</h4>
                                </a>
                                <ul class="nav mx-n3 mb-3">
                                    <li class="nav-item px-3">
                                        <div class="d-flex align-items-center">
                                            <div class="font-size-sm">{{ $timetable->from }}
                                                - {{ $timetable->to }}</div>
                                        </div>
                                    </li>
                                    <li class="nav-item px-3">
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
                                            <div class="font-size-sm">{{ $timetable->start }}
                                                - {{ $timetable->end }}</div>
                                        </div>
                                    </li>
                                </ul>

                                <div class="row mx-n2 align-items-center">
                                    <div class="col px-2">
                                        {{--                                                <del class="font-size-sm">$959</del>--}}
                                        <ins
                                            class="h4 mb-0 mb-lg-n1 ms-1">{{ $timetable->representablePrice() }}</ins>
                                    </div>

                                    {{--                                            <div class="col-auto px-2">--}}
                                    {{--                                                <div class="d-lg-flex align-items-end">--}}
                                    {{--                                                    <div class="star-rating mb-2 mb-lg-0">--}}
                                    {{--                                                        <div class="rating" style="width:100%;"></div>--}}
                                    {{--                                                    </div>--}}
                                    {{--                                                </div>--}}
                                    {{--                                            </div>--}}
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            @endforeach
        </div>
    </div>

</x-client.master-layout>
