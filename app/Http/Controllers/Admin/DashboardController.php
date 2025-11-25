<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Franchise;
use App\Models\Inquiry;
use App\Models\User;
use App\Models\Order;
use App\Models\CallRequest;
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
            'operator_users' => User::where('role', 'operator')->count(),
            'completed_orders' => Order::where('status', 'paid')->count(),
            'pending_orders' => Order::where('status', 'pending')->count(),
            'total_call_requests' => CallRequest::count(),
            'pending_call_requests' => CallRequest::where('status', 'pending')->count(),
        ];
        
        // Get data for charts
        $franchiseData = $this->getFranchiseData();
        $inquiryData = $this->getInquiryData();
        $orderData = $this->getOrderData();
        $userData = $this->getUserData();
        $trafficData = $this->getTrafficData(); // New traffic data
        
        $recentInquiries = Inquiry::with(['franchise', 'user'])
            ->latest()
            ->take(5)
            ->get();
            
        $recentFranchises = Franchise::with('category')
            ->latest()
            ->take(5)
            ->get();
            
        return view('admin.dashboard', compact('stats', 'franchiseData', 'inquiryData', 'orderData', 'userData', 'trafficData', 'recentInquiries', 'recentFranchises'));
    }
    
    private function getFranchiseData()
    {
        // Get franchise counts by month for the last 6 months
        $data = [];
        for ($i = 5; $i >= 0; $i--) {
            $month = now()->subMonths($i);
            $count = Franchise::whereMonth('created_at', $month->month)
                ->whereYear('created_at', $month->year)
                ->count();
            $data[] = [
                'month' => $month->format('M'),
                'count' => $count
            ];
        }
        return $data;
    }
    
    private function getInquiryData()
    {
        // Get inquiry counts by month for the last 6 months
        $data = [];
        for ($i = 5; $i >= 0; $i--) {
            $month = now()->subMonths($i);
            $count = Inquiry::whereMonth('created_at', $month->month)
                ->whereYear('created_at', $month->year)
                ->count();
            $data[] = [
                'month' => $month->format('M'),
                'count' => $count
            ];
        }
        return $data;
    }
    
    private function getOrderData()
    {
        // Get order counts by month for the last 6 months
        $data = [];
        for ($i = 5; $i >= 0; $i--) {
            $month = now()->subMonths($i);
            $count = Order::whereMonth('created_at', $month->month)
                ->whereYear('created_at', $month->year)
                ->count();
            $data[] = [
                'month' => $month->format('M'),
                'count' => $count
            ];
        }
        return $data;
    }
    
    private function getUserData()
    {
        // Get user counts by month for the last 6 months
        $data = [];
        for ($i = 5; $i >= 0; $i--) {
            $month = now()->subMonths($i);
            $count = User::whereMonth('created_at', $month->month)
                ->whereYear('created_at', $month->year)
                ->count();
            $data[] = [
                'month' => $month->format('M'),
                'count' => $count
            ];
        }
        return $data;
    }
    
    private function getTrafficData()
    {
        // Simulate website traffic data for the last 7 days
        $data = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i);
            // Simulate traffic with some variation
            $visitors = rand(100, 500) + ($i * 20); // Increasing trend
            $pageViews = $visitors * rand(2, 5); // 2-5 page views per visitor
            $data[] = [
                'date' => $date->format('D'), // Mon, Tue, etc.
                'full_date' => $date->format('M j'), // Nov 1, Nov 2, etc.
                'visitors' => $visitors,
                'pageViews' => $pageViews
            ];
        }
        return $data;
    }
}