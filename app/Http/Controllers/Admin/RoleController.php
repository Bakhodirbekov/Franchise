<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class RoleController extends Controller
{
    /**
     * Show the form for creating a new role.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        // Get all users for the role assignment dropdown
        $users = User::all();
        
        return view('admin.roles.create', compact('users'));
    }

    /**
     * Store a newly created role in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'role' => 'required|in:user,vendor,admin,operator',
        ]);

        $user = User::findOrFail($request->user_id);
        
        // Prevent changing own role
        if ($user->id === auth()->id()) {
            return redirect()->back()
                ->with('error', 'You cannot change your own role!')
                ->withInput();
        }
        
        $oldRole = $user->role;
        $user->update([
            'role' => $request->role,
        ]);
        
        // If the user whose role was changed is currently logged in, refresh their session
        if (Auth::check() && Auth::id() === $user->id) {
            // Refresh the user instance in the session by re-retrieving from database
            Auth::setUser(User::find($user->id));
        }
        
        return redirect()->route('admin.users.index')
            ->with('success', 'User role updated successfully from ' . $oldRole . ' to ' . $request->role . '!');
    }
}