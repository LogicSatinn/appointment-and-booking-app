<nav id="sidebar" aria-label="Main Navigation">
    <!-- Side Header (mini Sidebar mode) -->
    <div class="smini-visible-block">
        <div class="content-header bg-header-dark">
            <!-- Logo -->
            <a class="link-fx font-size-lg text-white" href="index.html">
                <span class="text-white-75">X</span><span class="text-white">B</span>
            </a>
            <!-- END Logo -->
        </div>
    </div>
    <!-- END Side Header (mini Sidebar mode) -->

    <!-- Side Header (normal Sidebar mode) -->
    <div class="smini-hidden">
        <div class="content-header justify-content-lg-center bg-header-dark">
            <!-- Logo -->
            <a class="link-fx font-size-lg text-white" href="index.html">
                <span class="text-white-75">X</span>
                <span class="text-white">Banking</span>
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
            <a class="link-fx text-muted" href="javascript:void(0)">$ 49.680,00</a>
        </div>
    </div>
    <!-- END Side Actions -->

    <!-- Side Navigation -->
    <div class="content-side content-side-full">
        <ul class="nav-main">
            <li class="nav-main-item">
                <a class="nav-main-link active" href="db_banking.html">
                    <i class="nav-main-link-icon fa fa-rocket"></i>
                    <span class="nav-main-link-name">Overview</span>
                </a>
            </li>
            <li class="nav-main-heading">Manage</li>
{{--            <li class="nav-main-item">--}}
{{--                <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="false" href="#">--}}
{{--                    <i class="nav-main-link-icon fa fa-piggy-bank"></i>--}}
{{--                    <span class="nav-main-link-name">Accounts</span>--}}
{{--                </a>--}}
{{--                <ul class="nav-main-submenu">--}}
{{--                    <li class="nav-main-item">--}}
{{--                        <a class="nav-main-link" href="">--}}
{{--                            <span class="nav-main-link-name">Active</span>--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                    <li class="nav-main-item">--}}
{{--                        <a class="nav-main-link" href="">--}}
{{--                            <span class="nav-main-link-name">Manage</span>--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                    <li class="nav-main-item">--}}
{{--                        <a class="nav-main-link" href="">--}}
{{--                            <i class="nav-main-link-icon fa fa-plus-circle"></i>--}}
{{--                            <span class="nav-main-link-name">New Account</span>--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                </ul>--}}
{{--            </li>--}}
{{--            <li class="nav-main-item">--}}
{{--                <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="false" href="#">--}}
{{--                    <i class="nav-main-link-icon fa fa-money-check"></i>--}}
{{--                    <span class="nav-main-link-name">Cards</span>--}}
{{--                </a>--}}
{{--                <ul class="nav-main-submenu">--}}
{{--                    <li class="nav-main-item">--}}
{{--                        <a class="nav-main-link" href="">--}}
{{--                            <span class="nav-main-link-name">Approved</span>--}}
{{--                            <span class="nav-main-link-badge badge badge-pill badge-success">3</span>--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                    <li class="nav-main-item">--}}
{{--                        <a class="nav-main-link" href="">--}}
{{--                            <span class="nav-main-link-name">Pending</span>--}}
{{--                            <span class="nav-main-link-badge badge badge-pill badge-warning">1</span>--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                    <li class="nav-main-item">--}}
{{--                        <a class="nav-main-link" href="">--}}
{{--                            <span class="nav-main-link-name">Manage</span>--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                    <li class="nav-main-item">--}}
{{--                        <a class="nav-main-link" href="">--}}
{{--                            <i class="nav-main-link-icon fa fa-plus-circle"></i>--}}
{{--                            <span class="nav-main-link-name">New Card</span>--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                </ul>--}}
{{--            </li>--}}
{{--            <li class="nav-main-item">--}}
{{--                <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="false" href="#">--}}
{{--                    <i class="nav-main-link-icon fa fa-money-bill"></i>--}}
{{--                    <span class="nav-main-link-name">Payments</span>--}}
{{--                </a>--}}
{{--                <ul class="nav-main-submenu">--}}
{{--                    <li class="nav-main-item">--}}
{{--                        <a class="nav-main-link" href="">--}}
{{--                            <span class="nav-main-link-name">Scheduled</span>--}}
{{--                            <span class="nav-main-link-badge badge badge-pill badge-success">2</span>--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                    <li class="nav-main-item">--}}
{{--                        <a class="nav-main-link" href="">--}}
{{--                            <span class="nav-main-link-name">Recurring</span>--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                    <li class="nav-main-item">--}}
{{--                        <a class="nav-main-link" href="">--}}
{{--                            <span class="nav-main-link-name">Manage</span>--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                    <li class="nav-main-item">--}}
{{--                        <a class="nav-main-link" href="">--}}
{{--                            <i class="nav-main-link-icon fa fa-plus-circle"></i>--}}
{{--                            <span class="nav-main-link-name">New Payment</span>--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                </ul>--}}
{{--            </li>--}}
            <li class="nav-main-item">
                <a class="nav-main-link" href="{{ route('categories.index') }}">
                    <i class="nav-main-link-icon fa fa-user-circle"></i>
                    <span class="nav-main-link-name">Categories</span>
                </a>
            </li>

            <li class="nav-main-heading">Personal</li>
            <li class="nav-main-item">
                <a class="nav-main-link" href="">
                    <i class="nav-main-link-icon fa fa-user-circle"></i>
                    <span class="nav-main-link-name">Profile</span>
                </a>
            </li>
            <li class="nav-main-item">
                <a class="nav-main-link" href="">
                    <i class="nav-main-link-icon fa fa-envelope"></i>
                    <span class="nav-main-link-name">Messages</span>
                    <span class="nav-main-link-badge badge badge-pill badge-success">3</span>
                </a>
            </li>
            <li class="nav-main-item">
                <a class="nav-main-link" href="">
                    <i class="nav-main-link-icon fa fa-cog"></i>
                    <span class="nav-main-link-name">Settings</span>
                </a>
            </li>
            <li class="nav-main-item">
                <a class="nav-main-link" href="">
                    <i class="nav-main-link-icon fa fa-lock"></i>
                    <span class="nav-main-link-name">Security</span>
                    <span class="nav-main-link-badge badge badge-pill badge-danger">1</span>
                </a>
            </li>
            <li class="nav-main-heading">Dashboards</li>
            <li class="nav-main-item">
                <a class="nav-main-link" href="be_pages_dashboard_all.html">
                    <i class="nav-main-link-icon si si-arrow-left"></i>
                    <span class="nav-main-link-name">Go Back</span>
                </a>
            </li>
        </ul>
    </div>
    <!-- END Side Navigation -->
</nav>
<!-- END Sidebar -->
