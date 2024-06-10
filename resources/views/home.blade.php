<x-app-layout>
<x-slot name="header">
    <a href="{{ route('post.create') }}" style="border: 2px solid black; padding: 5px 10px; text-decoration: none;">Post something</a>
</x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div>
                        <ul>
                            @foreach($posts as $post)
                                <li>
                                    <h6>{{ $post->username }}</h6>
                                    <p>{{ $post->created_at }}</p>
                                    <p>{{ $post->text }}</p>
                                    <form action="{{ route('post.destroy', $post->id) }}" method="POST" style="display:inline;">
    @csrf
    @method('DELETE')
    <button type="submit" onclick="return confirm('Are you sure you want to delete this post?')" style="border: 2px solid black; padding: 5px 10px; background-color: white; color: black; cursor: pointer;">Delete</button>
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
