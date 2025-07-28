<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
         <div class="p-6 bg-white">
        <table class="w-full table-auto border border-gray-200">
            <thead>
                <tr class="bg-gray-100 text-gray-700">
                    <th class="px-4 py-2 border-b">Title</th>
                    <th class="px-4 py-2 border-b">Content</th>
                    <th class="px-4 py-2 border-b">Status</th>

                </tr>
            </thead>
            <tbody class="text-center">
                @foreach($posts as $post)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-2 border-b">
                            {{ $post->title }}
                        </td>
                        <td class="px-4 py-2 border-b">
                            {{ $post->content }}
                        </td>

                        <td class="px-4 py-2 border-b">
                            {{ $post->status }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    </div>
</x-app-layout>
