<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-4">New Post</h1>

    <form wire:submit.prevent="save" class="space-y-4">
        <div>
            <label class="block mb-1">Title</label>
            <input type="text" wire:model="title" class="w-full border p-2 rounded">
            @error('title')<div class="text-red-600 text-sm">{{ $message }}</div> @enderror
        </div>

        <div>
            <label class="block mb-1">Content</label>
            <textarea wire:model="content" rows="8" class="w-full border p-2 rounded"></textarea>
            @error('content')<div class="text-red-600 text-sm">{{ $message }}</div>@enderror
        </div>

        <div>
            <label class="block mb-1">Category</label>
            <select wire:model="category_id" class="w-full border p-2 rounded">
                <option value="">-- choose --</option>
                @foreach($categories as $c)
                <option value="{{ $c->id }}">{{ $c->name }}</option>
                @endforeach
            </select>
            @error('category_id')<div class="text-red-600 text-sm">{{ $message }}</div>@enderror
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
            @error('tag_ids.*')<div class="text-red-600 text-sm">{{ $message }}</div>@enderror
        </div>

        <div>
            <label class="block mb-1">Image (optional)</label>
            <input type="file" wire:model="image" class="w-full">
            @error('image')<div class="text-red-600 text-sm">{{ $message }}</div>@enderror
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Save</button>
    </form>
</div>
