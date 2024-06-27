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
                            <button type="submit">Unlike ({{ $post->likes()->count() }})</button>
                        </form>
                        @else
                        <form action="{{ route('likes.store', $post) }}" method="POST">
                            @csrf
                            <button type="submit">Like ({{ $post->likes()->count() }})</button>
                        </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>