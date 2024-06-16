<!-- resources/views/auth/reset-password-with-pin.blade.php -->
<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('Forgot your password? No problem, just enter your email address, your PIN, and your new password and confirm to reset your password.') }}
    </div>

    <form method="POST" action="{{ route('password.reset.with.pin') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- PIN -->
        <div class="mt-4">
            <x-input-label for="pin" :value="__('PIN')" />
            <p class="text-xs text-gray-500 mb-1">Enter the 8 digit number when you <b>register</b>.</p>
            <x-text-input id="pin" class="block mt-1 w-full" maxlength="8" type="text" name="pin" required />
            <x-input-error :messages="$errors->get('pin')" class="mt-2" />
        </div>

        <!-- New Password -->
        <div class="mt-4 relative">
            <x-input-label for="new_password" :value="__('New Password')" />
            <x-text-input id="new_password" class="block mt-1 w-full pr-10" type="password" name="new_password" required />
            <button type="button" onclick="togglePasswordVisibility('new_password')" class="absolute inset-y-0 right-0 pr-3 flex items-center text-sm leading-5 mt-6" tabindex="-1">
                <svg id="new_password-icon" xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                    <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0"/>
                    <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7"/>
                </svg>
            </button>
            <x-input-error :messages="$errors->get('new_password')" class="mt-2" />
        </div>

        <!-- Confirm New Password -->
        <div class="mt-4 relative">
            <x-input-label for="new_password_confirmation" :value="__('Confirm New Password')" />
            <x-text-input id="new_password_confirmation" class="block mt-1 w-full pr-10" type="password" name="new_password_confirmation" required />
            <button type="button" onclick="togglePasswordVisibility('new_password_confirmation')" class="absolute inset-y-0 right-0 pr-3 flex items-center text-sm leading-5 mt-6" tabindex="-1">
                <svg id="new_password_confirmation-icon" xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                    <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0"/>
                    <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7"/>
                </svg>
            </button>
            <x-input-error :messages="$errors->get('new_password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="ms-3 capitalize button-reset-password">
                {{ __('Reset Password') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
