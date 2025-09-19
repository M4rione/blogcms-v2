<?php

namespace App\Http\Livewire\Posts;

use Illuminate\Support\Facades\Storage;
use App\Models\Tag;
use App\Models\Post;
use Livewire\Component;
use App\Models\Category;
use Livewire\WithFileUploads;

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

    protected $messages = [
        'post.title.required' => 'The title is required.',
        'post.content.required' => 'Content cannot be empty.',
        'post.category_id.required' => 'Please select a category.',
        'tag_ids.*.exists' => 'Invalid tag selected.',
        'image.image' => 'The file must be an image.',
    ];


    public function mount(Post $post)
    {
        $this->post = $post->load('tags');
        $this->tag_ids = $this->post->tags->pluck('id')->all();
    }

    public function update()
    {
        $this->validate();

        if ($this->image) {
            if ($this->post->image && Storage::disk('public')->exists($this->post->image)) {
                Storage::disk('public')->delete($this->post->image);
            }
            $this->post->image = $this->image->store('thumbnails', 'public');
        }


        $this->post->save();
        $this->post->tags()->sync($this->tag_ids);

        session()->flash('success', 'Post updated.');
        return redirect()->route('posts.index');
    }

    public function render()
    {
        return view('livewire.posts.edit', [
            'categories' => Category::orderBy('name')->get(),
            'tags' => Tag::orderBy('name')->get(),
        ]);
    }
}