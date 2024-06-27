<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

use App\Models\Post;
use App\Models\User;
use Response;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        // Get the currently authenticated user
        $user = $request->user();

        // Query posts where the username matches the user's email
        $posts = Post::where('username', $user->email)
            ->orderBy('created_at', 'desc')
            ->get();

        // Pass both user and posts to the view
        return view('profile.edit', [
            'user' => $user,
            'posts' => $posts,
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();
        $oldEmail = $user->email;
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        
        if ($user->isDirty('email')) {
            Post::where('username', $oldEmail)
                ->update(['username' => $user->email]);
        }

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();
        Post::where('username', $user->email)->delete();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    /**
     * Visit other user's profile
     * 13 06 2024 Michael, membuat fungsi visit profil start
     */
    public function visit($id)
    {
        // Get currently authenticated user
        $currentUser = Auth::user();

        // Get the user to be visited
        $user = User::findOrFail($id);

        // Check if the current user is trying to visit their own profile
        if ($currentUser->id === $user->id) {
            return Redirect::to('/profile');
        }

        // Query posts where the username matches the user's email
        $posts = Post::where('username', $user->email)
            ->orderBy('created_at', 'desc')
            ->get();

        // Pass both user and posts to the view
        return view('profile.visit', [
            'user' => $user,
            'posts' => $posts,
        ]);
    }
    //13 06 2024 Michael, membuat fungsi visit profil end
}
