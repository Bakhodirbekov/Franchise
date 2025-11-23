<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Inquiry;
use Illuminate\Http\Request;

class InquiryController extends Controller
{
    public function index()
    {
        $inquiries = Inquiry::with(['franchise.category', 'user'])
            ->latest()
            ->paginate(10);
            
        return view('admin.inquiries.index', compact('inquiries'));
    }
    
    public function show($id)
    {
        $inquiry = Inquiry::with(['franchise', 'user'])->findOrFail($id);
        return view('admin.inquiries.show', compact('inquiry'));
    }
    
    public function update(Request $request, $id)
    {
        $inquiry = Inquiry::findOrFail($id);
        
        $request->validate([
            'status' => 'required|in:new,contacted,closed',
            'admin_note' => 'nullable|string|max:1000',
            'admin_response' => 'nullable|string|max:2000',
        ]);
        
        $data = $request->only('status', 'admin_note', 'admin_response');
        
        // Set admin_response_at timestamp if admin_response is provided
        if ($request->filled('admin_response')) {
            $data['admin_response_at'] = now();
        }
        
        $inquiry->update($data);
        
        return redirect()->route('admin.inquiries.index')
            ->with('success', 'Inquiry status updated successfully!');
    }
}