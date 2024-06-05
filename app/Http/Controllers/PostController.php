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
}
