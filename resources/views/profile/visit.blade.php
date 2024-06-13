<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$user->name}}'s Profile</title>
</head>
<!-- 13 06 2024 Michael, view untuk visit profil-->

<body>
    <a href="{{ url('/home') }}">Home</a>

    <h1>{{$user->name}}'s Profile</h1>
    <h2>{{$user->email}}</h2>

    @if (Auth::user()->following()->where('user_id', $user->id)->exists())
        <form action="{{ route('unfollow', $user->id) }}" method="POST">
            @csrf
            <button type="submit">Unfollow</button>
        </form>
    @else
        <form action="{{ route('follow', $user->id) }}" method="POST">
            @csrf
            <button type="submit">Follow</button>
        </form>
    @endif

    <h3>Followers</h3>
    <ul>
        @foreach($user->followers as $follower)
            <li>{{ $follower->name }}</li>
        @endforeach
    </ul>

    <h3>Following</h3>
    <ul>
        @foreach($user->following as $following)
            <li>{{ $following->name }}</li>
        @endforeach
    </ul>

    <div>
        <h1>Posts</h1>
        <ul>
            @foreach($posts as $post)
                <li>
                    <p>{{$post->created_at}}</p>
                    <p>{{$post->text}}</p>
                    <br>
                </li>
            @endforeach
        </ul>
    </div>
</body>

</html>