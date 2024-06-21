<x-app-layout>
    <x-slot name="header">
    <div style="display: flex; justify-content: space-between; align-items: center;">
        <a href="{{ route('post.create') }}" style="border: 2px solid black; padding: 5px 10px; text-decoration: none;">
            Post something
        </a>
        <div style="display: flex; justify-content: flex-end; padding: 10px;">
    <form id="searchForm" method="get" action="search.php" style="display: flex; align-items: center; position: relative;">
        <input type="text" id="search_box" name="find" placeholder="Search Account" style="width: 300px; padding: 10px 40px 10px 20px; border: 1px solid #dfe1e5; border-radius: 24px; font-size: 16px; outline: none; box-shadow: none;">
        <button type="submit" id="searchButton" style="position: absolute; right: 5px; top: 50%; transform: translateY(-50%); background: none; border: none;">
            <img src="images/SearchIcon.png" alt="Search Icon" style="width: 20px; height: 20px; margin-right: 10px;">
        </button>
    </form>
</div>



    </x-slot>



    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div>
                        <ul>
                            @foreach($posts as $post)
                                <li>
                                    <h6>
                                        <!-- 13 06 2024 Michael, Link untuk visit profil start -->
                                        @if (Auth::check() && Auth::user()->id !== $post->user->id)
                                            <a href="{{ route('profile.visit', ['user' => $post->user->id]) }}">
                                                {{ $post->username }}
                                            </a>
                                        @else
                                            {{ $post->username }}
                                        @endif
                                        <!-- 13 06 2024 Michael, Link untuk visit profil end -->
                                    </h6>
                                    <p>{{ $post->created_at }}</p>
                                    <p>{{ $post->text }}</p>
                                    <form action="{{ route('post.destroy', $post->id) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            onclick="return confirm('Are you sure you want to delete this post?')"
                                            style="border: 2px solid black; padding: 5px 10px; background-color: white; color: black; cursor: pointer;">Delete</button>
                                    </form>


                                    <br>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>