<div class="container mx-auto px-4 py-6">
    <a href="{{ route('blog.index') }}" class="text-blue-600 hover:underline">&larr; Back</a>
    <h1 class="text-3xl font-bold mt-2 mb-4">{{ $post->title }}</h1>
    <div class="text-sm text-gray-500 mb-4">
        Category: {{ $post->category->name }} • by {{ $post->author->name }} • {{ $post->created_at->toFormattedDateString() }}
    </div>
    <article class="prose max-w-none">
        {!! nl2br(e($post->content)) !!}
    </article>
    @if($post->tags->count())
        <div class="mt-6 text-sm">
            <span class="font-semibold mr-2">Tags:</span>
            @foreach($post->tags as $tag)
                <span class="inline-block bg-gray-100 px-2 py-1 mr-2 mb-2 rounded">{{ $tag->name }}</span>
            @endforeach
        </div>
    @endif
</div>
