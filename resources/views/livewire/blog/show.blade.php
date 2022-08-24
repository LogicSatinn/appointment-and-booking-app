@section('title', 'Title of the Blog')

<div>
    <!-- BLOG-SINGLE
    ================================================== -->
    <div class="container py-8 pt-lg-11">
        <div class="row">
            <div class="col-xl-8 mx-auto">
                <h1 class="text-capitalize">{{ $post->title }}</h1>

                <p class="me-xl-12">{{ $post->excerpt }}</p>

                <div class="d-md-flex align-items-center">
                    <div class="border rounded-circle d-inline-block mb-4 mb-md-0 me-4">
                        <div class="p-1">
                            <img src="{{ asset('storage/' . $post->author->photo) }}" alt="{{ $post->author->name }}"
                                 class="rounded-circle" width="52" height="52">
                        </div>
                    </div>

                    <div class="mb-4 mb-md-0">
                        <a href="#" class="d-block"><h6 class="mb-0">{{ $post->author->name }}</h6></a>
                        <span class="font-size-sm">{{ $post->published_at->format('F d, Y') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="mb-8 sk-thumbnail img-ratio-7">
        <img src="{{ $post->banner_url }}" alt="..." class="img-fluid">
    </div>

    <div class="container">
        <div class="row mb-8 mb-md-12">
            <div class="col-xl-8 mx-auto">
                <h3 class="">{{ $post->category->name }}</h3>
                <p class="mb-6 line-height-md">{!! $post->content !!}</p>
            </div>
        </div>
    </div>
</div>
