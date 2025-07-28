{{-- @extends('layouts.app') --}}
<x-app-layout> {{-- ✅ use this instead --}}

 <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Create Post
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="bg-green-100 text-green-800 p-2 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="mb-4">
                    <label class="block mb-1">Title</label>
                    <input type="text" name="title" class="w-full border p-2" value="{{ old('title') }}">
                    @error('title')
                        <div class="text-red-600">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block mb-1">Content</label>
                    <textarea name="content" class="w-full border p-2" rows="5">{{ old('content') }}</textarea>
                    @error('content')
                        <div class="text-red-600 text-sm">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-4">
                    <label class="block mb-1">Image</label>
                    <input type="file" name="image" class="w-full border p-2">
                    @error('image')
                        <div class="text-red-600 text-sm">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Submit</button>
            </form>
        </div>
    </div>

</x-app-layout>
