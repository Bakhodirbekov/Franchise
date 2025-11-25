<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CallRequest;

class CallRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = CallRequest::with('franchise')->latest();
        
        // Apply date filters if provided
        if ($request->filled('start_date')) {
            $query->whereDate('created_at', '>=', $request->start_date);
        }
        
        if ($request->filled('end_date')) {
            $query->whereDate('created_at', '<=', $request->end_date);
        }
        
        // Apply status filter if provided
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        
        $callRequests = $query->paginate(10)->appends($request->except('page'));
            
        return view('admin.inquiries.call-requests', compact('callRequests'));
    }

    /**
     * Update the status of a call request.
     */
    public function updateStatus(Request $request, CallRequest $callRequest)
    {
        $request->validate([
            'status' => 'required|in:pending,contacted,completed'
        ]);

        $callRequest->update(['status' => $request->status]);

        return back()->with('success', 'Call request status updated successfully.');
    }
}