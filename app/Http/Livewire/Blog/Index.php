<?php

namespace App\Http\Livewire\Blog;

use App\View\Components\Client\MasterLayout;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Livewire\Component;
use Stephenjude\FilamentBlog\Models\Category;
use Stephenjude\FilamentBlog\Models\Post;

class Index extends Component
{
    public Collection $posts;

    public Collection $recentPosts;

    public Collection $categories;

    public function mount(): void
    {
        $this->posts = Post::with(['author', 'category'])
            ->inRandomOrder()
            ->published()
            ->get();
        $this->categories = Category::all('id', 'name');
        $this->recentPosts = Post::query()
            ->select('id', 'title', 'banner', 'published_at')
            ->limit(3)
            ->orderByDesc('published_at')
            ->get();
    }

    public function filterUsingCategory($categoryId): void
    {
        $this->posts = Post::query()
            ->with(['author', 'category'])
            ->where('blog_category_id', $categoryId)
            ->published()
            ->latest()
            ->get();
        $this->recentPosts = Post::query()
            ->where('blog_category_id', $categoryId)
            ->select('id', 'title', 'banner', 'published_at')
            ->limit(3)
            ->orderByDesc('published_at')
            ->get();
    }

    public function render(): Factory|View|Application
    {
        return view('livewire.blog.index')
            ->layout(MasterLayout::class);
    }
}
