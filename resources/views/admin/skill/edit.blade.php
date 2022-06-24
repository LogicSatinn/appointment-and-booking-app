@section('title', 'Edit Skill')

<x-admin.master-layout>
    <div class="content">
        <h2 class="content-heading">
            Edit {{ $skill->title }}
        </h2>

        <div class="block block-rounded block-bordered">
            <div class="block-content">
                <form action="{{ route('skills.update', $skill) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row push">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" class="form-control" id="title"
                                       name="title" placeholder="{{ $skill->title }}" value="{{ $skill->title }}">
                                @error('title')
                                <div class="alert alert-error">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="category">Category</label>
                                <select class="form-control" id="category" name="category_id">
                                    @foreach($categories as $key => $value)
                                        <option value="{{ $key }}" @selected($skill->category_id == $key)>{{ $value }}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                <div class="alert alert-error">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="skill_cover_photo">Update Skill Cover Photo</label>
                                <input type="file" class="form-control-file" id="skill_cover_photo" name="skill_cover_photo">
                                @error('skill_cover_photo')
                                <div class="alert alert-error">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="js-ckeditor">Description</label>
                                <textarea id="js-ckeditor" value="{{ $skill->description }}" name="description">{{ $skill->description }}</textarea>
                                @error('description')
                                <div class="alert alert-error">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>


                            <div class="form-group">
                                <button class="btn btn-primary" type="submit"> Save</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


    @push('page_js')
        <script src="{{ asset('assets/js/plugins/ckeditor/ckeditor.js')}}"></script>

        <script>jQuery(function () {
                Dashmix.helpers(['ckeditor']);
            });</script>
    @endpush

</x-admin.master-layout>


