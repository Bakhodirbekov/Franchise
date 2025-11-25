<?php

namespace App\Http\Controllers;

use App\Models\Franchise;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class FranchiseController extends Controller
{
    public function index(Request $request)
    {
        try {
            $categories = Category::all();
            
            $query = Franchise::where('status', 'published')
                ->with(['category', 'images']);
            
            // Category filter
            if ($request->has('category') && $request->category) {
                $query->where('category_id', $request->category);
            }
            
            // Search filter
            if ($request->has('search') && $request->search) {
                $query->where(function($q) use ($request) {
                    $q->where('title', 'like', '%' . $request->search . '%')
                      ->orWhere('short_description', 'like', '%' . $request->search . '%');
                });
            }
            
            // Investment range filters
            if ($request->has('investment_min') && $request->investment_min) {
                $query->where('investment_min', '>=', $request->investment_min);
            }
            
            if ($request->has('investment_max') && $request->investment_max) {
                $query->where('investment_max', '<=', $request->investment_max);
            }
            
            // Sort options
            if ($request->has('sort')) {
                switch ($request->sort) {
                    case 'investment_low_high':
                        $query->orderBy('investment_min', 'asc');
                        break;
                    case 'investment_high_low':
                        $query->orderBy('investment_min', 'desc');
                        break;
                    case 'newest':
                    default:
                        $query->orderBy('created_at', 'desc');
                        break;
                }
            } else {
                $query->orderBy('created_at', 'desc');
            }
            
            $franchises = $query->paginate(12);
            
            return view('franchises.index', compact('franchises', 'categories'));

        } catch (\Exception $e) {
            Log::error('Franchise index error: ' . $e->getMessage());
            
            $franchises = collect();
            $categories = collect();
            
            return view('franchises.index', compact('franchises', 'categories'))
                ->with('error', 'Error loading franchises.');
        }
    }
    
    public function show($slug)
    {
        // Require authentication to view franchise details
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Please login to view franchise details.');
        }
        
        try {
            Log::info("🔍 Looking for franchise with slug: {$slug}");

            // 1. Franchise ni topish
            $franchise = Franchise::where('slug', $slug)
                ->with(['category', 'images', 'creator'])
                ->first();

            if (!$franchise) {
                Log::error("❌ Franchise not found with slug: {$slug}");
                
                // Database dagi barcha slug larni ko'rsatish
                $allSlugs = Franchise::pluck('slug')->toArray();
                Log::info("Available slugs: " . implode(', ', $allSlugs));
                
                return redirect()->route('franchises.index')
                    ->with('error', 'Franchise not found. Please check the URL.');
            }

            Log::info("✅ Franchise found: {$franchise->title}");

            // 2. Status tekshirish
            if ($franchise->status !== 'published') {
                $user = auth()->user();
                $isAdmin = $user && $user->role === 'admin';
                
                if (!$isAdmin) {
                    Log::warning("⏸️ Franchise not published: {$slug}");
                    return redirect()->route('franchises.index')
                        ->with('error', 'This franchise is not available.');
                }
            }

            // 3. Related franchises
            $relatedFranchises = Franchise::where('category_id', $franchise->category_id)
                ->where('id', '!=', $franchise->id)
                ->where('status', 'published')
                ->with('images')
                ->take(4)
                ->get();

            Log::info("✅ Related franchises: {$relatedFranchises->count()}");

            // 4. View ga yuborish
            return view('franchises.show', compact('franchise', 'relatedFranchises'));

        } catch (\Exception $e) {
            Log::error("💥 CRITICAL ERROR in franchise show:");
            Log::error("Message: " . $e->getMessage());
            Log::error("File: " . $e->getFile());
            Log::error("Line: " . $e->getLine());
            Log::error("Trace: " . $e->getTraceAsString());

            return redirect()->route('franchises.index')
                ->with('error', 'Error loading franchise details. Please try again.');
        }
    }
}