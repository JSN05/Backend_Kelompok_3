<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $user->name }}'s Profile</title>
    <link rel="icon" href="{{ asset('images/Poster.png') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<!-- 13 06 2024 Michael, view untuk visit profil start-->
<!-- 17 06 2024 Dimas, update tampilan untuk visit profil, start-->
<body class="bg-gray-100">
    @include('layouts.navigation')

    <div class="max-w-7xl mx-auto px-4 py-6 sm:px-6 lg:px-8 space-y-6">
        <!-- Profile Header -->
        <div class="bg-white shadow-md rounded-lg p-6 flex justify-between items-center">
            <div>
                <h1 class="text-lg font-semibold text-gray-900">{{ $user->name }}'s Profile <span class="text-lg text-grey-trans">| {{ $user->email }}</span></h1>
            </div>
            <!-- Follow/Unfollow Button -->
            <form
                @if (Auth::user()->following()->where('user_id', $user->id)->exists())
                    action="{{ route('unfollow', $user->id) }}"
                    class="ml-4"
                @else
                    action="{{ route('follow', $user->id) }}"
                    class="ml-4"
                @endif
                method="POST">
                @csrf
                @if (Auth::user()->following()->where('user_id', $user->id)->exists())
                    <button type="submit" class="bg-[#000000] hover:bg-[#666666] text-white px-4 py-2 rounded-lg">
                        Unfollow
                    </button>
                @else
                    <button type="submit" class="bg-[#ffffff] hover:bg-[#e3e2e2] border-2 px-4 py-2 rounded-lg">
                        Follow
                    </button>
                @endif
            </form>
        </div>

        <div class="flex justify-between space-x-4">
            <!-- Followers -->
            <div class="w-1/2 p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <h3 class="text-lg font-semibold">
                    <span id="followers-count" class="cursor-pointer" onclick="toggleFollowersList()">
                        {{ $user->followers->count() }} Followers
                    </span>
                </h3>
                <ul id="followers-list" class="list-none pl-0 hidden">
                    @foreach($user->followers as $follower)
                    <li>
                        <a href="{{ url('/profile', $follower->id) }}" class="hover:underline">
                            {{ $follower->name }}
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>

            <!-- Following -->
            <div class="w-1/2 p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <h3 class="text-lg font-semibold">
                    <span id="following-count" class="cursor-pointer" onclick="toggleFollowingList()">
                        {{ $user->following->count() }} Following
                    </span>
                </h3>
                <ul id="following-list" class="list-none pl-0 hidden">
                    @foreach($user->following as $following)
                    <li>
                        <a href="{{ url('/profile', $following->id) }}" class="hover:underline">
                            {{ $following->name }}
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>

        <!-- User's Posts -->
        <div class="bg-white shadow-md rounded-lg p-6">
            <h1 class="text-lg font-semibold text-gray-900">{{ $user->name }}'s Posts</h1>
            <p class="text-sm text-grey-trans">Here you can find a collection of all posts made by {{ $user->name }}.</p>
            <ul>
                @foreach($posts as $post)
                <li class="post-line">
                    <p class="text-gray-600">{{ $post->created_at }}</p>
                    <p>{{ $post->text }}</p>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
</body>
<!-- 17 06 2024 Dimas, update tampilan untuk visit profil, start-->
<!-- 13 06 2024 Michael, view untuk visit profil end-->

</html>