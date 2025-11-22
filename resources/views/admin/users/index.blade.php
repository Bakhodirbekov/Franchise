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
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                    <h3 class="text-lg font-semibold text-gray-900">All Users</h3>
                    
                    <!-- Filters Form -->
                    <form method="GET" action="{{ route('admin.users.index') }}" class="flex flex-col md:flex-row items-stretch md:items-center gap-3 w-full md:w-auto">
                        <!-- Search -->
                        <div class="relative">
                            <input type="text" 
                                   name="search" 
                                   value="{{ request('search') }}"
                                   placeholder="Search users..." 
                                   class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 w-full md:w-64">
                            <i class="bi bi-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                        </div>
                        
                        <!-- Role Filter -->
                        <select name="role" 
                                onchange="this.form.submit()"
                                class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="">All Roles</option>
                            <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="vendor" {{ request('role') == 'vendor' ? 'selected' : '' }}>Vendor</option>
                            <option value="user" {{ request('role') == 'user' ? 'selected' : '' }}>User</option>
                        </select>
                        
                        <!-- Sort -->
                        <select name="sort" 
                                onchange="this.form.submit()"
                                class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Latest First</option>
                            <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Oldest First</option>
                            <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>Name A-Z</option>
                        </select>
                        
                        <!-- Search Button -->
                        <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition duration-200">
                            <i class="bi bi-filter mr-2"></i>Filter
                        </button>
                        
                        <!-- Reset Button -->
                        @if(request()->anyFilled(['search', 'role', 'sort']))
                            <a href="{{ route('admin.users.index') }}" class="bg-gray-100 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-200 transition duration-200 text-center">
                                <i class="bi bi-x-circle"></i> Reset
                            </a>
                        @endif
                    </form>
                </div>
                
                <!-- Active Filters -->
                @if(request()->anyFilled(['search', 'role']))
                    <div class="mt-4 flex items-center gap-2 flex-wrap">
                        <span class="text-sm text-gray-600">Active filters:</span>
                        @if(request('search'))
                            <span class="inline-flex items-center px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm">
                                Search: "{{ request('search') }}"
                            </span>
                        @endif
                        @if(request('role'))
                            <span class="inline-flex items-center px-3 py-1 bg-purple-100 text-purple-800 rounded-full text-sm">
                                Role: {{ ucfirst(request('role')) }}
                            </span>
                        @endif
                    </div>
                @endif
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
                                <div class="flex items-center space-x-4">
                                    <!-- Inquiries Count -->
                                    <div class="flex items-center space-x-1 text-gray-600">
                                        <i class="bi bi-chat-dots"></i>
                                        <span class="text-xs">{{ $user->inquiries_count }}</span>
                                    </div>
                                    
                                    <!-- Orders Count -->
                                    <div class="flex items-center space-x-1 text-gray-600">
                                        <i class="bi bi-receipt"></i>
                                        <span class="text-xs">{{ $user->orders_count }}</span>
                                    </div>
                                    
                                    <!-- Divider -->
                                    <div class="h-4 w-px bg-gray-300"></div>
                                    
                                    <!-- View Details -->
                                    <button onclick="viewUserDetails({{ $user->id }})" 
                                            class="text-blue-600 hover:text-blue-800 transition duration-200"
                                            title="View Details">
                                        <i class="bi bi-eye text-lg"></i>
                                    </button>
                                    
                                    <!-- Change Role -->
                                    @if($user->id !== auth()->id())
                                        <button onclick="confirmRoleChange({{ $user->id }}, '{{ $user->role }}')" 
                                                class="text-purple-600 hover:text-purple-800 transition duration-200"
                                                title="Change Role">
                                            <i class="bi bi-person-gear text-lg"></i>
                                        </button>
                                    @else
                                        <span class="text-gray-400" title="You cannot change your own role">
                                            <i class="bi bi-person-lock text-lg"></i>
                                        </span>
                                    @endif
                                    
                                    <!-- Delete User -->
                                    @if($user->id !== auth()->id())
                                        <button onclick="deleteUser({{ $user->id }}, '{{ $user->name }}')" 
                                                class="text-red-600 hover:text-red-800 transition duration-200"
                                                title="Delete User">
                                            <i class="bi bi-trash text-lg"></i>
                                        </button>
                                    @endif
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

