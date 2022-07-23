@section('title', $timetable->title)

<x-admin.master-layout>
    <!-- Hero -->
    <div class="bg-dark bg-image" style="background-image: url('{{ asset('nia-lab.jpeg')}}');">
        <div class="bg-black-75">
            <div class="content content-full content-top">
                <div class="py-4 text-center">
                    <h1 class="font-w700 text-white mb-2">
                        {{ $timetable->title }}
                    </h1>
                    <h2 class="h3 font-w400 text-white-75">
                    </h2>

                    <form action="{{ route('timetables.destroy', $timetable) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <a class="btn btn-hero-secondary" href="{{ route('timetables.edit', $timetable) }}"
                           data-toggle="click-ripple">
                            <i class="fa fa-pen mr-1"></i> Edit
                        </a>
                        <button type="submit" class="btn btn-hero-danger" href="javascript:void(0)"
                                data-toggle="click-ripple">
                            <i class="fa fa-trash mr-1"></i> Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- END Hero -->

    <!-- Page Content -->
    <div class="content content-boxed">
        <!-- Meta -->
        <div class="row row-deck">
            <div class="col-md-12">
                <a class="block block-rounded block-bordered block-link-shadow" href="javascript:void(0)">
                    <div class="block-content block-content-full text-center">
                        <table class="table table-borderless table-striped">
                            <tbody>
                            <tr>
                                <td class="text-left">
                                    Duration:
                                </td>
                                <td>
                                    {{ $timetable->duration }}
                                </td>
                            </tr>
                            <tr>
                                <td class="text-left">
                                    From - To:
                                </td>
                                <td>
                                    {{ $timetable->from }} - {{ $timetable->to }}
                                </td>
                            </tr>
                            <tr>
                                <td class="text-left">
                                    Hours ( 24-hour Format ):
                                </td>
                                <td>
                                    {{ $timetable->start }} - {{ $timetable->end }}
                                </td>
                            </tr>
                            <tr>
                                <td class="text-left">
                                    Price:
                                </td>
                                <td>
                                    {{ $timetable->representablePrice }}
                                </td>
                            </tr>
                            <tr>
                                <td class="text-left">
                                    Allocated Resource:
                                </td>
                                <td>
                                    {{ $timetable->resource->name }}
                                </td>
                            </tr>
                            <tr>
                                <td class="text-left">
                                    Level:
                                </td>
                                <td>
                                    {{ $timetable->level->value }}
                                </td>
                            </tr>
                            <tr>
                                <td class="text-left">
                                    Status:
                                </td>
                                <td>
                                    {{ $timetable->status }}
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </a>
            </div>
        </div>

        <div class="block block-rounded block-bordered">
            <h4 class="block-header">
                Clients Enrolled for {{ $timetable->title }}
            </h4>
            <div class="block-content">
                <table class="table table-hover table-vcenter">
                    <thead>
                    <tr>
                        <th class="text-center" style="width: 50px;">#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone Number</th>
                        <th>Profession</th>
                        <th>Address</th>
                    </tr>
                    </thead>
                    @php $i=1 @endphp
                    <tbody>
                    @foreach($timetable->clients as $client)
                        <tr>
                            <th class="text-center" scope="row">{{ $i++ }}</th>
                            <td class="font-w600">
                                {{ $client->name }}
                            </td>
                            <td class="font-w600">
                                {{ $client->email }}
                            </td>
                            <td class="font-w600">
                                {{ $client->phone_number }}
                            </td>
                            <td class="font-w600">
                                {{ $client->profession ?? 'N/A' }}
                            </td>
                            <td class="font-w600">
                                {{ $client->Address ?? 'N/A' }}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="block block-rounded block-bordered">
            <h4 class="block-header">
                Bookings Made for {{ $timetable->title }}
            </h4>
            <div class="block-content">
                <table class="table table-hover table-vcenter">
                    <thead>
                    <tr>
                        <th class="text-center" style="width: 50px;">#</th>
                        <th>Reference No.</th>
                        <th>Client Name</th>
                        <th>Booking Method</th>
                        <th>No of Seats</th>
                        <th>Total Amount (TZS)</th>
                        <th>Paid Amount (TZS)</th>
                        <th>Due Amount (TZS)</th>
                        <th>Status</th>
                    </tr>
                    </thead>
                    @php $i=1 @endphp
                    <tbody>
                    @foreach($timetable->bookings as $booking)
                        <tr>
                            <th class="text-center" scope="row">{{ $i++ }}</th>
                            <td class="font-w600">
                                {{ $booking->reference_code }}
                            </td>
                            <td class="font-w600">
                                {{ $booking->client->name }}
                            </td>
                            <td class="font-w600">
                                {{ $booking->booking_method->value }}
                            </td>
                            <td class="font-w600">
                                {{ $booking->reservations()->count() }}
                            </td>
                            <td class="font-w600">
                                {{ number_format($booking->total_amount) }}
                            </td>
                            <td class="font-w600">
                                {{ number_format($booking->paid_amount) }}
                            </td>
                            <td class="font-w600">
                                {{ number_format($booking->due_amount) }}
                            </td>
                            <td class="font-w600">
                                {{ $booking->status }}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>


</x-admin.master-layout>
