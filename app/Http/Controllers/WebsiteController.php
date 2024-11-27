<?php

namespace App\Http\Controllers;

use App\Models\Website;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class WebsiteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 10);
        $offset = $request->get('offset', 0);
        $websites = Website::with('posts')
            ->skip($offset)
            ->take($perPage)
            ->get();
        $total = Website::count();

        return response()->json([
            'data' => $websites,
            'total' => $total,
            'perPage' => $perPage,
            'offset' => $offset,
        ], 200);
       
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'url' => 'required|url|unique:websites,url',
            ]);
    
            $website = Website::create($validated);
    
            return response()->json($website, 201);
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
        $website = Website::find($id);

        if (!$website) {
            return response()->json(['error' => 'Website not found'], 404);
        }

        return response()->json($website, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $website = Website::find($id);

        if (!$website) {
            return response()->json(['error' => 'Website not found'], 404);
        }
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'url' => 'required|url|unique:websites,url,' . $id,
            ]);

            $website->update($validated);

            return response()->json($website, 200);
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
        $website = Website::find($id);

        if (!$website) {
            return response()->json(['error' => 'Website not found'], 404);
        }

        $website->delete();

        return response()->json(['message' => 'Website deleted successfully'], 200);
    }
}
