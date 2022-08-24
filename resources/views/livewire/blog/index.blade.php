@section('title', 'Blog')

<div>
    <!-- PAGE TITLE
    ================================================== -->
    <header class="py-8 py-md-11" style="background-image: none;">
        <div class="container text-center py-xl-2">
            <h1 class="display-4 fw-semi-bold mb-0">Blog</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-scroll justify-content-center">
                    <li class="breadcrumb-item">
                        <a class="text-gray-800" href="#">
                            Home
                        </a>
                    </li>
                    <li class="breadcrumb-item text-gray-800 active" aria-current="page">
                        Blog
                    </li>
                </ol>
            </nav>
        </div>
    </header>

    <!-- BLOG LIST V2
 ================================================== -->
    <div class="container mb-11">
        <div class="row">
            <div class="col-md-5 col-lg-4 col-xl-4">
                <!-- BLOG SIDEBAR
                ================================================== -->
                <div class="">
                    <div class="border rounded mb-6 p-5 py-md-6 ps-md-6 pe-md-4">
                        <h4 class="mb-5">Category</h4>
                        <div class="nav flex-column nav-vertical">
                            @foreach($categories as $category)
                                <a wire:click="filterUsingCategory({{ $category->id }})" class="nav-link py-2">{{ $category->name }}</a>
                            @endforeach
                        </div>
                    </div>

                    <div class="border rounded mb-6 p-5 py-md-6 ps-md-6 pe-md-4">
                        <h4 class="mb-5">Recent Posts</h4>
                        <ul class="list-unstyled mb-0">
                            @foreach($recentPosts as $recentPost)
                                <li class="media mb-6 d-flex">
                                    <a href="#" class="mw-70p d-block me-5">
                                        <img src="{{ asset('/media/' . $recentPost->banner) }}"
                                             alt="{{ $recentPost->title }}" class="avatar-img rounded-lg h-70p o-f-c">
                                    </a>
                                    <div class="media-body flex-shrink-1">
                                        <a href="#" class="d-block">
                                            <h6 class="line-clamp-2 mb-1 fw-normal">{{ Str::limit($recentPost->title, 30) }}</h6>
                                        </a>
                                        <span>{{ $recentPost->published_at?->format('F d, Y') }}</span>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                </div>
            </div>


            <div class="col-md-7 col-lg-8 col-xl-8 mb-5 mb-md-0">
                <!-- Blog Post -->
                @foreach($posts as $post)
                    <div class="card border rounded shadow lift mb-6 p-2">
                        <!-- Imgae -->
                        <div class="card-zoom">
                            <a href="#" class="card-img d-block sk-thumbnail img-ratio-5 rounded">
                                <img src="{{ asset($post->banner_url) }}" alt="{{ $post->title }}"
                                     class="rounded img-fluid">
                            </a>
                        </div>

                        <!-- Footer -->
                        <div class="card-footer p-4 p-md-5">
                            <h5 class="text-blue">{{ $post->category->name }}</h5>

                            <a href="#" class="d-block me-xl-12">
                                <h3 class="">{{ $post->title }}</h3>
                            </a>

                            <p class="line-clamp-3 me-xl-5">{!! Str::limit($post->content) !!}</p>

                            <div class="d-md-flex align-items-center">
                                <div class="border rounded-circle d-inline-block mb-4 mb-md-0 me-4">
                                    <div class="p-1">
                                        <img src="{{ asset('storage/' . $post->author->photo) }}" alt="..."
                                             class="rounded-circle"
                                             width="52" height="52">
                                    </div>
                                </div>

                                <div class="mb-4 mb-md-0">
                                    <a href="{{ $post->author->twitter_handle }}" class="d-block">
                                        <h6 class="mb-0">{{ $post->author->name }}</h6>
                                    </a>
                                    <span class="font-size-sm">{{ $post->published_at?->format('F d, Y') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
