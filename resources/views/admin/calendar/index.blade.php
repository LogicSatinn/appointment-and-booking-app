@section('title', 'Calendar')

<x-admin.master-layout>
    <div class="row no-gutters flex-md-10-auto">
        <div class="col-md-4 col-lg-5 col-xl-3">
            <div class="content">
                <!-- Toggle Side Content -->
                <div class="d-md-none push">
                    <!-- Class Toggle, functionality initialized in Helpers.coreToggleClass() -->
                    <button type="button" class="btn btn-block btn-hero-primary" data-toggle="class-toggle" data-target="#side-content" data-class="d-none">
                        Calendar Options
                    </button>
                </div>
                <!-- END Toggle Side Content -->

                <!-- Side Content -->
                <div id="side-content" class="d-none d-md-block push">
                    <!-- Add Event Form -->
                    <form class="js-form-add-event push">
                        <div class="input-group">
                            <input type="text" class="js-add-event form-control border-0" placeholder="Add Event..">
                            <div class="input-group-append">
                                            <span class="input-group-text border-0 bg-white">
                                                <i class="fa fa-fw fa-plus-circle"></i>
                                            </span>
                            </div>
                        </div>
                    </form>
                    <!-- END Add Event Form -->

                    <!-- Event List -->
                    <ul class="js-events list list-events">
                        <li class="bg-info-light">Codename X</li>
                        <li class="bg-success-light">Weekend Adventure</li>
                        <li class="bg-info-light">Project Mars</li>
                        <li class="bg-warning-light">Meeting</li>
                        <li class="bg-success-light">Walk the dog</li>
                        <li class="bg-info-light">AI schedule</li>
                        <li class="bg-success-light">Cinema</li>
                        <li class="bg-danger-light">Project X</li>
                        <li class="bg-warning-light">Skype Meeting</li>
                    </ul>
                    <div class="text-center">
                        <em class="font-size-sm text-muted">
                            <i class="fa fa-arrows-alt"></i> Drag and drop events on the calendar
                        </em>
                    </div>
                    <!-- END Event List -->
                </div>
                <!-- END Side Content -->
            </div>
        </div>
        <div class="col-md-8 col-lg-7 col-xl-9 bg-body-dark">
            <div class="content">
                <div class="block block-fx-pop">
                    <div class="block-content block-content-full">
                        <!-- Calendar Container -->
                        <div class="js-calendar p-xl-4"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    @push('page_css')
        <link rel="stylesheet" href="{{ asset('assets/js/plugins/fullcalendar/fullcalendar.min.css')}}">
    @endpush

    @push('page_js')
        <script src="{{ asset('assets/js/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
        <script src="{{ asset('assets/js/plugins/moment/moment.min.js')}}"></script>
        <script src="{{ asset('assets/js/plugins/fullcalendar/fullcalendar.min.js')}}"></script>

        <!-- Page JS Code -->
        <script src="{{ asset('assets/js/pages/be_comp_calendar.min.js')}}"></script>
    @endpush
</x-admin.master-layout>


