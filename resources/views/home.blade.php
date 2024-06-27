<x-app-layout>
    <x-slot name="header">
    <div style="display: flex; justify-content: space-between; align-items: center;">
        <a href="{{ route('post.create') }}" class="bg-[#000000] hover:bg-[#666666] text-white py-2 px-4 no-underline rounded-lg">
            Post something
        </a>
        <div style="display: flex; justify-content: flex-end; padding: 10px;"></div>
        <form action="{{ route('search') }}" method="GET" class="ml-4 flex" style="display: flex; align-items: center; position: relative;">
                <input type="text" name="query" placeholder="Search Account" class="px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-gray-500" />
                <button type="submit" id="searchButton" style="position: absolute; right: 5px; top: 50%; transform: translateY(-50%); background: none; border: none;">
        <img src="images/SearchIcon.png" alt="Search Icon" style="width: 20px; height: 20px; margin-right: 10px;">
    </button>
            </form>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div>
                        <ul>
                            @foreach($posts as $post)
                                <li class="post-line">
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
                                        <span class="text-sm text-grey-trans">&bull; {{ $post->created_at }}</span>
                                    </h6>
                                    <!-- Tautan untuk mengunjungi postingan -->
                                    <p><a href="{{ route('post.visit', ['post' => $post->id]) }}">{{ $post->text }}</a></p>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>