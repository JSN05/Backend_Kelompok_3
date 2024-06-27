<x-app-layout>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h6>{{ $post->username }}</h6>
                    <p>{{ $post->text }}</p>
                    <!-- Like/Unlike Button -->
                    <div>
                        @if($post->likes()->where('user_id', auth()->id())->exists())
                        <form action="{{ route('likes.destroy', $post) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-700 rounded">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart-fill inline" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314"/>
                                </svg>
                                <span class="text-xs">{{ $post->likes_count }}</span>
                            </button>
                        </form>
                        @else
                        <form action="{{ route('likes.store', $post) }}" method="POST">
                            @csrf
                            <button type="submit" class="text-gray-500 hover:text-gray-700 rounded">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart inline" viewBox="0 0 16 16">
                                    <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143q.09.083.176.171a3 3 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15"/>
                                </svg>
                                <span class="text-xs">{{ $post->likes_count }}</span>
                            </button>
                        </form>
                        @endif
                    </div>
                    
                     <!-- Tempat Mengisi Komentar -->
                     <form action="/posts/{{ $post->id }}/comments" method="POST" class="mt-1">
                        @csrf
                        <textarea name="body" required class="w-full p-2 pl-3 border rounded" placeholder="Add a comment..." style="resize: none"></textarea>
                        <button type="submit" class="mt-2 bg-black text-white px-4 py-2 rounded-full text-sm">Add Comment</button>
                    </form>
                    
                    <!-- Menampilkan Komentar -->
                    <div class="mt-2">
                        <h4 class="font-semibold">Comments</h4>
                        @foreach ($post->comments as $comment)
                            <div class="mt-2 p-4 bg-gray-100 rounded flex justify-between items-center">
                                <div>
                                    <strong>{{ $comment->user->name }}</strong>
                                    <p>{{ $comment->body }}</p>
                                </div>
                                <!-- Menghapus Komentar pembuat Komentar -->
                                @if (auth()->id() == $comment->user_id)
                                    <form action="/comments/{{ $comment->id }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this comment?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="ml-4 bg-red-500 text-white px-4 py-2 rounded-full text-sm">Delete</button>
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