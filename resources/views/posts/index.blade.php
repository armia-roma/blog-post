<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">

            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Create Post
            </h2>
            <a href="{{ route('posts.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
    Create post
</a>
        </div>
    </x-slot>

    <div class="p-6 bg-white">
        <table class="w-full table-auto border border-gray-200">
            <thead>
                <tr class="bg-gray-100 text-gray-700">
                    <th class="px-4 py-2 border-b">Title</th>

                    <th class="px-4 py-2 border-b">Status</th>
                    @if(auth()->check() && auth()->user()->isAdmin())
                        <th class="px-4 py-2 border-b">Action</th>
                    @endif
                </tr>
            </thead>
            <tbody class="text-center">
                @foreach($posts as $post)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-2 border-b">
                            {{ $post->title }}
                        </td>



                        <td class="px-4 py-2 border-b">
                            @if(auth()->check() && auth()->user()->isAdmin())
                                <form method="POST" action="{{ route('posts.update', $post->id) }}">
                                    @csrf
                                    @method('PATCH')
                                    <select name="status" onchange="this.form.submit()" class="border rounded px-7 py-1">
                                        <option value="pending" {{ $post->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="published" {{ $post->status === 'published' ? 'selected' : '' }}>Published</option>
                                        <option value="rejected" {{ $post->status === 'rejected' ? 'selected' : '' }}>Rejected</option>
                                    </select>
                                </form>
                            @else
                                {{ ucfirst($post->status ?? 'pending') }}
                            @endif
                        </td>
                         @if(auth()->check() && auth()->user()->isAdmin())
                            <td class="px-4 py-2 border-b">
                                <a href="{{ route('posts.show', $post->id) }}" class="text-blue-600 hover:underline">View</a>
                            </td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
