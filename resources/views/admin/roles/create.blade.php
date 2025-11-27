@extends('layouts.admin')

@section('title', 'Create Role - Admin Panel')

@section('header', 'Create Role')

@section('content')
<div class="py-6">
    <div class="max-w-3xl mx-auto">
        <div class="bg-white rounded-xl shadow-sm p-6">
            <h2 class="text-xl font-bold text-gray-900 mb-6">Assign Role to User</h2>
            
            <form action="{{ route('admin.roles.store') }}" method="POST" class="space-y-6">
                @csrf
                
                <div>
                    <label for="user_id" class="block text-sm font-medium text-gray-700 mb-2">Select User</label>
                    <select name="user_id" id="user_id" class="form-input w-full" required>
                        <option value="">Choose a user</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                {{ $user->name }} ({{ $user->email }}) - Current Role: {{ ucfirst($user->role) }}
                            </option>
                        @endforeach
                    </select>
                    @error('user_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Role</label>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <label class="flex items-center p-4 border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50">
                            <input type="radio" name="role" value="user" class="h-4 w-4 text-blue-600" {{ old('role') == 'user' ? 'checked' : '' }} required>
                            <div class="ml-3">
                                <span class="block text-sm font-medium text-gray-700">User</span>
                                <span class="block text-xs text-gray-500 mt-1">Regular user with basic access</span>
                            </div>
                        </label>
                        
                        <label class="flex items-center p-4 border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50">
                            <input type="radio" name="role" value="vendor" class="h-4 w-4 text-blue-600" {{ old('role') == 'vendor' ? 'checked' : '' }} required>
                            <div class="ml-3">
                                <span class="block text-sm font-medium text-gray-700">Vendor</span>
                                <span class="block text-xs text-gray-500 mt-1">Can manage their own franchises</span>
                            </div>
                        </label>
                        
                        <label class="flex items-center p-4 border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50">
                            <input type="radio" name="role" value="operator" class="h-4 w-4 text-blue-600" {{ old('role') == 'operator' ? 'checked' : '' }} required>
                            <div class="ml-3">
                                <span class="block text-sm font-medium text-gray-700">Operator</span>
                                <span class="block text-xs text-gray-500 mt-1">Can handle inquiries and call requests</span>
                            </div>
                        </label>
                        
                        <label class="flex items-center p-4 border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50">
                            <input type="radio" name="role" value="admin" class="h-4 w-4 text-blue-600" {{ old('role') == 'admin' ? 'checked' : '' }} required>
                            <div class="ml-3">
                                <span class="block text-sm font-medium text-gray-700">Admin</span>
                                <span class="block text-xs text-gray-500 mt-1">Full access to all admin features</span>
                            </div>
                        </label>
                    </div>
                    @error('role')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="flex items-center justify-end space-x-4 pt-4">
                    <a href="{{ route('admin.users.index') }}" class="btn-secondary">
                        Cancel
                    </a>
                    <button type="submit" class="btn-primary">
                        Assign Role
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection