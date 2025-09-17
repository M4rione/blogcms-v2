<div>
    <div class="flex justify-between mb-4">
        <h1 class="text-2xl font-bold">Posts</h1>
        <a href="{{ route('posts.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded">
            + New Post
        </a>
    </div>

    <table class="w-full border border-gray-200">
        <thead>
            <tr class="bg-gray-100">
                <th class="px-4 py-2 text-left">Title</th>
                <th class="px-4 py-2">Author</th>
                <th class="px-4 py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($posts as $post)
                <tr>
                    <td class="px-4 py-2">{{ $post->title }}</td>
                    <td class="px-4 py-2">{{ $post->user->name ?? 'Unknown' }}</td>
                    <td class="px-4 py-2">
                        <a href="{{ route('posts.edit', $post) }}" class="text-blue-600">Edit</a>
                        <form action="{{ route('posts.destroy', $post) }}" method="POST" class="inline-block"
                            onsubmit="return confirm('Delete this post?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 ml-2">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="px-4 py-2 text-center">No posts found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-4">
        {{ $posts->links() }}
    </div>
</div>
