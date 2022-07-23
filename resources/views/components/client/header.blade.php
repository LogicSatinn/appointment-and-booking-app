<!-- NAVBAR
================================================== -->
<header class="navbar navbar-expand-xl navbar-light bg-white border-bottom border-xl-0 py-2 py-xl-4">
    <div class="container-fluid">

        <!-- Brand -->
        <a class="navbar-brand me-0" href="{{ url('/') }}">
            <img src="{{ asset('nia-lab.jpeg')}}" class="navbar-brand-img" alt="...">
        </a>


        <div class="collapse navbar-collapse z-index-lg" id="navbarCollapse">
        <!-- Toggler -->
        <button class="navbar-toggler ms-4 ms-md-5 shadow-none bg-teal text-white icon-xs p-0 outline-0 h-40p w-40p d-flex d-xl-none place-flex-center" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <!-- Icon -->
            <svg width="25" height="17" viewBox="0 0 25 17" xmlns="http://www.w3.org/2000/svg">
                <rect width="25" height="1" fill="currentColor"/>
                <rect y="8" width="15" height="1" fill="currentColor"/>
                <rect y="16" width="20" height="1" fill="currentColor"/>
            </svg>

        </button>

            <ul class="navbar-nav ms-auto">
                <li class="nav-item @if(request()->is('/')) active @endif">
                    <a class="nav-link" href="{{ url('/') }}" aria-haspopup="true" aria-expanded="false">
                        Home
                    </a>
                </li>

                <li class="nav-item @if(request()->is('/skills')) active @endif">
                    <a class="nav-link" href="{{ route('skills') }}" aria-haspopup="true" aria-expanded="false">
                        Skills
                    </a>
                </li>
            </ul>
        </div>
    </div>
</header>