<!-- User Details Modal -->
<div id="userDetailsModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-2xl shadow-xl max-w-2xl w-full mx-4">
        <div class="p-6">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-xl font-semibold text-gray-900">User Details</h3>
                <button onclick="closeDetailsModal()" class="text-gray-400 hover:text-gray-600 transition duration-200">
                    <i class="bi bi-x-lg text-xl"></i>
                </button>
            </div>
            
            <div id="userDetailsContent" class="space-y-4">
                <!-- Content will be loaded here -->
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div id="deleteUserModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-2xl shadow-xl max-w-md w-full mx-4">
        <div class="p-6">
            <div class="flex items-center mb-4">
                <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center mr-4">
                    <i class="bi bi-exclamation-triangle text-red-600 text-xl"></i>
                </div>
                <h3 class="text-lg font-semibold text-gray-900">Delete User</h3>
            </div>
            
            <p class="text-gray-600 mb-6">Are you sure you want to delete <strong id="deleteUserName"></strong>? This action cannot be undone.</p>
            
            <form id="deleteUserForm" method="POST" action="">
                @csrf
                @method('DELETE')
                
                <div class="flex justify-end space-x-3">
                    <button type="button" onclick="closeDeleteModal()" 
                            class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition duration-200">
                        Cancel
                    </button>
                    <button type="submit" 
                            class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition duration-200">
                        <i class="bi bi-trash mr-2"></i>Delete User
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Role Change Modal -->
<div id="roleChangeModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-2xl shadow-xl max-w-md w-full mx-4">
        <div class="p-6">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold text-gray-900">Change User Role</h3>
                <button onclick="closeRoleModal()" class="text-gray-400 hover:text-gray-600 transition duration-200">
                    <i class="bi bi-x-lg text-xl"></i>
                </button>
            </div>
            
            <p class="text-gray-600 mb-6">Select a new role for this user:</p>
            
            <form id="roleChangeForm" method="POST" action="">
                @csrf
                @method('PUT')
                
                <div class="space-y-3">
                    <button type="button" onclick="submitRole('user')" 
                            class="w-full flex items-center justify-between px-4 py-3 border-2 border-gray-200 rounded-xl hover:border-blue-500 hover:bg-blue-50 transition duration-200">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-gray-100 rounded-full flex items-center justify-center mr-3">
                                <i class="bi bi-person text-gray-600"></i>
                            </div>
                            <div class="text-left">
                                <div class="font-semibold text-gray-900">User</div>
                                <div class="text-xs text-gray-500">Standard user access</div>
                            </div>
                        </div>
                        <i class="bi bi-arrow-right text-gray-400"></i>
                    </button>
                    
                    <button type="button" onclick="submitRole('vendor')" 
                            class="w-full flex items-center justify-between px-4 py-3 border-2 border-gray-200 rounded-xl hover:border-green-500 hover:bg-green-50 transition duration-200">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center mr-3">
                                <i class="bi bi-shop text-green-600"></i>
                            </div>
                            <div class="text-left">
                                <div class="font-semibold text-gray-900">Vendor</div>
                                <div class="text-xs text-gray-500">Can manage franchises</div>
                            </div>
                        </div>
                        <i class="bi bi-arrow-right text-gray-400"></i>
                    </button>
                    
                    <button type="button" onclick="submitRole('admin')" 
                            class="w-full flex items-center justify-between px-4 py-3 border-2 border-gray-200 rounded-xl hover:border-purple-500 hover:bg-purple-50 transition duration-200">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-purple-100 rounded-full flex items-center justify-center mr-3">
                                <i class="bi bi-shield-check text-purple-600"></i>
                            </div>
                            <div class="text-left">
                                <div class="font-semibold text-gray-900">Admin</div>
                                <div class="text-xs text-gray-500">Full system access</div>
                            </div>
                        </div>
                        <i class="bi bi-arrow-right text-gray-400"></i>
                    </button>
                </div>
                
                <input type="hidden" name="role" id="selectedRole" value="">
            </form>
        </div>
    </div>
</div>

<script>
let currentUserId = null;

