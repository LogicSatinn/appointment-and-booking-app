@section('title', 'Appointments')

<x-admin.master-layout>
    <div class="content">
        <h2 class="content-heading">
            Appointments
        </h2>

        <!-- Hover Table -->
        <div class="block block-rounded block-bordered">
            <div class="block-header block-header-default">
                <h3 class="block-title">Appointments Table</h3>
                <a href="{{ route('appointments.create') }}" class="btn btn-primary">
                    Create Appointment
                </a>
            </div>
            <div class="block-content">
                <table class="table table-hover table-vcenter">
                    <thead>
                    <tr>
                        <th class="text-center" style="width: 50px;">#</th>
                        <th>Title</th>
                        <th>Skill</th>
                        <th>Resource Assigned</th>
                        <th>From-To</th>
                        <th>Start-End</th>
                        <th>Status</th>
                        <th>Price</th>
                        <th class="text-center" style="width: 100px;">Actions</th>
                    </tr>
                    </thead>
                    @php $i=1 @endphp
                    <tbody>
                    @foreach($appointments as $appointment)
                        <tr>
                            <th class="text-center" scope="row">{{ $i++ }}</th>
                            <td class="font-w600">
                                {{ $appointment->title }}
                            </td>
                            <td class="font-w600">
                                {{ $appointment->skill->title }}
                            </td>
                            <td class="font-w600">
                                {{ $appointment->resource->name }}
                            </td>
                            <td class="font-w600">
                                {{ $appointment->from }} - {{ $appointment->to }}
                            </td>
                            <td class="font-w600">
                                {{ $appointment->start }} - {{ $appointment->end }}
                            </td>
                            <td class="font-w600">
                                {{ $appointment->status }}
                            </td>
                            <td class="font-w600">
                                {{ $appointment->price }}
                            </td>
                            <td class="text-center">
                                <form action="{{ route('appointments.destroy', $appointment) }}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <div class="btn-group">
{{--                                        <a href="{{ route('appointments.show', $appointment) }}" class="btn btn-sm btn-primary" data-toggle="tooltip"--}}
{{--                                           title="View">--}}
{{--                                            <i class="fa fa-eye-alt"></i>--}}
{{--                                        </a>--}}
                                        <a href="{{ route('appointments.edit', $appointment) }}" class="btn btn-sm btn-primary" data-toggle="tooltip"
                                           title="Edit">
                                            <i class="fa fa-pencil-alt"></i>
                                        </a>
                                        <button type="submit" class="btn btn-sm btn-primary" data-toggle="tooltip"
                                                title="Delete">
                                            <i class="fa fa-times"></i>
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
