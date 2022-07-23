@section('title', 'Bookings')

<x-admin.master-layout>
    <div class="content">
        <h2 class="content-heading">
            Bookings
        </h2>

        <!-- Hover Table -->
        <div class="block block-rounded block-bordered">
            <div class="block-header block-header-default">
                <h3 class="block-title">Bookings Table</h3>
            </div>
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
                        <th class="text-center" style="width: 100px;">Action</th>
                    </tr>
                    </thead>
                    @php $i=1 @endphp
                    <tbody>
                    @foreach($bookings as $booking)
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
                            <td class="text-center">
                                <form action="{{ route('bookings.destroy', $booking) }}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <div class="btn-group">
                                        <button type="submit" class="btn btn-sm btn-primary" data-toggle="tooltip"
                                                title="Delete">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </div>
                                </form>
                            </td>
                        </tr>

                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!-- END Hover Table -->
    </div>
</x-admin.master-layout>
