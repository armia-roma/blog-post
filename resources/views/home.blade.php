<x-app-layout>
    <div class="p-6 bg-white">
        <table class="w-full table-auto border border-gray-200">
            <thead>
                <tr class="bg-gray-100 text-gray-700">
                    <th class="px-4 py-2 border-b">Title</th>
                    <th class="px-4 py-2 border-b">Content</th>
                    <th class="px-4 py-2 border-b">Status</th>

                </tr>
            </thead>
            <tbody class="">
                @foreach($posts as $post)
                    <tr class="hover:bg-gray-50 text-center">
                        <td class="px-4 py-2 border-b">
                            {{ $post->title }}
                        </td>
                        <td class="px-4 py-2 border-b ">
                            {{ $post->content }}
                        </td>

                        <td class="px-4 py-2 border-b ">
                            {{ $post->status }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
