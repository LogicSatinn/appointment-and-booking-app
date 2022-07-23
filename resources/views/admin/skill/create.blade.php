@section('title', 'Create Skill')

<x-admin.master-layout>
    <div class="content">
        <h2 class="content-heading">
            Create New Skill
        </h2>

        <div class="block block-rounded block-bordered">
            <div class="block-content">
                <form action="{{ route('skills.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row push">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" class="form-control" id="title"
                                       name="title" placeholder="Title">
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
                                        <option value="{{ $key }}">{{ $value }}</option>
                                    @endforeach
                                </select>
                                @error('category')
                                <div class="alert alert-error">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="level">Level</label>
                                <select class="form-control" id="level" name="level">
                                        <option value="{{ \App\Enums\SkillLevel::BEGINNER->value }}">{{ \App\Enums\SkillLevel::BEGINNER->value }}</option>
                                        <option value="{{ \App\Enums\SkillLevel::INTERMEDIATE->value }}">{{ \App\Enums\SkillLevel::INTERMEDIATE->value }}</option>
                                        <option value="{{ \App\Enums\SkillLevel::ADVANCED->value }}">{{ \App\Enums\SkillLevel::ADVANCED->value }}</option>
                                </select>
                                @error('level')
                                <div class="alert alert-error">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="skill_cover_photo">Skill Cover Photo</label>
                                <input type="file" class="form-control-file" id="skill_cover_photo" name="skill_cover_photo">
                                @error('skill_cover_photo')
                                <div class="alert alert-error">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="js-ckeditor">Description</label>
                                <textarea id="js-ckeditor" name="description">Anything or everything about this skill ...</textarea>
                                @error('description')
                                <div class="alert alert-error">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="js-ckeditor">Mode of Delivery</label>
                                <textarea id="js-ckeditor" name="mode_of_delivery">Anything or everything on the mode of delivery ...</textarea>
                                @error('mode_of_delivery')
                                <div class="alert alert-error">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="js-ckeditor">Prerequisite</label>
                                <textarea id="js-ckeditor" name="prerequisite">Anything or everything on the prerequisite ...</textarea>
                                @error('prerequisite')
                                <div class="alert alert-error">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="js-ckeditor">Suitable For</label>
                                <textarea id="js-ckeditor" name="suitable_for">Suitable For ...</textarea>
                                @error('suitable_for')
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


