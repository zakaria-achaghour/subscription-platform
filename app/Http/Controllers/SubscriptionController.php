<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use App\Models\Website;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class SubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 10);
        $offset = $request->get('offset', 0);

        $subscriptions = Subscription::with('website')
            ->skip($offset)
            ->take($perPage)
            ->get();

        $total = Subscription::count();

        return response()->json([
            'data' => $subscriptions,
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
        try {
            $request->validate([
                'email' => 'required|email|unique:subscriptions,email,NULL,id,website_id,' . $websiteId,
            ]);
        
            $subscription = $website->subscriptions()->create($request->only('email'));
        
            return response()->json($subscription, 201);
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
        $subscription = Subscription::with('website')->find($id);

        if (!$subscription) {
            return response()->json(['error' => 'Subscription not found'], 404);
        }

        return response()->json($subscription, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $subscription = Subscription::find($id);

        if (!$subscription) {
            return response()->json(['error' => 'Subscription not found'], 404);
        }

        $subscription->delete();

        return response()->json(['message' => 'Subscription deleted successfully'], 200);

    }
}
