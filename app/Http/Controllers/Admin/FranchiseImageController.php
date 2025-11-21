<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FranchiseImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FranchiseImageController extends Controller
{
    public function destroy($id)
    {
        try {
            $image = FranchiseImage::findOrFail($id);
            
            // Delete image file from storage
            Storage::disk('public')->delete($image->path);
            
            // Delete image record from database
            $image->delete();

            return redirect()->back()
                ->with('success', 'Image deleted successfully!');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error deleting image: ' . $e->getMessage());
        }
    }
}