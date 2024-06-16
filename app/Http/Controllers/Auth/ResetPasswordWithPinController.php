<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class ResetPasswordWithPinController extends Controller
{
    /**
     * Display the reset password form.
     */
    public function create()
    {
        return view('auth.reset-password-with-pin');
    }

    /**
     * Handle the reset password request.
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email', 'exists:users,email'],
            'pin' => ['required', 'regex:/^[0-9]{8}$/'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::where('email', $request->email)->where('pin', $request->pin)->first();

        if (!$user) {
            return back()->withErrors(['pin' => __('Invalid PIN.')])->withInput($request->only('email'));
        }

        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('login')->with('status', 'password-reset');
    }
}
