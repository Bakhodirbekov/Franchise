<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inquiry;
use App\Models\Order;

class AccountController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $recentInquiries = Inquiry::where('user_id', $user->id)
            ->with('franchise')
            ->latest()
            ->take(5)
            ->get();
            
        return view('account.index', compact('user', 'recentInquiries'));
    }
    
    public function inquiries()
    {
        $inquiries = Inquiry::where('user_id', auth()->id())
            ->with('franchise')
            ->latest()
            ->paginate(10);
            
        return view('account.inquiries', compact('inquiries'));
    }
    
    public function orders()
    {
        $orders = Order::where('user_id', auth()->id())
            ->with('franchise')
            ->latest()
            ->paginate(10);
            
        return view('account.orders', compact('orders'));
    }
}