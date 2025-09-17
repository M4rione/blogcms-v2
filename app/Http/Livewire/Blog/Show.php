<?php

namespace App\Http\Livewire\Blog;

use Livewire\Component;
use App\Models\Post;

class Show extends Component
{
    public Post $post;

    public function mount(string $slug)
    {
        $this->post = Post::where('slug',$slug)->firstOrFail();
    }

    public function render()
    {
        return view('livewire.blog.show')->layout('components.layouts.app');
    }
}
