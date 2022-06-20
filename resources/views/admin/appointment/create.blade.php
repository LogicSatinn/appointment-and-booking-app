@section('title', 'Create Appointment')

<x-admin.master-layout>
    <div class="content">
        <h2 class="content-heading">
            Create New Appointment
        </h2>

        <div class="block block-rounded block-bordered">
            <div class="block-content">
                <form action="{{ route('appointments.store') }}" method="POST">
                    @csrf
                    <div class="row push">

                        <div class="form-group col-lg-6">
                            <label for="skill">Skill</label>
                            <select class="form-control" id="skill" name="skill_id">
                                @foreach($skills as $key => $value)
                                    <option value="{{ $key }}">{{ $value }}</option>
                                @endforeach
                            </select>
                            @error('skill_id')
                            <div class="alert alert-error">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>


                        <div class="form-group col-lg-6">
                            <label for="resource">Resource</label>
                            <select class="form-control" id="resource" name="resource_id">
                                @foreach($resources as $key => $value)
                                    <option value="{{ $key }}">{{ $value }}</option>
                                @endforeach
                            </select>
                            @error('resource_id')
                            <div class="alert alert-error">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group col-lg-8">
                            <label for="">Date Range for this appointment</label>
                            <div class="input-daterange input-group" data-date-format="dd/mm/yyyy" data-week-start="1"
                                 data-autoclose="true" data-today-highlight="true">
                                <input type="text" class="form-control" id="from" name="from" placeholder="From"
                                       data-week-start="1" data-autoclose="true" data-today-highlight="true">
                                <div class="input-group-prepend input-group-append">
                                                    <span class="input-group-text font-w600">
                                                        <i class="fa fa-fw fa-arrow-right"></i>
                                                    </span>
                                </div>
                                <input type="text" class="form-control" id="to" name="to" placeholder="To"
                                       data-week-start="1" data-autoclose="true" data-today-highlight="true">
                            </div>

                            @error('from')
                            <div class="alert alert-error">
                                {{ $message }}
                            </div>
                            @enderror

                            @error('to')
                            <div class="alert alert-error">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>


                        <div class="form-group col-xl-6">
                            <label for="start">Starting Time of the appointment</label>
                            <input type="text" class="js-flatpickr form-control bg-white" id="start" name="start"
                                   data-enable-time="true" data-no-calendar="true" data-date-format="H:i"
                                   data-time_24hr="true">

                            @error('start')
                            <div class="alert alert-error">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>


                        <div class="form-group col-xl-6">
                            <label for="end">End of the Appointment (per day)</label>
                            <input type="text" class="js-flatpickr form-control bg-white" id="end" name="end"
                                   data-enable-time="true" data-no-calendar="true" data-date-format="H:i"
                                   data-time_24hr="true">

                            @error('end')
                            <div class="alert alert-error">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group col-lg-6">
                            <label for="price">Price</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        TZS
                                                    </span>
                                </div>
                                <input type="text" class="form-control text-center" id="price" name="price"
                                       placeholder="00">
                                <div class="input-group-append">
                                    <span class="input-group-text">.00</span>
                                </div>
                            </div>
                            @error('price')
                            <div class="alert alert-error">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group col-12">
                            <button class="btn btn-primary" type="submit"> Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('page_css')
        <link rel="stylesheet"
              href="{{ asset('assets/js/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css')}}">
        <link rel="stylesheet" href="{{ asset('assets/js/plugins/flatpickr/flatpickr.min.css')}}">
    @endpush

    @push('page_js')
        <!-- Page JS Plugins -->
        <script src="{{ asset('assets/js/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}"></script>
        <script src="{{ asset('assets/js/plugins/flatpickr/flatpickr.min.js')}}"></script>

        <!-- Page JS Helpers (Flatpickr + BS Datepicker + BS Colorpicker + BS Maxlength + Select2 + Ion Range Slider + Masked Inputs + Password Strength Meter plugins) -->
        <script>jQuery(function () {
                Dashmix.helpers(['flatpickr', 'datepicker']);
            });</script>

    @endpush

</x-admin.master-layout>


