<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function store(Request $request, Post $post)
    {
        $existingLike = $post->likes()->where('user_id', $request->user()->id)->first();

        if ($existingLike) {
            $existingLike->delete();
            $post->decrement('likes_count');
        } else {
            $like = new Like();
            $like->user_id = $request->user()->id;
            $like->post_id = $post->id;
            $like->save();
            $post->increment('likes_count');
        }

        return back();
    }

    public function destroy(Request $request, Post $post)
    {
        $existingLike = $post->likes()->where('user_id', $request->user()->id)->first();

        if ($existingLike) {
            $existingLike->delete();
            $post->decrement('likes_count');
        }

        return back();
    }
}
