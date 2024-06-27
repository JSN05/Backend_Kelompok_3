<x-app-layout>
    <x-slot name="header">
        <a href="{{ route('post.create') }}" class="bg-[#000000] hover:bg-[#666666] text-white py-2 px-4 no-underline rounded-lg">Post something</a>
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
                                    <!-- 23/06/24 Jorgen Sunari, Like button -->
                                    <form action="{{ route('likes.store', $post->id) }}" method="POST" class="inline">
                                        @csrf
                                        @if ($post->likedByUser(auth()->user()))
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:text-red-700 rounded">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart-fill inline" viewBox="0 0 16 16">
                                                    <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314"/>
                                                </svg>
                                                <span class="text-xs">{{ $post->likes_count }}</span>
                                            </button>
                                        @else
                                            <button type="submit" class="text-gray-500 hover:text-gray-700 rounded">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart inline" viewBox="0 0 16 16">
                                                    <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143q.09.083.176.171a3 3 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15"/>
                                                </svg>
                                                <span class="text-xs">{{ $post->likes_count }}</span>
                                            </button>
                                        @endif
                                    </form>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
