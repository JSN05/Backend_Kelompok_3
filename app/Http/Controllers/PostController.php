<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'text' => 'required',
        ]);

        $post = new Post;
        $post->username = $request->user()->email;
        $post->text = $request->text;
        $post->save();

        return redirect(route('home'));
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();

        return redirect()->route('home')->with('success', 'Post deleted successfully');
    }

   
    public function visit($id)
    {
        // Ambil data postingan berdasarkan ID
        $post = Post::findOrFail($id);

        // Ambil user yang memiliki postingan ini
        $user = $post->user;

        // Kirim data user dan post ke view 'post.visit-post'
        return view('posts.visit-post', [
            'username' => $user,
            'post' => $post,
        ]);
    
}
}
