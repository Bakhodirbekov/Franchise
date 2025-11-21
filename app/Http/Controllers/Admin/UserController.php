<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::withCount(['inquiries', 'orders'])
            ->latest()
            ->paginate(10);
            
        return view('admin.users.index', compact('users'));
    }
    
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        
        $request->validate([
            'role' => 'required|in:user,vendor,admin',
        ]);
        
        $user->update([
            'role' => $request->role,
        ]);
        
        return redirect()->route('admin.users.index')
            ->with('success', 'User role updated successfully!');
    }
}