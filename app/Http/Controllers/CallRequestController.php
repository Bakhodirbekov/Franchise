<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CallRequest;
use App\Models\Franchise;

class CallRequestController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'franchise_id' => 'required|exists:franchises,id',
            'franchise_name' => 'required|string',
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'call_time' => 'nullable|string|max:50',
        ]);

        $callRequest = CallRequest::create($request->all());

        // Send notification to company (you can implement email/SMS notification here)
        // For now, we'll just log it
        \Log::info('New call request received', [
            'franchise' => $request->franchise_name,
            'customer_name' => $request->name,
            'customer_phone' => $request->phone,
            'preferred_time' => $request->call_time,
            'company_phone' => '+998878111444' // Your company phone number
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Call request submitted successfully. We will contact you soon.'
        ]);
    }
}