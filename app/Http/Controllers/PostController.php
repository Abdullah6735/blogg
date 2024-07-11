<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('category')->get();
        return Inertia::render('Posts/Index', ['posts' => $posts]);
    }

    public function create()
    {
        $categories = Category::all();
        return Inertia::render('Posts/Create', ['categories' => $categories]);
    }

    // Store a new post
    public function store(Request $request)
    {
        $validatedData = $this->validatePost($request);

        if ($request->hasFile('image')) {
        $imagePath = $this->handleImageUpload($request);

        $post = Post::create(array_merge($validatedData, ['image' => $imagePath]));
        } else {
            $post = Post::create($validatedData);
        }

        return redirect()->route('posts.index')->with('success', 'Post created successfully.');
    }

    // Retrieve a single post
    public function show(Post $post)
    {
        $post->load('category'); 
        return Inertia::render('Posts/Show', ['post' => $post]);
    }

    // Edit a post 
    public function edit(Post $post)
    {
        $categories = Category::all();
        return Inertia::render('Posts/Edit', [
        'post' => $post,
        'categories' => $categories
    ]);
    }

    // Update an existing post
    public function update(Request $request, Post $post)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    
        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if ($post->image) {
                Storage::disk('public')->delete($post->image);
            }
            $validatedData['image'] = $request->file('image')->store('images', 'public');
        } else {
            // Preserve the old image if no new image is uploaded
            unset($validatedData['image']);
        }
    
        $post->fill($validatedData);
        $post->save();
    
        return redirect()->route('posts.index')->with('success', 'Post updated successfully.');
    }

    // Delete a post
    public function destroy(Post $post)
    {
        $post = Post::findOrFail($post->id);
        if ($post->image) {
            Storage::disk('public')->delete($post->image);
        }
        $post->delete();

        return redirect()->route('posts.index')->with('success', 'Post deleted successfully.');
    }

    private function validatePost(Request $request)
    {
        return $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    }

    // Handle image upload
    private function handleImageUpload(Request $request)
    {
        return $request->file('image')->store('images', 'public');
    }
}
