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
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>