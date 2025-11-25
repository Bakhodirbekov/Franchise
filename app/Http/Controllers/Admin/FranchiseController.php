<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Franchise;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FranchiseController extends Controller
{
    public function index()
    {
        $franchises = Franchise::with(['category', 'creator', 'images'])
            ->latest()
            ->paginate(10);

        $categories = Category::all();

        return view('admin.franchises.index', compact('franchises', 'categories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.franchises.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'short_description' => 'required|string|max:255',
            'description' => 'required|string',
            'investment_min' => 'required|numeric|min:0',
            'investment_max' => 'required|numeric|min:0|gte:investment_min',
            'royalty' => 'required|numeric|min:0|max:100',
            'territory' => 'nullable|string|max:255',
            'requirements' => 'nullable|string',
            'status' => 'required|in:published,draft',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,webp|max:5120',
        ]);

        try {
            // Handle requirements
            $requirements = null;
            if ($request->requirements) {
                $requirementsArray = array_map('trim', explode(',', $request->requirements));
                $requirements = array_filter($requirementsArray); // Remove empty values
            }

            // Create franchise (slug will be auto-generated in model)
            $franchise = Franchise::create([
                'title' => $request->title,
                'category_id' => $request->category_id,
                'short_description' => $request->short_description,
                'description' => $request->description,
                'investment_min' => $request->investment_min,
                'investment_max' => $request->investment_max,
                'royalty' => $request->royalty,
                'territory' => $request->territory,
                'requirements' => $requirements,
                'status' => $request->status,
                'created_by' => auth()->id(),
            ]);

            // Handle image upload
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $index => $image) {
                    $path = $image->store('franchises/' . $franchise->id, 'public');

                    \App\Models\FranchiseImage::create([
                        'franchise_id' => $franchise->id,
                        'path' => $path,
                        'alt' => $franchise->title,
                        'order' => $index,
                    ]);
                }
            }

            return redirect()->route('admin.franchises.index')
                ->with('success', 'Franchise created successfully!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Error creating franchise: ' . $e->getMessage());
        }
    }

    public function show($id)
    {
        $franchise = Franchise::with(['category', 'creator', 'images'])->findOrFail($id);
        return view('admin.franchises.show', compact('franchise'));
    }

    public function edit($id)
    {
        $franchise = Franchise::with('category', 'images')->findOrFail($id);
        $categories = Category::all();
        return view('admin.franchises.edit', compact('franchise', 'categories'));
    }

    public function update(Request $request, $id){
        $franchise = Franchise::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'short_description' => 'required|string|max:255',
            'description' => 'required|string',
            'investment_min' => 'required|numeric|min:0',
            'investment_max' => 'required|numeric|min:0|gte:investment_min',
            'royalty' => 'required|numeric|min:0|max:100',
            'territory' => 'nullable|string|max:255',
            'requirements' => 'nullable|string',
            'status' => 'required|in:published,draft',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,webp|max:5120',
        ]);

        try {
            // Handle requirements
            $requirements = null;
            if ($request->requirements) {
                $requirementsArray = array_map('trim', explode(',', $request->requirements));
                $requirements = array_filter($requirementsArray);
            }

            // Update franchise (slug will be auto-regenerated if title changed)
            $franchise->update([
                'title' => $request->title,
                'category_id' => $request->category_id,
                'short_description' => $request->short_description,
                'description' => $request->description,
                'investment_min' => $request->investment_min,
                'investment_max' => $request->investment_max,
                'royalty' => $request->royalty,
                'territory' => $request->territory,
                'requirements' => $requirements,
                'status' => $request->status,
            ]);

            // Handle new image upload
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $index => $image) {
                    $path = $image->store('franchises/' . $franchise->id, 'public');

                    \App\Models\FranchiseImage::create([
                        'franchise_id' => $franchise->id,
                        'path' => $path,
                        'alt' => $franchise->title,
                        'order' => $franchise->images()->count() + $index,
                    ]);
                }
            }

            return redirect()->route('admin.franchises.index')
                ->with('success', 'Franchise updated successfully!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Error updating franchise: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $franchise = Franchise::findOrFail($id);

            // Delete associated images from storage
            foreach ($franchise->images as $image) {
                Storage::disk('public')->delete($image->path);
            }

            // Delete the franchise
            $franchise->delete();

            return redirect()->route('admin.franchises.index')
                ->with('success', 'Franchise deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->route('admin.franchises.index')
                ->with('error', 'Error deleting franchise: ' . $e->getMessage());
        }
    }
}