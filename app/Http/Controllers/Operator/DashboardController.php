<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use App\Models\CallRequest;
use App\Models\Inquiry;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Get statistics for the operator dashboard
        $stats = [
            'total_call_requests' => CallRequest::count(),
            'pending_call_requests' => CallRequest::where('status', 'pending')->count(),
            'contacted_call_requests' => CallRequest::where('status', 'contacted')->count(),
            'completed_call_requests' => CallRequest::where('status', 'completed')->count(),
            'total_inquiries' => Inquiry::count(),
            'pending_inquiries' => Inquiry::where('status', 'new')->count(),
            'contacted_inquiries' => Inquiry::where('status', 'contacted')->count(),
            'closed_inquiries' => Inquiry::where('status', 'closed')->count(),
        ];

        // Get recent call requests
        $recentCallRequests = CallRequest::with('franchise')
            ->latest()
            ->take(5)
            ->get();

        // Get recent inquiries
        $recentInquiries = Inquiry::latest()
            ->take(5)
            ->get();

        return view('operator.dashboard', compact('stats', 'recentCallRequests', 'recentInquiries'));
    }
}