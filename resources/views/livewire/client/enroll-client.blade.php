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
                            Timetable
                        </a>
                    </li>
                    <li class="breadcrumb-item">
                        <a class="text-gray-800" href="{{ route('timetableDetails', $timetable) }}">
                            {{ $timetable->title }}
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
                        <input type="text" class="form-control" id="name" wire:model.lazy="name" onfocus="this.value=''">
                        @error('name')
                            <span class="alert alert-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="form-group mb-5">
                        <label for="email">
                            Email
                        </label>
                        <input type="email" class="form-control" id="email" wire:model.lazy="email" onfocus="this.value=''">
                        @error('email')
                            <span class="alert alert-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group mb-5">
                        <label for="phone_number">
                            Phone Number
                        </label>
                        <input type="text" class="form-control" id="phone_number" wire:model.lazy="phoneNumber" onfocus="this.value=''">
                        @error('phoneNumber')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group mb-5">
                        <label for="profession">
                            Profession (Optional)
                        </label>
                        <input type="text" class="form-control" id="profession" wire:model.lazy="profession" onfocus="this.value=''">
                        @error('profession')
                            <span class="alert alert-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group mb-5">
                        <label for="address">
                            Address (Optional)
                        </label>
                        <input type="text" class="form-control" id="address" wire:model.lazy="address" onfocus="this.value=''">
                        @error('address')
                            <span class="alert alert-error">{{ $message }}</span>
                        @enderror
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
