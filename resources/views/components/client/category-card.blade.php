@props(['category'])

<div class="col mb-md-6 mb-4 px-2 px-md-4" data-aos="fade-up" data-aos-delay="50">
    <!-- Card -->
    <div class="card icon-category border shadow-dark p-md-5 p-3 text-center lift">
        <!-- Footer -->
        <div class="card-footer px-0 pb-0 pt-3">
            <h5 class="mb-0 line-clamp-1">{{ $category->name }}</h5>
            @isset($category->skills_count)
            <p class="mb-0 line-clamp-1">Over {{ $category->skills_count }} Courses</p>
            @endisset
        </div>
    </div>
</div>
