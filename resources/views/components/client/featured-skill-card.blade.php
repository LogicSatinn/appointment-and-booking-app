@props(['skill'])

<div {{ $attributes->class(['col-12 col-md-6 col-xl-4 pb-4 pb-md-7'])->merge(['data-aos' => 'fade-up', 'data-aos-delay' => '50', 'style' => 'padding-right:15px;padding-left:15px']) }}

>
    <!-- Card -->
    <div class="card border shadow p-2 sk-fade">
        <!-- Image -->
        <div class="card-zoom position-relative">
            <div class="badge-float sk-fade-top top-0 right-0 mt-4 me-4">
                <a href="{{ route('skillDetails', $skill) }}"
                   class="btn btn-xs btn-dark text-white rounded-circle lift opacity-dot-7 me-1 p-2 d-inline-flex justify-content-center align-items-center w-36 h-36">
                    <!-- Icon -->
                    <svg width="18" height="18" viewBox="0 0 18 18" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M17.8856 8.64995C17.7248 8.42998 13.8934 3.26379 8.99991 3.26379C4.10647 3.26379 0.274852 8.42998 0.114223 8.64974C-0.0380743 8.85843 -0.0380743 9.14147 0.114223 9.35016C0.274852 9.57013 4.10647 14.7363 8.99991 14.7363C13.8934 14.7363 17.7248 9.5701 17.8856 9.35034C18.0381 9.14169 18.0381 8.85843 17.8856 8.64995ZM8.99991 13.5495C5.39537 13.5495 2.27345 10.1206 1.3493 8.99965C2.27226 7.87771 5.38764 4.4506 8.99991 4.4506C12.6043 4.4506 15.726 7.8789 16.6505 9.00046C15.7276 10.1224 12.6122 13.5495 8.99991 13.5495Z"
                            fill="currentColor"/>
                        <path
                            d="M8.9999 5.43958C7.03671 5.43958 5.43945 7.03683 5.43945 9.00003C5.43945 10.9632 7.03671 12.5605 8.9999 12.5605C10.9631 12.5605 12.5603 10.9632 12.5603 9.00003C12.5603 7.03683 10.9631 5.43958 8.9999 5.43958ZM8.9999 11.3736C7.69103 11.3736 6.62629 10.3089 6.62629 9.00003C6.62629 7.6912 7.69107 6.62642 8.9999 6.62642C10.3087 6.62642 11.3735 7.6912 11.3735 9.00003C11.3735 10.3089 10.3088 11.3736 8.9999 11.3736Z"
                            fill="currentColor"/>
                    </svg>

                </a>
                <a href="{{ route('skillDetails', $skill) }}"
                   class="btn btn-xs btn-dark text-white rounded-circle lift opacity-dot-7 p-2 d-inline-flex justify-content-center align-items-center w-36 h-36">
                    <!-- Icon -->
                    <svg width="16" height="16" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M11.2437 1.20728C10.0203 1.20728 8.87397 1.66486 7.99998 2.48357C7.12598 1.66486 5.97968 1.20728 4.7563 1.20728C2.13368 1.20728 0 3.341 0 5.96366C0 7.2555 0.425164 8.52729 1.26366 9.74361C1.91197 10.6841 2.80887 11.5931 3.92937 12.4454C5.809 13.8753 7.66475 14.6543 7.74285 14.6867L7.99806 14.7928L8.25384 14.6881C8.33199 14.6562 10.1889 13.8882 12.0696 12.4635C13.1907 11.6142 14.0881 10.7054 14.7367 9.7625C15.575 8.54385 16 7.26577 16 5.96371C16 3.341 13.8663 1.20728 11.2437 1.20728ZM8.00141 13.3353C6.74962 12.7555 1.33966 10.0142 1.33966 5.96366C1.33966 4.07969 2.87237 2.54698 4.75634 2.54698C5.827 2.54698 6.81558 3.03502 7.46862 3.88598L8.00002 4.57845L8.53142 3.88598C9.18446 3.03502 10.173 2.54698 11.2437 2.54698C13.1276 2.54698 14.6604 4.07969 14.6604 5.96366C14.6603 10.0433 9.25265 12.7613 8.00141 13.3353Z"
                            fill="currentColor"/>
                    </svg>

                </a>
            </div>

            <a href="{{ route('skillDetails', $skill) }}" class="card-img sk-thumbnail d-block">
                <img class="rounded shadow-light-lg" src="{{ asset('/media/'.$skill->image_path)}}"
                     alt="...">
            </a>

