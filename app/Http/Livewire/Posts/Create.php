<?php

namespace App\Http\Livewire\Posts;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Support\Facades\Auth;


class Create extends Component
{
    use WithFileUploads;

    public string $title = '';
    public string $content = '';
    public ?int $category_id = null;
    public array $tag_ids = [];
    public $image; // temp upload

    protected function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'tag_ids' => 'array',
            'tag_ids.*' => 'exists:tags,id',
            'image' => 'nullable|image|max:2048',
        ];
    }

    protected $messages = [
        'title.required' => 'The title is required.',
        'content.required' => 'Content cannot be empty.',
        'category_id.required' => 'Please select a category.',
        'tag_ids.*.exists' => 'Invalid tag selected.',
        'image.image' => 'The file must be an image.',
    ];


    public function save()
    {
        $this->validate();

        $post = new Post();
        $post->title = $this->title;
        $post->content = $this->content;
        $post->category_id = $this->category_id;
        $post->user_id = Auth::check() ? Auth::id() : null;


        if ($this->image) {
            $path = $this->image->store('thumbnails', 'public');
            $post->image = $path;
        }

        $post->save();
        $post->tags()->sync($this->tag_ids);

        session()->flash('success', 'Post created.');
        return redirect()->route('posts.index');
    }

    public function render()
    {
        return view('livewire.posts.create', [
            'categories' => Category::orderBy('name')->get(),
            'tags' => Tag::orderBy('name')->get(),
        ]);
    }
}
