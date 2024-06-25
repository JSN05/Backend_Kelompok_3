<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="flex justify-between space-x-4">
                <div class="w-1/2 p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <!-- 13 06 2024 Michael, menampilkan follower dan following start -->
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
                     <!-- 13 06 2024 Michael, menampilkan follower dan following end -->
                </div>
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

            <!-- Your Posts Section -->
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <h2 class="text-lg font-medium text-gray-900">Your Posts</h2>
                <p class="text-sm text-grey-trans -mb-1">
                    {{ __("These are your latest text posts.") }}
                </p>
                <ul>
                    @foreach($posts as $post)
                        <li class="flex justify-between items-center post-line">
                            <div>
                                <h6 class="font-semibold">
                                    {{ $post->username }} 
                                    <span class="text-sm text-grey-trans">&bull; {{ $post->created_at }}</span>
                                </h6>
                                <p><a href="{{ route('post.visit', ['post' => $post->id]) }}">{{ $post->text }}</a></p>
                            </div>
                            <form action="{{ route('post.destroy', $post->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Are you sure you want to delete this post?')" class="text-white text-xs px-4 py-2 bg-[#000000] hover:bg-[#666666] rounded-lg">
                                    DELETE
                                </button>
                            </form>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>