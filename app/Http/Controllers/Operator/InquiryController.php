<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Inquiry;

class InquiryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Inquiry::with('franchise')->latest();
        
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
        
        $inquiries = $query->paginate(10)->appends($request->except('page'));
            
        return view('operator.inquiries.index', compact('inquiries'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Inquiry $inquiry)
    {
        $inquiry->load('franchise');
        return view('operator.inquiries.show', compact('inquiry'));
    }

    /**
     * Update the status of an inquiry.
     */
    public function update(Request $request, Inquiry $inquiry)
    {
        $request->validate([
            'status' => 'required|in:new,contacted,closed'
        ]);

        $inquiry->update(['status' => $request->status]);

        return back()->with('success', 'Inquiry status updated successfully.');
    }
}