@section('title', 'Timetables')

<x-admin.master-layout>
    <div class="content">
        <h2 class="content-heading">
            Timetables
        </h2>

        <!-- Hover Table -->
        <div class="block block-rounded block-bordered">
            <div class="block-header block-header-default">
                <h3 class="block-title">Timetables Table</h3>
                <a href="{{ route('timetables.create') }}" class="btn btn-primary">
                    Create Timetable
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
                    @foreach($timetables as $timetable)
                        <tr>
                            <th class="text-center" scope="row">{{ $i++ }}</th>
                            <td class="font-w600">
                                {{ $timetable->title }}
                            </td>
                            <td class="font-w600">
                                {{ $timetable->skill->title }}
                            </td>
                            <td class="font-w600">
                                {{ $timetable->resource->name }}
                            </td>
                            <td class="font-w600">
                                {{ $timetable->from }} - {{ $timetable->to }}
                            </td>
                            <td class="font-w600">
                                {{ $timetable->start }} - {{ $timetable->end }}
                            </td>
                            <td class="font-w600">
                                {{ $timetable->status }}
                            </td>
                            <td class="font-w600">
                                {{ $timetable->representablePrice }}
                            </td>
                            <td class="text-center">
                                <form action="{{ route('timetables.destroy', $timetable) }}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <div class="btn-group">
                                        <a href="{{ route('timetables.show', $timetable) }}" class="btn btn-sm btn-primary" data-toggle="tooltip"
                                           title="View">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        <a href="{{ route('timetables.edit', $timetable) }}" class="btn btn-sm btn-primary" data-toggle="tooltip"
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
