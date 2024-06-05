<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Post something!</h1>

    <div>
        @if ($errors->any())
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        @endif
    </div>

    <form method="post" action="">
        @csrf
        @method('post')
        <label>Text:</label>
        <textarea name="text"></textarea>
        <button type="submit">Post</button>
    </form>
</body>

</html>