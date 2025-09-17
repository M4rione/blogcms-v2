<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-4">Edit Post</h1>

    <form wire:submit.prevent="update" class="space-y-4">
        <div>
            <label class="block mb-1">Title</label>
            <input type="text" wire:model="post.title" class="w-full border p-2 rounded">
            @error('post.title')<div class="text-red-600 text-sm">{{ $message }}</div>@enderror
        </div>

        <div>
            <label class="block mb-1">Content</label>
            <textarea wire:model="post.content" rows="8" class="w-full border p-2 rounded"></textarea>
            @error('post.content')<div class="text-red-600 text-sm">{{ $message }}</div>@enderror
        </div>

        <div>
            <label class="block mb-1">Category</label>
            <select wire:model="post.category_id" class="w-full border p-2 rounded">
                <option value="">-- choose --</option>
                @foreach($categories as $c)
                <option value="{{ $c->id }}">{{ $c->name }}</option>
                @endforeach
            </select>
            @error('post.category_id')<div class="text-red-600 text-sm">{{ $message }}</div>@enderror
        </div>

        <div>
            <label class="block mb-1">Tags</label>
            <div class="flex flex-wrap gap-2">
                @foreach($tags as $t)
                    <label class="inline-flex items-center gap-1">
                        <input type="checkbox" wire:model="tag_ids" value="{{ $t->id }}">
                        <span>{{ $t->name }}</span>
                    </label>
                @endforeach
            </div>
        </div>

        <div>
            <label class="block mb-1">Replace Image (optional)</label>
            <input type="file" wire:model="image" class="w-full">
            @error('image')<div class="text-red-600 text-sm">{{ $message }}</div>@enderror
            @if($post->image)
                <div class="mt-2 text-sm text-gray-600">Current: {{ $post->image }}</div>
            @endif
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Update</button>
    </form>
</div>
