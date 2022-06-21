@section('title', $skill->title)

<x-admin.master-layout>
    <!-- Hero -->
    <div class="bg-dark bg-image" style="background-image: url('{{ asset('assets/media/photos/photo23@2x.jpg')}}');">
        <div class="bg-black-75">
            <div class="content content-full content-top">
                <div class="py-4 text-center">
                    <h1 class="font-w700 text-white mb-2">
                        {{ $skill->title }}
                    </h1>
                    <h2 class="h3 font-w400 text-white-75">
{{--                        All the tips and tricks you need to know to be a pro--}}
                    </h2>
                    <form action="{{ route('skills.destroy', $skill) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <a class="btn btn-hero-secondary" href="{{ route('skills.edit', $skill) }}" data-toggle="click-ripple">
                            <i class="fa fa-pen mr-1"></i> Edit
                        </a>
                        <button type="submit" class="btn btn-hero-danger" href="javascript:void(0)" data-toggle="click-ripple">
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
            <div class="col-md-8">
                <a class="block block-rounded block-bordered block-link-shadow" href="javascript:void(0)">
                    <div class="block-content block-content-full text-center">
                        {!! $skill->description  !!}
                    </div>
                </a>
            </div>
            <div class="col-md-4">
                <div class="block block-rounded block-bordered block-link-shadow">
                    <div class="block-content">
                        <table class="table table-borderless table-striped">
                            <tbody>
                            <tr>
                                <td>
                                    Status: {{ $skill->status }}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                   Category: {{ $skill->category->name }}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                  Created On: {{ $skill->created_at->format('d M Y') }}
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- END Meta -->

        <!-- Lessons -->
        <div class="block block-rounded block-bordered">
            <h4 class="block-header">
                Appointments for {{ $skill->title }}
            </h4>
            <div class="block-content">
                <table class="table table-hover table-vcenter">
                    <thead>
                    <tr>
                        <th class="text-center" style="width: 50px;">#</th>
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
        <!-- END Lessons -->
    </div>
    <!-- END Page Content -->
</x-admin.master-layout>
