<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
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
            <!-- 13 06 2024 Michael, menampilkan follower dan following start -->
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
            <!-- 13 06 2024 Michael, menampilkan follower dan following end -->
            <div>
                <h1>Your posts</h1>
                <ul>
                    @foreach($posts as $post)
                        <li>
                            <h6>{{$post->username}}</h6>
                            <p>{{$post->created_at}}</p>
                            <p>{{$post->text}}</p>
                            <br>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</x-app-layout>