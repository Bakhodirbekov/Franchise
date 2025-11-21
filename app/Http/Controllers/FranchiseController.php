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
            
            if ($request->has('category') && $request->category) {
                $query->where('category_id', $request->category);
            }
            
            if ($request->has('search') && $request->search) {
                $query->where(function($q) use ($request) {
                    $q->where('title', 'like', '%' . $request->search . '%')
                      ->orWhere('short_description', 'like', '%' . $request->search . '%');
                });
            }
            
            $franchises = $query->orderBy('created_at', 'desc')->paginate(12);
            
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