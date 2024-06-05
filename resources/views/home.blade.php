<x-app-layout>
    <x-slot name="header">
        <a href="{{route('post.create')}}">Post something</a>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div>
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
        </div>
    </div>
</x-app-layout>