<?php

namespace App\Http\Controllers;

use App\Models\Franchise;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        try {
            // Get featured franchises (published ones)
            $featuredFranchises = Franchise::where('status', 'published')
                ->with(['category', 'images'])
                ->orderBy('created_at', 'desc')
                ->take(6)
                ->get();

            // Get categories with franchise count
            $categories = Category::withCount(['franchises' => function($query) {
                $query->where('status', 'published');
            }])->get();

            return view('home', compact('featuredFranchises', 'categories'));

        } catch (\Exception $e) {
            // If there's an error (like missing tables), return empty data
            $featuredFranchises = collect();
            $categories = collect();
            
            return view('home', compact('featuredFranchises', 'categories'));
        }
    }
}