<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Franchise;
use App\Models\Inquiry;
use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_franchises' => Franchise::count(),
            'total_inquiries' => Inquiry::count(),
            'total_users' => User::count(),
            'total_orders' => Order::count(),
            'pending_inquiries' => Inquiry::where('status', 'new')->count(),
            'published_franchises' => Franchise::where('status', 'published')->count(),
            'admin_users' => User::where('role', 'admin')->count(),
            'completed_orders' => Order::where('status', 'paid')->count(),
            'pending_orders' => Order::where('status', 'pending')->count(),
        ];
        
        $recentInquiries = Inquiry::with(['franchise', 'user'])
            ->latest()
            ->take(5)
            ->get();
            
        $recentFranchises = Franchise::with('category')
            ->latest()
            ->take(5)
            ->get();
            
        return view('admin.dashboard', compact('stats', 'recentInquiries', 'recentFranchises'));
    }
}