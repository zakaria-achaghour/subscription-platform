<?php

namespace App\Http\Controllers;

use App\Models\EmailLog;
use Illuminate\Http\Request;

class EmailLogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 10);
        $offset = $request->get('offset', 0);

        $emailLogs = EmailLog::with(['post', 'subscription'])
            ->skip($offset)
            ->take($perPage)
            ->get();

        $total = EmailLog::count();

        return response()->json([
            'data' => $emailLogs,
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $emailLog = EmailLog::with(['post', 'subscription'])->find($id);

        if (!$emailLog) {
            return response()->json(['error' => 'Email log not found'], 404);
        }

        return response()->json($emailLog, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
