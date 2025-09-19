<?php

namespace App\Http\Livewire\Posts;

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
                    ->orWhereHas('user', fn($u) =>
                    $u->where('name', 'like', "%{$this->search}%"));
            }))
            ->latest()
            ->paginate(10);

        return view('livewire.posts.index', ['posts' => $posts]);
    }
}