<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index()
    {
        // Fetch all posts
        $posts = Post::with('user')->latest()->get();
        return view('home', compact('posts'));
    }
    public function post(Request $request)
    {
        // Validate the request
        $request->validate([
            'content' => 'required|max:140',
        ]);

        // Create a new post
        $post = new Post();
        $post->user_id = Auth::id();
        $post->content = $request->input('content');
        $post->save();

        return redirect('/')->with('success', 'Post created successfully!');
    }
}
