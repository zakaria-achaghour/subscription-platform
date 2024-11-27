<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Website;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 10);
        $offset = $request->get('offset', 0);

        $posts = Post::with('website')
            ->skip($offset)
            ->take($perPage)
            ->get();

        $total = Post::count();

        return response()->json([
            'data' => $posts,
            'total' => $total,
            'perPage' => $perPage,
            'offset' => $offset,
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $websiteId)
    {
        $website = Website::findOrFail($websiteId);
        try  {
            $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'required|string',
            ]);
        
            $post = $website->posts()->create($request->only('title', 'description'));
        
            return response()->json($post, 201);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Errors',
                'errors' => $e->errors(),
            ], 400);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $post = Post::with('website')->find($id);

        if (!$post) {
            return response()->json(['error' => 'Post not found'], 404);
        }

        return response()->json($post, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $post = Post::find($id);

        if (!$post) {
            return response()->json(['error' => 'Post not found'], 404);
        }

        try {
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'required|string',
            ]);
    
            $post->update($validated);
    
            return response()->json($post, 200);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Errors',
                'errors' => $e->errors(),
            ], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post = Post::find($id);

        if (!$post) {
            return response()->json(['error' => 'Post not found'], 404);
        }

        $post->delete();

        return response()->json(['message' => 'Post deleted successfully'], 200);
    }
}
