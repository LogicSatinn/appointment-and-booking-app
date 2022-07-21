@section('title', 'Enroll Client')

<div>

    <header class="py-8 py-md-11" style="background-image: none;">
        <div class="container text-center py-xl-2">
            <h1 class="display-4 fw-semi-bold mb-0">Enroll Client</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-scroll justify-content-center">
                    <li class="breadcrumb-item">
                        <a class="text-gray-800" href="{{ url('/') }}">
                            Home
                        </a>
                    </li>
                    <li class="breadcrumb-item">
                        <a class="text-gray-800" href="#">
                            Appointment
                        </a>
                    </li>
                    <li class="breadcrumb-item">
                        <a class="text-gray-800" href="{{ route('appointmentDetails', $appointment) }}">
                            {{ $appointment->title }}
                        </a>
                    </li>
                    <li class="breadcrumb-item text-gray-800 active" aria-current="page">
                        Enroll
                    </li>
                </ol>
            </nav>
        </div>
    </header>


    <!-- REGISTER
    ================================================== -->
    <div class="container mb-11">
        <div class="row gx-0">
            <div class="col-md-7 col-xl-4 mx-auto">
                <!-- Register -->
                <h3 class="mb-6">Enroll and Start Learning!</h3>

                <!-- Form Register -->
                <form class="mb-5" wire:submit.prevent="saveClient">

                    <!-- Username -->
                    <div class="form-group mb-5">
                        <label for="name">
                            Name
                        </label>
                        <input type="text" class="form-control" id="name" wire:model="name" onfocus="this.value=''">
                    </div>

                    <!-- Email -->
                    <div class="form-group mb-5">
                        <label for="email">
                            Email
                        </label>
                        <input type="email" class="form-control" id="email" wire:model="email" onfocus="this.value=''">
                    </div>

                    <div class="form-group mb-5">
                        <label for="phone_number">
                            Phone Number
                        </label>
                        <input type="text" class="form-control" id="phone_number" wire:model="phoneNumber" onfocus="this.value=''">
                    </div>

                    <div class="form-group mb-5">
                        <label for="profession">
                            Profession (Optional)
                        </label>
                        <input type="text" class="form-control" id="profession" wire:model="profession" onfocus="this.value=''">
                    </div>

                    <div class="form-group mb-5">
                        <label for="address">
                            Address (Optional)
                        </label>
                        <input type="text" class="form-control" id="address" wire:model="address" onfocus="this.value=''">
                    </div>

                    <!-- Submit -->
                    <button class="btn btn-block btn-primary" type="submit">
                        Enroll
                    </button>

                </form>

            </div>
        </div>
    </div>
</div>
