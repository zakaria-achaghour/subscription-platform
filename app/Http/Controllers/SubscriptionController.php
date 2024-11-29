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
        try {
                $website = Website::findOrFail($websiteId);
                $request->validate([
                    'email' => 'required|email',
                ]);
    
                $exists = Subscription::where('email', $request->email)
                    ->where('website_id', $websiteId)
                    ->exists();
    
                if ($exists) {
                    return response()->json(['error' => 'This email is already subscribed to this website.'], 422);
                }
    
                $subscription = $website->subscriptions()->create($request->only('email'));
    
                return response()->json($subscription, 201);
            } catch (ValidationException $e) {
                return response()->json([
                    'message' => 'Validation Errors',
                    'errors' => $e->errors(),
                ], 422);
            } catch (\Exception $e) {
                return response()->json([
                    'message' => 'An unexpected error occurred.',
                    'error' => $e->getMessage(),
                ], 500);
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