{{--            <span--}}
{{--                class="badge sk-fade-bottom badge-lg badge-orange badge-pill badge-float bottom-0 left-0 mb-4 ms-4">--}}
{{--                                <span class="text-white text-uppercase fw-bold font-size-xs">BEST SELLER</span>--}}
{{--                            </span>--}}
        </div>

        <!-- Footer -->
        <div class="card-footer px-2 pb-2 mb-1 pt-4 position-relative">
            {{--            <a href="instructors-single.html" class="d-block">--}}
            {{--                <div--}}
            {{--                    class="avatar avatar-xl badge-float position-absolute top-0 right-0 mt-n6 me-5 rounded-circle shadow border border-white border-w-lg">--}}
            {{--                    <img src="{{ asset('frontend/img/avatars/avatar-1.jpg')}}" alt="..."--}}
            {{--                         class="avatar-img rounded-circle">--}}
            {{--                </div>--}}
            {{--            </a>--}}

            <!-- Preheading -->
            <a href="{{ route('skillDetails', $skill) }}"><span
                    class="mb-1 d-inline-block text-gray-800">{{ $skill->category->name }}</span></a>

            <!-- Heading -->
            <div class="position-relative">
                <a href="{{ route('skillDetails', $skill) }}" class="d-block stretched-link"><h4
                        class="line-clamp-2 me-md-6 me-lg-10 me-xl-4 mb-2">{{ $skill->title }}</h4></a>

                <div class="row mx-n2 align-items-end mh-50">
                    <div class="col px-2">
                        <ul class="nav mx-n3">
                            <li class="nav-item px-3">
                                <div class="d-flex align-items-center">
                                    <div class="me-2 d-flex icon-uxs text-secondary">
                                        <!-- Icon -->
                                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M17.1947 7.06802L14.6315 7.9985C14.2476 7.31186 13.712 6.71921 13.0544 6.25992C12.8525 6.11877 12.6421 5.99365 12.4252 5.88303C13.0586 5.25955 13.452 4.39255 13.452 3.43521C13.452 1.54098 11.9124 -1.90735e-06 10.0197 -1.90735e-06C8.12714 -1.90735e-06 6.58738 1.54098 6.58738 3.43521C6.58738 4.39255 6.98075 5.25955 7.61414 5.88303C7.39731 5.99365 7.1869 6.11877 6.98502 6.25992C6.32752 6.71921 5.79178 7.31186 5.40787 7.9985L2.8447 7.06802C2.33612 6.88339 1.79688 7.26044 1.79688 7.80243V16.5178C1.79688 16.8465 2.00256 17.14 2.31155 17.2522L9.75312 19.9536C9.93073 20.018 10.1227 20.0128 10.2863 19.9536L17.7278 17.2522C18.0368 17.14 18.2425 16.8465 18.2425 16.5178V7.80243C18.2425 7.26135 17.704 6.88309 17.1947 7.06802ZM10.0197 1.5625C11.0507 1.5625 11.8895 2.40265 11.8895 3.43521C11.8895 4.46777 11.0507 5.30792 10.0197 5.30792C8.98866 5.30792 8.14988 4.46777 8.14988 3.43521C8.14988 2.40265 8.98866 1.5625 10.0197 1.5625ZM9.23844 18.1044L3.35938 15.9703V8.91724L9.23844 11.0513V18.1044ZM10.0197 9.67255L6.90644 8.54248C7.58164 7.51892 8.75184 6.87042 10.0197 6.87042C11.2875 6.87042 12.4577 7.51892 13.1329 8.54248L10.0197 9.67255ZM16.68 15.9703L10.8009 18.1044V11.0513L16.68 8.91724V15.9703Z"
                                                fill="currentColor"/>
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
