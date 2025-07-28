<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Post Details
        </h2>
    </x-slot>

    <div class="p-6 bg-white shadow-md rounded">
        <h3 class="text-2xl font-bold text-gray-900 mb-4">{{ $post->title }}</h3>
        @if($post->image)
            <div class="mb-4">
                <img src="{{ asset('storage/' . $post->image) }}"
                     alt="Post Image"
                     class="w-full max-w-md rounded shadow-md">
            </div>
        @endif
        <p class="text-gray-700 mb-2">
            <strong>Status:</strong> {{ ucfirst($post->status) }}
        </p>

        <div class="text-gray-800">
            <strong>Content:</strong>
            <p class="mt-2 whitespace-pre-line">{{ $post->content }}</p>
        </div>

        <div class="mt-6">
            <a href="{{ route('posts.index') }}" class="text-blue-600 hover:underline">← Back to all posts</a>
        </div>
    </div>
</x-app-layout>
