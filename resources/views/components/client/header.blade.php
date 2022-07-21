<!-- NAVBAR
================================================== -->
<header class="navbar navbar-expand-xl navbar-light bg-white border-bottom border-xl-0 py-2 py-xl-4">
    <div class="container-fluid">

        <!-- Brand -->
        <a class="navbar-brand me-0" href="{{ url('/') }}">
            <img src="{{ asset('nia-lab.jpeg')}}" class="navbar-brand-img" alt="...">
        </a>

        <!-- Vertical Menu -->
        <ul class="navbar-nav navbar-vertical ms-xl-4 d-none d-xl-flex">
            <li class="nav-item dropdown">
                <a class="nav-link pb-4 mb-n4 px-0 pt-0" id="navbarVerticalMenu" data-bs-toggle="dropdown" href="#" aria-haspopup="true" aria-expanded="false">
                    <div class="bg-primary rounded py-3 px-5 d-flex align-items-center">
                        <div class="me-3 ms-1 d-flex text-white">
                            <!-- Icon -->
                            <svg width="25" height="17" viewBox="0 0 25 17" xmlns="http://www.w3.org/2000/svg">
                                <rect width="25" height="1" fill="currentColor"/>
                                <rect y="8" width="15" height="1" fill="currentColor"/>
                                <rect y="16" width="20" height="1" fill="currentColor"/>
                            </svg>

                        </div>
                        <span class="text-white fw-medium me-1">Skills</span>
                    </div>
                </a>
            </li>
        </ul>

        <!-- Toggler -->
        <button class="navbar-toggler ms-4 ms-md-5 shadow-none bg-teal text-white icon-xs p-0 outline-0 h-40p w-40p d-flex d-xl-none place-flex-center" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <!-- Icon -->
            <svg width="25" height="17" viewBox="0 0 25 17" xmlns="http://www.w3.org/2000/svg">
                <rect width="25" height="1" fill="currentColor"/>
                <rect y="8" width="15" height="1" fill="currentColor"/>
                <rect y="16" width="20" height="1" fill="currentColor"/>
            </svg>

        </button>
    </div>
</header>
