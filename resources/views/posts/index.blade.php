@extends('layouts.app')

@section('content')
<div class="container">
    <h1>All Posts</h1>

    @if(session('success'))
        <div style="color: green; margin-bottom: 15px;">
            {{ session('success') }}
        </div>
    @endif

    @if($posts->isEmpty())
        <p>No posts found.</p>
    @else
        <table border="1" cellpadding="10" cellspacing="0" style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Content</th>
                    <th>Image</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($posts as $post)
                    <tr>
                        <!-- Title: show full title only to admin, others see clickable text -->
                        <td>
                            @if(auth()->check() && auth()->user()->isAdmin())
                                {{ $post->title }}
                            @else
                                <a href="#" onclick="event.preventDefault(); document.getElementById('content-{{ $post->id }}').style.display = 'block'; this.style.display='none';" style="cursor:pointer; color:blue; text-decoration: underline;">
                                    Click to view
                                </a>
                            @endif
                        </td>

                        <!-- Content: show only for admin or after click -->
                        <td>
                            @if(auth()->check() && auth()->user()->isAdmin())
                                {{ $post->content }}
                            @else
                                <div id="content-{{ $post->id }}" style="display:none;">
                                    {{ $post->content }}
                                </div>
                            @endif
                        </td>

                        <!-- Image -->
                        <td>
                            @if($post->image)
                                <img src="{{ asset('storage/' . $post->image) }}" alt="Post Image" style="max-width: 150px; max-height: 100px;">
                            @else
                                No Image
                            @endif
                        </td>

                        <!-- Status -->
                        <td>
                            @if(auth()->check() && auth()->user()->isAdmin())
                                <form method="POST" action="{{ route('posts.updateStatus', $post->id) }}">
                                    @csrf
                                    @method('PATCH')
                                    <select name="status" onchange="this.form.submit()">
                                        <option value="pending" {{ $post->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="published" {{ $post->status === 'published' ? 'selected' : '' }}>Published</option>
                                        <option value="rejected" {{ $post->status === 'rejected' ? 'selected' : '' }}>Rejected</option>
                                    </select>
                                </form>
                            @else
                                {{ ucfirst($post->status ?? 'pending') }}
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
