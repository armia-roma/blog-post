<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'nullable|in:pending,published,rejected'
        ]);

        // Handle file upload if an image is provided
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('images', 'public');
        }

        // Create the post
        Post::create($data);

        return redirect()->route('posts.index')->with('success', 'Post created successfully.');
    }

    function index()
    {
        $posts = Post::all();
        return view('posts.index', compact('posts'));
    }

    public function published()
    {
        // Fetch only posts where status = 'published'
        $posts = Post::where('status', 'published')->latest()->paginate(10); // paginate 10 per page

        // Pass posts to the view
        return view('dashboard', compact('posts'));
    }
    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }
    public function update(Request $request, Post $post)
{
    $request->validate([
        'status' => 'required|in:pending,published,rejected',
    ]);

    $post->status = $request->status;
    $post->save();

    return redirect()->back()->with('success', 'Post status updated!');
}

}
