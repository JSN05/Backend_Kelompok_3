<x-app-layout>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h6>{{ $post->username }}</h6>
                    <p>{{ $post->text }}</p>
                    
                     <!-- Tempat Mengisi Komentar -->
                     <form action="/posts/{{ $post->id }}/comments" method="POST" class="mt-4">
                        @csrf
                        <textarea name="body" required class="w-full p-2 border rounded" placeholder="Add a comment..."></textarea>
                        <button type="submit" class="mt-2 bg-black text-white px-4 py-2 rounded-full">Add Comment</button>
                    </form>
                    
                    <!-- Menampilkan Komentar -->
                    <div class="mt-6">
                        <h4 class="font-semibold">Comments</h4>
                        @foreach ($post->comments as $comment)
                            <div class="mt-4 p-4 bg-gray-100 rounded flex justify-between items-center">
                                <div>
                                    <strong>{{ $comment->user->name }}</strong>
                                    <p>{{ $comment->body }}</p>
                                </div>
                                <!-- Menghapus Komentar pembuat Komentar -->
                                @if (auth()->id() == $comment->user_id)
                                    <form action="/comments/{{ $comment->id }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this comment?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="ml-4 bg-red-500 text-white px-4 py-2 rounded-full">Delete</button>
                                    </form>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>