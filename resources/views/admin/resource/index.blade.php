@section('title', 'Resources')

<x-admin.master-layout>
    <div class="content">
        <h2 class="content-heading">
            Resources
        </h2>

        <!-- Hover Table -->
        <div class="block block-rounded block-bordered">
            <div class="block-header block-header-default">
                <h3 class="block-title">Resources Table</h3>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#create-resource">
                    Create Resource
                </button>
            </div>
            <div class="block-content">
                <table class="table table-hover table-vcenter">
                    <thead>
                    <tr>
                        <th class="text-center" style="width: 50px;">#</th>
                        <th>Name</th>
                        <th>Capacity</th>
                        <th>State</th>
                        <th class="text-center" style="width: 100px;">Actions</th>
                    </tr>
                    </thead>
                    @php $i=1 @endphp
                    <tbody>
                    @foreach($resources as $resource)
                        <tr>
                            <th class="text-center" scope="row">{{ $i++ }}</th>
                            <td class="font-w600">
                                {{ $resource->name }}
                            </td>
                            <td class="font-w600">
                                {{ $resource->capacity }}
                            </td>
                            <td class="font-w600">
                                {{ $resource->state }}
                            </td>
                            <td class="text-center">
                                <form action="{{ route('resources.destroy', $resource) }}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#edit-resource{{$resource->id}}"
                                           title="Edit">
                                            <i class="fa fa-pencil-alt"></i>
                                        </button>
                                        <button type="submit" class="btn btn-sm btn-primary" data-toggle="tooltip"
                                                title="Delete">
                                            <i class="fa fa-times"></i>
                                        </button>
                                    </div>
                                </form>
                            </td>
                        </tr>

                        <!-- Large Default Modal -->
                        <div class="modal" id="edit-resource{{$resource->id}}" tabindex="-1" role="dialog" aria-labelledby="edit-resource{{$resource->id}}"
                             aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Edit {{ $resource->name }}</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="{{ route('resources.update', $resource) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-body pb-1">
                                            <div class="form-group">
                                                <label for="name">Name</label>
                                                <input type="text" class="form-control" id="name"
                                                       name="name" value="{{ $resource->name }}">
                                                @error('name')
                                                <div class="alert alert-error">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="capacity">Capacity</label>
                                                <input type="number" class="form-control" id="capacity"
                                                       name="capacity" value="{{ $resource->capacity }}">
                                                @error('capacity')
                                                <div class="alert alert-error">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="note">Note</label>
                                                <textarea class="form-control" id="note" name="note" rows="4"
                                                          placeholder="{{ $resource->note }}"></textarea>
                                            </div>

                                            <input type="hidden" name="added_by">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-sm btn-light" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-sm btn-primary">Done</button>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                        <!-- END Large Default Modal -->
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!-- END Hover Table -->
    </div>


    <!-- Large Default Modal -->
    <div class="modal" id="create-resource" tabindex="-1" role="dialog" aria-labelledby="create-resource"
         aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Create Resource</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('resources.store') }}" method="POST">
                    @csrf
                    <div class="modal-body pb-1">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name"
                                   name="name" placeholder="Name of the Resource">
                            @error('name')
                            <div class="alert alert-error">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="capacity">Capacity</label>
                            <input type="number" class="form-control" id="capacity"
                                   name="capacity" placeholder="Capacity of the Resource">
                            @error('capacity')
                            <div class="alert alert-error">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="note">Note</label>
                            <textarea class="form-control" id="note" name="note" rows="4"
                                      placeholder="Note ..."></textarea>
                        </div>

                        <input type="hidden" name="added_by">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-light" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-sm btn-primary">Done</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <!-- END Large Default Modal -->
</x-admin.master-layout>
