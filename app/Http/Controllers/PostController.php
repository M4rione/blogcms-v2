<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function update(Request $request, Post $post)
    {
        $data = $request->validate([
            'title'       => 'required|string|max:255',
            'content'     => 'required|string',
            'category_id' => 'required|exists:categories,id',
        ]);

        $post->update($data);
        return redirect()->route('posts.index')->with('success','Post updated.');
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return back()->with('success','Post deleted.');
    }
}
