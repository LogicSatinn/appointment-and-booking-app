<?php

namespace App\Http\Livewire\Blog;

use App\View\Components\Client\MasterLayout;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Stephenjude\FilamentBlog\Models\Post;

class Show extends Component
{
    public Post $post;

    public function mount(Post $post): void
    {
        $this->post = $post->load('author', 'category');
    }

    public function render(): Factory|View|Application
    {
        return view('livewire.blog.show')
            ->layout(MasterLayout::class);
    }
}