// View User Details
function viewUserDetails(userId) {
    const user = @json($users->items());
    const userData = user.find(u => u.id === userId);
    
    if (userData) {
        const content = `
            <div class="grid grid-cols-2 gap-4">
                <div class="col-span-2 border-b pb-4">
                    <div class="flex items-center">
                        <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mr-4">
                            <i class="bi bi-person-fill text-blue-600 text-2xl"></i>
                        </div>
                        <div>
                            <h4 class="text-xl font-semibold text-gray-900">${userData.name}</h4>
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium mt-1
                                ${userData.role === 'admin' ? 'bg-purple-100 text-purple-800' : ''}
                                ${userData.role === 'vendor' ? 'bg-green-100 text-green-800' : ''}
                                ${userData.role === 'user' ? 'bg-gray-100 text-gray-800' : ''}">
                                ${userData.role.charAt(0).toUpperCase() + userData.role.slice(1)}
                            </span>
                        </div>
                    </div>
                </div>
                
                <div>
                    <label class="text-sm text-gray-500">Email</label>
                    <p class="text-gray-900 font-medium">${userData.email}</p>
                </div>
                
                <div>
                    <label class="text-sm text-gray-500">Phone</label>
                    <p class="text-gray-900 font-medium">${userData.phone || 'N/A'}</p>
                </div>
                
                <div>
                    <label class="text-sm text-gray-500">Company</label>
                    <p class="text-gray-900 font-medium">${userData.company || 'N/A'}</p>
                </div>
                
                <div>
                    <label class="text-sm text-gray-500">Joined Date</label>
                    <p class="text-gray-900 font-medium">${new Date(userData.created_at).toLocaleDateString()}</p>
                </div>
                
                <div class="col-span-2 border-t pt-4 mt-4">
                    <h5 class="font-semibold text-gray-900 mb-3">Activity Statistics</h5>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="bg-blue-50 p-3 rounded-lg">
                            <div class="flex items-center">
                                <i class="bi bi-chat-dots text-blue-600 text-xl mr-3"></i>
                                <div>
                                    <p class="text-2xl font-bold text-blue-600">${userData.inquiries_count}</p>
                                    <p class="text-sm text-gray-600">Inquiries</p>
                                </div>
                            </div>
                        </div>
                        <div class="bg-green-50 p-3 rounded-lg">
                            <div class="flex items-center">
                                <i class="bi bi-receipt text-green-600 text-xl mr-3"></i>
                                <div>
                                    <p class="text-2xl font-bold text-green-600">${userData.orders_count}</p>
                                    <p class="text-sm text-gray-600">Orders</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        `;
        
        document.getElementById('userDetailsContent').innerHTML = content;
        document.getElementById('userDetailsModal').classList.remove('hidden');
    }
}

function closeDetailsModal() {
    document.getElementById('userDetailsModal').classList.add('hidden');
}

// Change Role
function confirmRoleChange(userId, currentRole) {
    currentUserId = userId;
    document.getElementById('roleChangeModal').classList.remove('hidden');
}

function closeRoleModal() {
    document.getElementById('roleChangeModal').classList.add('hidden');
    currentUserId = null;
}

function submitRole(role) {
    if (currentUserId) {
        const form = document.getElementById('roleChangeForm');
        form.action = `/admin/users/${currentUserId}`;
        document.getElementById('selectedRole').value = role;
        form.submit();
    }
}

// Delete User
function deleteUser(userId, userName) {
    document.getElementById('deleteUserName').textContent = userName;
    document.getElementById('deleteUserForm').action = `/admin/users/${userId}`;
    document.getElementById('deleteUserModal').classList.remove('hidden');
}

function closeDeleteModal() {
    document.getElementById('deleteUserModal').classList.add('hidden');
}

// Close modals when clicking outside
document.getElementById('roleChangeModal')?.addEventListener('click', function(e) {
    if (e.target === this) {
        closeRoleModal();
    }
});

document.getElementById('userDetailsModal')?.addEventListener('click', function(e) {
    if (e.target === this) {
        closeDetailsModal();
    }
});

document.getElementById('deleteUserModal')?.addEventListener('click', function(e) {
    if (e.target === this) {
        closeDeleteModal();
    }
});
</script>
@endsection