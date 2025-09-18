<?php

namespace App\Http\Livewire\Blog;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Post;

class Index extends Component
{
    use WithPagination;

    public string $search = '';

    public function render()
    {
        $posts = Post::query()
            ->when($this->search, fn($q) =>
            $q->where(function ($query) {
                $query->where('title', 'like', "%{$this->search}%")
                    ->orWhere('content', 'like', "%{$this->search}%");
            }))
            ->latest()
            ->paginate(9);

        return view('livewire.blog.index', ['posts' => $posts]);
    }
}