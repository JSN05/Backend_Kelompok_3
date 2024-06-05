<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <img src="https://png.pngtree.com/templates/20180829/letter-p-and-lightning-bolt-logo-design-template-png_30063.jpg"
        width="100" height="100">
    <h1>Welcome to Poster</h1>

    @if (Route::has('login'))
        @auth
            <a href="{{ url('/home') }}">Home</a>
        @else
            <a href="{{ route('login') }}">Log in</a>
            @if (Route::has('register'))
                <a href="{{ route('register') }}"> Register</a>
            @endif
        @endauth
    @endif

</body>

</html>