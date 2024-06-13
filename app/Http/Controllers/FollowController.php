<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;

//13 06 2024 Michael, controller untuk fitur follow
class FollowController extends Controller
{
    public function follow($id)
    {
        $user = User::findOrFail($id);

        if (!Auth::user()->following()->where('user_id', $id)->exists()) {
            Auth::user()->following()->attach($id);
        }

        return redirect()->back();
    }

    public function unfollow($id)
    {
        $user = User::findOrFail($id);

        if (Auth::user()->following()->where('user_id', $id)->exists()) {
            Auth::user()->following()->detach($id);
        }

        return redirect()->back();
    }
}
