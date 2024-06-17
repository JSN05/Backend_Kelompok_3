<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Poster</title>
    <link rel="icon" href="{{ asset('images/Poster.png') }}">
    @vite(['resources/css/welcome.css', 'resources/js/app.js'])
</head>

<body>
    <div class="poster-container">
        <img src="{{ asset('images/Poster.png') }}" alt="Poster Logo" class="poster-image">
    </div>
    <div class="content">
        <div>
            <h1 class="title">Welcome to Poster</h1>
        </div>
        <div class="button-container">
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/home') }}" class="button button-home">Home</a>
                @else
                    <p class="subtitle">Log in and see what’s happening now</p>
                    <a href="{{ route('login') }}" class="button button-login">Log in</a>
                    @if (Route::has('register'))
                        <p class="subtitle">Register and start sharing your story</p>
                        <a href="{{ route('register') }}" class="button button-register">Register</a>
                    @endif
                @endauth
            @endif
        </div>
    </div>
</body>

</html>
