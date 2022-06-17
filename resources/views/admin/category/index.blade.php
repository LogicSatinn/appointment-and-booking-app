@section('title', 'Categories')

<x-admin.master-layout>
    <div class="content">
        <h2 class="content-heading">
            Categories
        </h2>


        <!-- Hover Table -->
        <div class="block block-rounded block-bordered">
            <div class="block-header block-header-default">
                <h3 class="block-title">Categories Table</h3>
                <button type="button" class="btn btn-primary push" data-toggle="modal" data-target="#create-category">
                    Create Category
                </button>
            </div>
            <div class="block-content">
                <table class="table table-hover table-vcenter">
                    <thead>
                    <tr>
                        <th class="text-center" style="width: 50px;">#</th>
                        <th>Name</th>
                        <th>Note</th>
                        <th class="d-none d-sm-table-cell" style="width: 15%;">Added By</th>
                        <th class="text-center" style="width: 100px;">Actions</th>
                    </tr>
                    </thead>
                    @php $i=1 @endphp
                    <tbody>
                    @foreach($categories as $category)
                        <tr>
                            <th class="text-center" scope="row">{{ $i++ }}</th>
                            <td class="font-w600">
                                {{ $category->name }}
                            </td>
                            <td class="font-w600">
                                {{ $category->note }}
                            </td>
                            <td class="d-none d-sm-table-cell">
                                {{ $category->addedBy->name }}
                            </td>
                            <td class="text-center">
                                <form action="{{ route('categories.destroy', $category) }}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-primary" data-toggle="modal"
                                                data-target="#edit-category{{ $category->id }}"
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

                        <div class="modal" id="edit-category{{ $category->id }}" tabindex="-1" role="dialog"
                             aria-labelledby="edit-category{{ $category->id }}"
                             aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Edit Category</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="{{ route('categories.update', $category) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-body pb-1">
                                            <div class="form-group">
                                                <label for="name">Name</label>
                                                <input type="text" class="form-control" id="name" name="name"
                                                       placeholder="{{ $category->name }}"
                                                       value="{{ $category->name }}">
                                            </div>

                                            <div class="form-group">
                                                <label for="note">Note</label>
                                                <textarea class="form-control" id="note" name="note" rows="4"
                                                          value="{{ $category->note }}"
                                                          placeholder="{{ $category->note }}"></textarea>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-sm btn-light" data-dismiss="modal">
                                                Close
                                            </button>
                                            <button type="submit" class="btn btn-sm btn-primary">Done</button>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!-- END Hover Table -->
    </div>


    <!-- Large Default Modal -->
    <div class="modal" id="create-category" tabindex="-1" role="dialog" aria-labelledby="create-category"
         aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Create Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('categories.store') }}" method="POST">
                    @csrf
                    <div class="modal-body pb-1">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Name">
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

