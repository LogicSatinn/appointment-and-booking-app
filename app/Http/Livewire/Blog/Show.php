<?php

namespace App\Http\Livewire\Blog;

use App\View\Components\Client\MasterLayout;
use Livewire\Component;
use Stephenjude\FilamentBlog\Models\Post;

class Show extends Component
{
    public Post $post;

    public function mount(Post $post)
    {
        $this->post = $post->load('author', 'category');
    }

    public function render()
    {
        return view('livewire.blog.show')
            ->layout(MasterLayout::class);
    }
}
