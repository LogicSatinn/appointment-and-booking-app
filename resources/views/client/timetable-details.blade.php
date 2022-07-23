@section('title', $timetable->title)

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
                        Timetables
                    </a>
                </li>
                <li class="breadcrumb-item text-gray-800 active" aria-current="page">
                    {{ $timetable->title }}
                </li>
            </ol>
        </nav>
    </div>

    <!-- COURSE
    ================================================== -->
    <div class="container">
        <div class="row mb-8">

            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
            @endif

            <div class="col-lg-8 mb-6 mb-lg-0 position-relative">
                <h1 class="me-xl-14">
                    {{ $timetable->title }}
                </h1>

                <a href="#"
                   class="badge badge-lg badge-rounded-circle badge-secondary font-size-base badge-float badge-float-inside top-0 text-white">
                    <i class="far fa-heart"></i>
                </a>

                <!-- COURSE META
                ================================================== -->
                <div class="d-md-flex align-items-center mb-5">
                    {{--                    <div class="border rounded-circle d-inline-block mb-4 mb-md-0 me-md-6 me-lg-4 me-xl-6">--}}
                    {{--                        <div class="p-2">--}}
                    {{--                            <img src="{{ asset('frontend/img/avatars/avatar-1.jpg')}}" alt="..." class="rounded-circle" width="68" height="68">--}}
                    {{--                        </div>--}}
                    {{--                    </div>--}}

                    {{--                    <div class="mb-4 mb-md-0 me-md-8 me-lg-4 me-xl-8">--}}
                    {{--                        <h6 class="mb-0">Created by</h6>--}}
                    {{--                        <a href="#" class="font-size-sm text-gray-800">Alison Dawn</a>--}}
                    {{--                    </div>--}}

                    <div class="mb-4 mb-md-0 me-md-8 me-lg-4 me-xl-8">
                        <h6 class="mb-0">Categories</h6>
                        <a href="#" class="font-size-sm text-gray-800">{{ $timetable->skill->category->name }}</a>
                    </div>

                    {{--                    <div class="mb-4 mb-md-0 me-md-6 me-lg-4 me-xl-6">--}}
                    {{--                        <h6 class="mb-0">Review</h6>--}}
                    {{--                        <div class="d-lg-flex align-items-center">--}}
                    {{--                            <div class="star-rating mb-2 mb-lg-0">--}}
                    {{--                                <div class="rating" style="width:100%;"></div>--}}
                    {{--                            </div>--}}

                    {{--                            <div class="font-size-sm ms-lg-3">--}}
                    {{--                                <span>9.45 (9.8k+ reviews)</span>--}}
                    {{--                            </div>--}}
                    {{--                        </div>--}}
                    {{--                    </div>--}}
                </div>

                <a href="{{ route('skillDetails', $timetable->skill) }}" class="d-block sk-thumbnail rounded mb-6"
                   data-fancybox>
                    <img class="rounded shadow-light-lg" src="{{ asset('/media/' . $timetable->skill->image_path)}}"
                         alt="...">
                </a>

                <!-- COURSE INFO TAB
                ================================================== -->
                <div class="border rounded shadow p-3 mb-6">
                    <ul id="pills-tab" class="nav nav-pills course-tab-v2 h5 mb-0 flex-nowrap overflow-auto"
                        role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="pills-overview-tab" data-bs-toggle="pill"
                               href="#pills-overview" role="tab" aria-controls="pills-overview" aria-selected="true">Overview</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-details-tab" data-bs-toggle="pill"
                               href="#pills-details" role="tab" aria-controls="pills-details" aria-selected="false">Details</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-reviews-tab" data-bs-toggle="pill" href="#pills-reviews"
                               role="tab" aria-controls="pills-reviews" aria-selected="false">Reviews</a>
                        </li>
                    </ul>
                </div>

                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-overview" role="tabpanel"
                         aria-labelledby="pills-overview-tab">
                        <h3 class="">Skill Description</h3>
                        <p class="mb-6 line-height-md">{!! $timetable->skill->description !!}</p>
                    </div>

                    <div class="tab-pane fade" id="pills-details" role="tabpanel" aria-labelledby="pills-details-tab">
                        <h3 class="mb-6">Details</h3>
                        <div class="row align-items-center mb-8">
                            <div class="card">
                                <div class="card-body">

                                    <ul class="list-group">
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            Duration <span class="text-right">{{ $timetable->duration }} days</span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            From <span class="text-right">{{ $timetable->from }} </span></li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">To
                                            <span class="text-right">{{ $timetable->to }} </span></li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            Time <span
                                                class="text-right">{{ $timetable->start }} - {{ $timetable->end }}</span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            Lectures <span
                                                class="text-right">{{ $timetable->duration }}</span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            Enrolled <span
                                                class="text-right">{{ $timetable->clients()->count() }}</span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            Skill-Level <span
                                                class="text-right">{{ $timetable->level->value }}</span>
                                        </li>
{{--                                        <li class="list-group-item d-flex justify-content-between align-items-center">--}}
{{--                                            Deadline--}}
{{--                                        </li>--}}
{{--                                        <li class="list-group-item d-flex justify-content-between align-items-center">--}}
{{--                                            Certificate--}}
{{--                                        </li>--}}
                                    </ul>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="pills-reviews" role="tabpanel" aria-labelledby="pills-reviews-tab">
                        <h3 class="mb-6">Student feedback</h3>
                        <div class="row align-items-center mb-8">
                            <div class="col-md-auto mb-5 mb-md-0">
                                <div
                                    class="border rounded shadow d-flex align-items-center justify-content-center px-9 py-8">
                                    <div class="m-2 text-center">
                                        <h1 class="display-2 mb-0 fw-medium mb-n1">4.93</h1>
                                        <h5 class="mb-0">Skill rating</h5>
                                        <div class="star-rating">
                                            <div class="rating" style="width:100%;"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md">
                                <div class="d-md-flex align-items-center my-3 my-md-4">
                                    <div
                                        class="bg-gray-200 position-relative rounded-pill flex-grow-1 me-md-5 mb-2 mb-md-0 mw-md-260p"
                                        style="height: 10px;">
                                        <div class="bg-teal rounded-pill position-absolute top-0 left-0 bottom-0"
                                             style="width: 90%;"></div>
                                    </div>

                                    <div class="d-flex align-items-center">
                                        <div class="star-rating star-rating-lg secondary me-4">
                                            <div class="rating" style="width:90%;"></div>
                                        </div>
                                        <span>4132</span>
                                    </div>
                                </div>

                                <div class="d-md-flex align-items-center my-3 my-md-4">
                                    <div
                                        class="bg-gray-200 position-relative rounded-pill flex-grow-1 me-md-5 mb-2 mb-md-0 mw-md-260p"
                                        style="height: 10px;">
                                        <div class="bg-teal rounded-pill position-absolute top-0 left-0 bottom-0"
                                             style="width: 60%;"></div>
                                    </div>

                                    <div class="d-flex align-items-center">
                                        <div class="star-rating star-rating-lg secondary me-4">
                                            <div class="rating" style="width:60%;"></div>
                                        </div>
                                        <span>150</span>
                                    </div>
                                </div>

                                <div class="d-md-flex align-items-center my-3 my-md-4">
                                    <div
                                        class="bg-gray-200 position-relative rounded-pill flex-grow-1 me-md-5 mb-2 mb-md-0 mw-md-260p"
                                        style="height: 10px;">
                                        <div class="bg-teal rounded-pill position-absolute top-0 left-0 bottom-0"
                                             style="width: 50%;"></div>
                                    </div>

                                    <div class="d-flex align-items-center">
                                        <div class="star-rating star-rating-lg secondary me-4">
                                            <div class="rating" style="width:50%;"></div>
                                        </div>
                                        <span>50</span>
                                    </div>
                                </div>

                                <div class="d-md-flex align-items-center my-3 my-md-4">
                                    <div
                                        class="bg-gray-200 position-relative rounded-pill flex-grow-1 me-md-5 mb-2 mb-md-0 mw-md-260p"
                                        style="height: 10px;">
                                        <div class="bg-teal rounded-pill position-absolute top-0 left-0 bottom-0"
                                             style="width: 35%;"></div>
                                    </div>

                                    <div class="d-flex align-items-center">
                                        <div class="star-rating star-rating-lg secondary me-4">
                                            <div class="rating" style="width:35%;"></div>
                                        </div>
                                        <span>32</span>
                                    </div>
                                </div>

                                <div class="d-md-flex align-items-center my-3 my-md-4">
                                    <div
                                        class="bg-gray-200 position-relative rounded-pill flex-grow-1 me-md-5 mb-2 mb-md-0 mw-md-260p"
                                        style="height: 10px;">
                                        <div class="bg-teal rounded-pill position-absolute top-0 left-0 bottom-0"
                                             style="width: 15%;"></div>
                                    </div>

                                    <div class="d-flex align-items-center">
                                        <div class="star-rating star-rating-lg secondary me-4">
                                            <div class="rating" style="width:15%;"></div>
                                        </div>
                                        <span>1</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <ul class="list-unstyled pt-2">
                            <li class="media d-flex">
                                <div class="avatar avatar-xxl me-3 me-md-6 flex-shrink-0">
                                    <img src="frontend/img/avatars/avatar-1.jpg" alt="..."
                                         class="avatar-img rounded-circle">
                                </div>
                                <div class="media-body flex-grow-1">
                                    <div class="d-md-flex align-items-center mb-5">
                                        <div class="me-auto mb-4 mb-md-0">
                                            <h5 class="mb-0">Oscar Cafeo</h5>
                                            <p class="font-size-sm font-italic">Beautiful courses</p>
                                        </div>
                                        <div class="star-rating">
                                            <div class="rating" style="width:100%;"></div>
                                        </div>
                                    </div>
                                    <p class="mb-6 line-height-md">This course was well organized and covered a lot more
                                        details than any other Figma courses. I really enjoy it. One suggestion is that
                                        it can be much better if we could complete the prototype together. Since we
                                        created 24 frames, I really want to test it on Figma mirror to see all the
                                        connections. Could you please let me take a look at the complete prototype?</p>
                                </div>
                            </li>
                            <li class="media d-flex">
                                <div class="avatar avatar-xxl me-3 me-md-6 flex-shrink-0">
                                    <img src="frontend/img/avatars/avatar-2.jpg" alt="..."
                                         class="avatar-img rounded-circle">
                                </div>
                                <div class="media-body flex-grow-1">
                                    <div class="d-md-flex align-items-center mb-5">
                                        <div class="me-auto mb-4 mb-md-0">
                                            <h5 class="mb-0">Alex Morgan</h5>
                                            <p class="font-size-sm font-italic">Beautiful courses</p>
                                        </div>
                                        <div class="star-rating">
                                            <div class="rating" style="width:100%;"></div>
                                        </div>
                                    </div>
                                    <p class="mb-6 line-height-md">This course was well organized and covered a lot more
                                        details than any other Figma courses. I really enjoy it. One suggestion is that
                                        it can be much better if we could complete the prototype together. Since we
                                        created 24 frames, I really want to test it on Figma mirror to see all the
                                        connections. Could you please let me take a look at the complete prototype?</p>
                                </div>
                            </li>
                        </ul>

                        <div class="border shadow rounded p-6 p-md-9">
                            <h3 class="mb-2">Add Reviews & Rate</h3>
                            <div class="">What is it like to Skill?</div>
                            <form>
                                <div class="clearfix">
                                    <fieldset class="slect-rating mb-3">
                                        <input type="radio" id="star5" name="rating" value="5"/>
                                        <label class="full" for="star5" title="Awesome - 5 stars"></label>

                                        <input type="radio" id="star4half" name="rating" value="4 and a half"/>
                                        <label class="half" for="star4half" title="Pretty good - 4.5 stars"></label>

                                        <input type="radio" id="star4" name="rating" value="4"/>
                                        <label class="full" for="star4" title="Pretty good - 4 stars"></label>

                                        <input type="radio" id="star3half" name="rating" value="3 and a half"/>
                                        <label class="half" for="star3half" title="Meh - 3.5 stars"></label>

                                        <input type="radio" id="star3" name="rating" value="3"/>
                                        <label class="full" for="star3" title="Meh - 3 stars"></label>

                                        <input type="radio" id="star2half" name="rating" value="2 and a half"/>
                                        <label class="half" for="star2half" title="Kinda bad - 2.5 stars"></label>

                                        <input type="radio" id="star2" name="rating" value="2"/>
                                        <label class="full" for="star2" title="Kinda bad - 2 stars"></label>

                                        <input type="radio" id="star1half" name="rating" value="1 and a half"/>
                                        <label class="half" for="star1half" title="Meh - 1.5 stars"></label>

                                        <input type="radio" id="star1" name="rating" value="1"/>
                                        <label class="full" for="star1" title="Sucks big time - 1 star"></label>

                                        <input type="radio" id="starhalf" name="rating" value="half"/>
                                        <label class="half" for="starhalf" title="Sucks big time - 0.5 stars"></label>
                                    </fieldset>
                                </div>

                                <div class="form-group mb-6">
                                    <label for="exampleInputTitle1">Review Title</label>
                                    <input type="text" class="form-control placeholder-1" id="exampleInputTitle1"
                                           placeholder="Skills">
                                </div>

                                <div class="form-group mb-6">
                                    <label for="exampleFormControlTextarea1">Review Content</label>
                                    <textarea class="form-control placeholder-1" id="exampleFormControlTextarea1"
                                              rows="6" placeholder="Content"></textarea>
                                </div>

                                <button type="submit" class="btn btn-primary btn-block mw-md-300p">SUBMIT REVIEW
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <!-- SIDEBAR FILTER
                ================================================== -->
                <div class="d-block rounded border p-2 shadow mb-6">

                    <div class="pt-5 pb-4 px-5 px-lg-3 px-xl-5">
                        <div class="d-flex align-items-center mb-2">
                            <ins class="h2 mb-0">{{ $timetable->representablePrice }}</ins>
                            {{--                            <del class="ms-3">339.99</del>--}}
                            {{--                            <div class="badge badge-lg badge-purple text-white ms-auto fw-normal">91% Off</div>--}}
                        </div>

                        <div class="d-flex align-items-center text-alizarin mb-6">
                            <!-- Icon -->
                            <svg width="20" height="20" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M9.99974 3.0083C5.79444 3.0083 2.37305 6.42973 2.37305 10.635C2.37305 14.8405 5.79448 18.2619 9.99974 18.2619C14.2053 18.2619 17.6264 14.8405 17.6264 10.635C17.6264 6.42973 14.205 3.0083 9.99974 3.0083ZM9.99974 16.8797C6.55666 16.8797 3.7555 14.0783 3.7555 10.6353C3.7555 7.19219 6.55662 4.39103 9.99974 4.39103C13.4428 4.39103 16.244 7.19219 16.244 10.6353C16.244 14.0785 13.4428 16.8797 9.99974 16.8797Z"
                                    fill="currentColor"/>
                                <path
                                    d="M12.1193 10.4048H10.2761V7.73202C10.2761 7.35022 9.9666 7.04077 9.5848 7.04077C9.20301 7.04077 8.89355 7.35022 8.89355 7.73202V11.0961C8.89355 11.4779 9.20301 11.7873 9.5848 11.7873H12.1194C12.5012 11.7873 12.8106 11.4779 12.8106 11.0961C12.8106 10.7143 12.5011 10.4048 12.1193 10.4048Z"
                                    fill="currentColor"/>
                                <path
                                    d="M6.08489 15.5823C5.80102 15.3267 5.36391 15.35 5.10864 15.6336L3.0349 17.9378C2.77935 18.2214 2.80263 18.6585 3.08627 18.9138C3.2183 19.033 3.38372 19.0915 3.54849 19.0915C3.73767 19.0915 3.92614 19.0143 4.06255 18.8625L6.13629 16.5583C6.3918 16.2746 6.36852 15.8375 6.08489 15.5823Z"
                                    fill="currentColor"/>
                                <path
                                    d="M16.9661 17.9381L14.8924 15.634C14.6375 15.3501 14.2002 15.327 13.9163 15.5826C13.6325 15.8379 13.6097 16.275 13.865 16.5586L15.9387 18.8628C16.0749 19.0144 16.2633 19.0916 16.4525 19.0916C16.6171 19.0916 16.7825 19.033 16.9147 18.9141C17.1986 18.6588 17.2214 18.2217 16.9661 17.9381Z"
                                    fill="currentColor"/>
                                <path
                                    d="M5.96733 1.91597C4.59382 0.571053 2.3798 0.573123 1.03211 1.92105C0.361569 2.59132 -0.00479631 3.47819 4.74212e-05 4.41826C0.00512553 5.34705 0.373327 6.21665 1.03715 6.86689C1.17172 6.99845 1.34614 7.06411 1.52078 7.06411C1.69774 7.06411 1.87469 6.99638 2.00949 6.86181L5.9726 2.8987C6.10303 2.76808 6.17584 2.59085 6.17491 2.40632C6.17401 2.22171 6.09932 2.04523 5.96733 1.91597ZM1.5966 5.31939C1.45813 5.04037 1.38414 4.73162 1.38254 4.41088C1.37953 3.84315 1.60211 3.30581 2.00949 2.89843C2.41594 2.49222 2.95328 2.28921 3.49359 2.28921C3.80949 2.28921 4.12655 2.35855 4.4187 2.49726L1.5966 5.31939Z"
                                    fill="currentColor"/>
                                <path
                                    d="M18.9673 1.92072C17.6194 0.573026 15.4053 0.570721 14.0318 1.91564C13.9 2.04489 13.8252 2.22142 13.8242 2.40595C13.8233 2.59052 13.8963 2.76794 14.0268 2.89833L17.9899 6.86144C18.1247 6.99648 18.3016 7.06398 18.4786 7.06398C18.6532 7.06398 18.8279 6.99831 18.9622 6.86628C19.6263 6.21628 19.9945 5.34672 19.9993 4.41789C20.0042 3.47809 19.6376 2.59122 18.9673 1.92072ZM18.4028 5.3193L15.5807 2.4972C16.3729 2.12114 17.3459 2.25458 17.9899 2.89856C18.3973 3.30594 18.6199 3.84301 18.6169 4.41102C18.6152 4.73152 18.5413 5.04051 18.4028 5.3193Z"
                                    fill="currentColor"/>
                            </svg>

                            <span class="ms-2">{{ \Carbon\Carbon::parse(now())->diffInDays($timetable->from) }} day(s) left !</span>
                        </div>

                        <a class="btn btn-orange btn-block mb-6" href="{{ route('enroll-client', $timetable) }}">ENROLL</a>

                    </div>
                </div>

            </div>
        </div>

        <div class="text-center mb-5 mb-md-8">
            <h1>Other Timetables</h1>
        </div>

        <div class="mx-n4 mb-12"
             data-flickity='{"pageDots": true, "prevNextButtons": false, "cellAlign": "left", "wrapAround": true, "imagesLoaded": true}'>

            @foreach($otherTimetables as $otherTimetable)
                <x-client.other-timetables-card :otherTimetable="$otherTimetable"/>
            @endforeach
        </div>
    </div>
</x-client.master-layout>
