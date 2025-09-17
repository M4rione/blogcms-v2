<?php

namespace App\Http\Livewire\Posts;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;

class Edit extends Component
{
    use WithFileUploads;

    public Post $post;
    public $image; // new upload (optional)
    public array $tag_ids = [];

    protected function rules(): array
    {
        return [
            'post.title' => 'required|string|max:255',
            'post.content' => 'required|string',
            'post.category_id' => 'required|exists:categories,id',
            'tag_ids' => 'array',
            'tag_ids.*' => 'exists:tags,id',
            'image' => 'nullable|image|max:2048',
        ];
    }

    public function mount(Post $post)
    {
        $this->post = $post->load('tags');
        $this->tag_ids = $this->post->tags->pluck('id')->all();
    }

    public function update()
    {
        $this->validate();

        if ($this->image) {
            $path = $this->image->store('thumbnails','public');
            $this->post->image = $path;
        }

        $this->post->save();
        $this->post->tags()->sync($this->tag_ids);

        session()->flash('success','Post updated.');
        return redirect()->route('posts.index');
    }

    public function render()
    {
        return view('livewire.posts.edit', [
            'categories' => Category::orderBy('name')->get(),
            'tags' => Tag::orderBy('name')->get(),
        ])->layout('components.layouts.app');
    }
}