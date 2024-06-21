<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Posting Text | Poster</title>
    <link rel="icon" href="{{ asset('images/Poster.png') }}">
    @vite(['resources/css/post.css', 'resources/js/app.js'])
</head>

<body>
    <div class="container">
        <h1>Write and Share, Post Here!</h1>

        @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
        @endif

        <form method="post" action="">
            @csrf
            @method('post')
            <label for="text">Text</label>
            <textarea name="text" id="text" maxlength="300" oninput="updateCharCounter()"></textarea>
            <div class="char-counter" id="char-counter">0/300</div>
            <button type="submit">Post</button>
        </form>
    </div>

</body>

</html>