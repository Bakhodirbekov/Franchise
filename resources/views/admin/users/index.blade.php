@extends('layouts.app')

@section('title', 'Manage Users - Admin Panel')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-blue-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Manage Users</h1>
                <p class="text-gray-600 mt-2">View and manage system users</p>
            </div>
        </div>

        <!-- Stats -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
            <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-200">
                <div class="text-2xl font-bold text-blue-600">{{ $users->total() }}</div>
                <div class="text-sm text-gray-600">Total Users</div>
            </div>
            <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-200">
                <div class="text-2xl font-bold text-green-600">{{ $users->where('role', 'admin')->count() }}</div>
                <div class="text-sm text-gray-600">Admins</div>
            </div>
            <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-200">
                <div class="text-2xl font-bold text-purple-600">{{ $users->where('role', 'vendor')->count() }}</div>
                <div class="text-sm text-gray-600">Vendors</div>
            </div>
            <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-200">
                <div class="text-2xl font-bold text-gray-600">{{ $users->where('role', 'user')->count() }}</div>
                <div class="text-sm text-gray-600">Regular Users</div>
            </div>
        </div>

        <!-- Users Table -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200">
                <div class="flex justify-between items-center">
                    <h3 class="text-lg font-semibold text-gray-900">All Users</h3>
                    <div class="flex items-center space-x-4">
                        <input type="text" placeholder="Search users..." class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <select class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="">All Roles</option>
                            <option value="admin">Admin</option>
                            <option value="vendor">Vendor</option>
                            <option value="user">User</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Contact</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Role</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Joined</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($users as $user)
                        <tr class="hover:bg-gray-50 transition duration-200">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10 bg-gradient-to-r from-blue-500 to-purple-600 rounded-full flex items-center justify-center text-white font-bold">
                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">{{ $user->name }}</div>
                                        @if($user->company)
                                            <div class="text-sm text-gray-500">{{ $user->company }}</div>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $user->email }}</div>
                                <div class="text-sm text-gray-500">{{ $user->phone }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <form action="{{ route('admin.users.update', $user->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('PUT')
                                    <select name="role" 
                                            onchange="this.form.submit()"
                                            class="text-sm border border-gray-300 rounded-lg px-3 py-1 focus:ring-2 focus:ring-blue-500 focus:border-blue-500
                                                {{ $user->role === 'admin' ? 'bg-purple-100 text-purple-800' : '' }}
                                                {{ $user->role === 'vendor' ? 'bg-green-100 text-green-800' : '' }}
                                                {{ $user->role === 'user' ? 'bg-gray-100 text-gray-800' : '' }}">
                                        <option value="user" {{ $user->role === 'user' ? 'selected' : '' }}>User</option>
                                        <option value="vendor" {{ $user->role === 'vendor' ? 'selected' : '' }}>Vendor</option>
                                        <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                                    </select>
                                </form>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $user->created_at->format('M d, Y') }}
                                <div class="text-xs text-gray-400">{{ $user->created_at->diffForHumans() }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex items-center space-x-2">
                                    <span class="text-xs text-gray-500">
                                        {{ $user->inquiries_count }} inquiries
                                    </span>
                                    <span class="text-xs text-gray-500">
                                        {{ $user->orders_count }} orders
                                    </span>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-6 py-8 text-center">
                                <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <i class="bi bi-people text-gray-400 text-3xl"></i>
                                </div>
                                <h3 class="text-lg font-semibold text-gray-900 mb-2">No users found</h3>
                                <p class="text-gray-600">Users will appear here when they register.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($users->hasPages())
            <div class="px-6 py-4 border-t border-gray-200">
                {{ $users->links() }}
            </div>
            @endif
        </div>
    </div>
</div>
@endsection