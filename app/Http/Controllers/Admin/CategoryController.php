<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('franchises')->latest()->get();
        return view('admin.categories.index', compact('categories'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories',
        ]);
        
        Category::create([
            'name' => $request->name,
            'slug' => \Str::slug($request->name),
        ]);
        
        return redirect()->route('admin.categories.index')->with('success', 'Category created successfully');
    }
    
    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);
        
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
        ]);
        
        $category->update([
            'name' => $request->name,
            'slug' => \Str::slug($request->name),
        ]);
        
        return redirect()->route('admin.categories.index')->with('success', 'Category updated successfully');
    }
    
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        
        if ($category->franchises()->count() > 0) {
            return redirect()->route('admin.categories.index')->with('error', 'Cannot delete category with associated franchises');
        }
        
        $category->delete();
        
        return redirect()->route('admin.categories.index')->with('success', 'Category deleted successfully');
    }
}