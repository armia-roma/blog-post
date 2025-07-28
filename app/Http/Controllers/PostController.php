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
}
