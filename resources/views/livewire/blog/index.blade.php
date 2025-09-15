<div class="container mx-auto px-4 py-6">
    <h1 class="text-3xl font-bold mb-6">Blog</h1>

    <input type="text" wire:model.model.debounce.500ms="search" placeholder="Search..."
        class="w-full md:w-1/2 p-2 border rounded mb-6" />

    @if ($posts->count())
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($posts as $post)
                <div class="border rounded-lg p-4 shadow-sm">
                    <h2 class="text-xl font-semibold mb-2">
                        <a href="{{ route('blog.show', $post->slug) }}" class="text-blue-600 hover:underline">
                            {{ $post->title }}
                        </a>
                    </h2>
                    <p class="text-gray-600 text-sm mb-3">
                        {{ \Illuminate\Support\Str::limit(strip_tags($post->content), 120) }}
                    </p>
                    <div class="text-xs text-gray-500">
                        {{ $post->created_at->diffForHumans() }}
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-6">
            {{ $posts->links() }}
        </div>
    @else
        <p class="text-gray-500">No posts found.</p>
    @endif
</div>
