<nav id="sidebar" aria-label="Main Navigation">
    <!-- Side Header (mini Sidebar mode) -->
    <div class="smini-visible-block">
        <div class="content-header bg-header-dark">
            <!-- Logo -->
            <a class="link-fx font-size-lg text-white" href="{{ route('dashboard') }}">
                <span class="text-white-75">Nia</span><span class="text-white">LaB</span>
            </a>
            <!-- END Logo -->
        </div>
    </div>
    <!-- END Side Header (mini Sidebar mode) -->

    <!-- Side Header (normal Sidebar mode) -->
    <div class="smini-hidden">
        <div class="content-header justify-content-lg-center bg-header-dark">
            <!-- Logo -->
            <a class="link-fx font-size-lg text-white" href="{{ route('dashboard') }}">
                <span class="text-white">{{ config('app.name') }}</span>
            </a>
            <!-- END Logo -->

            <!-- Options -->
            <div class="d-lg-none">
                <!-- Close Sidebar, Visible only on mobile screens -->
                <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                <a class="text-white ml-2" data-toggle="layout" data-action="sidebar_close" href="javascript:void(0)">
                    <i class="fa fa-times-circle"></i>
                </a>
                <!-- END Close Sidebar -->
            </div>
            <!-- END Options -->
        </div>
    </div>
    <!-- END Side Header (normal Sidebar mode) -->

    <!-- Side Actions -->
    <div class="content-side content-side-full text-center bg-body-light">
        <div class="smini-hide">
            <img class="img-avatar" src="{{ asset('assets/media/avatars/avatar10.jpg')}}" alt="">
            <div class="mt-3 font-w600">{{ auth()->user()->name }}</div>
            <a class="link-fx text-muted" href="javascript:void(0)">Administrator</a>
        </div>
    </div>
    <!-- END Side Actions -->

    <!-- Side Navigation -->
    <div class="content-side content-side-full">
        <ul class="nav-main">
            <li class="nav-main-item">
                <a class="nav-main-link active" href="{{ route('dashboard') }}">
                    <i class="nav-main-link-icon fa fa-rocket"></i>
                    <span class="nav-main-link-name">Overview</span>
                </a>
            </li>
            <li class="nav-main-heading">Manage</li>
            <li class="nav-main-item">
                <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="false" href="#">
                    <i class="nav-main-link-icon fa fa-money-bill"></i>
                    <span class="nav-main-link-name">Skills</span>
                </a>
                <ul class="nav-main-submenu">
                    <li class="nav-main-item">
                        <a class="nav-main-link" href="{{ route('skills.index') }}">
                            <span class="nav-main-link-name">All Skills</span>
                        </a>
                    </li>
                    <li class="nav-main-item">
                        <a class="nav-main-link" href="{{ route('skills.create') }}">
                            <span class="nav-main-link-name">New Skill</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-main-item">
                <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="false" href="#">
                    <i class="nav-main-link-icon fa fa-bell"></i>
                    <span class="nav-main-link-name">Appointments</span>
                </a>
                <ul class="nav-main-submenu">
                    <li class="nav-main-item">
                        <a class="nav-main-link" href="{{ route('appointments.index') }}">
                            <span class="nav-main-link-name">All Appointments</span>
                        </a>
                    </li>
                    <li class="nav-main-item">
                        <a class="nav-main-link" href="{{ route('appointments.create') }}">
                            <span class="nav-main-link-name">New Appointment</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-main-item">
                <a class="nav-main-link" href="{{ route('categories.index') }}">
                    <i class="nav-main-link-icon fa fa-archive"></i>
                    <span class="nav-main-link-name">Categories</span>
                </a>
            </li>
            <li class="nav-main-item">
                <a class="nav-main-link" href="{{ route('resources.index') }}">
                    <i class="nav-main-link-icon fa fa-book-reader"></i>
                    <span class="nav-main-link-name">Resources</span>
                </a>
            </li>


            <li class="nav-main-heading">Global</li>
            <li class="nav-main-item">
                <a class="nav-main-link" href="{{ route('calendar.index') }}">
                    <i class="nav-main-link-icon fa fa-calendar"></i>
                    <span class="nav-main-link-name">Calendar</span>
                </a>
            </li>
            <li class="nav-main-item">
                <a class="nav-main-link" href="{{ route('settings.index') }}">
                    <i class="nav-main-link-icon fa fa-cog"></i>
                    <span class="nav-main-link-name">Settings</span>
                </a>
            </li>

            <li class="nav-main-heading"></li>
            <li class="nav-main-item">
                <a class="nav-main-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logoutForm').submit();">
                    <i class="nav-main-link-icon si si-arrow-left"></i>
                    <span class="nav-main-link-name">Log Out</span>
                </a>
                <form action="{{ route('logout') }}" method="POST" id="logoutForm">
                    @csrf
                </form>
            </li>
        </ul>
    </div>
    <!-- END Side Navigation -->
</nav>
<!-- END Sidebar -->
