@section('title', 'Skills')

<x-admin.master-layout>
    <div class="content">
        <h2 class="content-heading">
            Skills
        </h2>

        <!-- Hover Table -->
        <div class="block block-rounded block-bordered">
            <div class="block-header block-header-default">
                <h3 class="block-title">Skills Table</h3>
                <a href="{{ route('skills.create') }}" class="btn btn-primary">
                    Create Skill
                </a>
            </div>
            <div class="block-content">
                <table class="table table-hover table-vcenter">
                    <thead>
                    <tr>
                        <th class="text-center" style="width: 50px;">#</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th class="d-none d-sm-table-cell" style="width: 15%;">Category</th>
                        <th class="text-center" style="width: 100px;">Actions</th>
                    </tr>
                    </thead>
                    @php $i=1 @endphp
                    <tbody>
                    @foreach($skills as $skill)
                        <tr>
                            <th class="text-center" scope="row">{{ $i++ }}</th>
                            <td class="font-w600">
                                {{ $skill->title }}
                            </td>
                            <td class="font-w600">
                                {{ $skill->status }}
                            </td>
                            <td class="d-none d-sm-table-cell">
                                {{ $skill->category->name }}
                            </td>
                            <td class="text-center">
                                <form action="{{ route('skills.destroy', $skill) }}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <div class="btn-group">
                                        <a href="{{ route('skills.edit', $skill) }}" class="btn btn-sm btn-primary" data-toggle="tooltip"
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
