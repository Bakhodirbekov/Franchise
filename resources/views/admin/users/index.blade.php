@extends('layouts.admin')

@section('title', 'Manage Users - Admin Panel')

@section('header', 'Users')

@section('content')
<div class="py-6">
    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Manage Users</h1>
            <p class="text-gray-600 mt-1">View and manage system users</p>
        </div>
    </div>

    <!-- Stats -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
        <div class="stat-card bg-white p-4">
            <div class="text-2xl font-bold text-blue-600">{{ $users->total() }}</div>
            <div class="text-sm text-gray-600">Total Users</div>
        </div>
        <div class="stat-card bg-white p-4">
            <div class="text-2xl font-bold text-green-600">{{ $users->where('role', 'admin')->count() }}</div>
            <div class="text-sm text-gray-600">Admins</div>
        </div>
        <div class="stat-card bg-white p-4">
            <div class="text-2xl font-bold text-purple-600">{{ $users->where('role', 'vendor')->count() }}</div>
            <div class="text-sm text-gray-600">Vendors</div>
        </div>
        <div class="stat-card bg-white p-4">
            <div class="text-2xl font-bold text-gray-600">{{ $users->where('role', 'user')->count() }}</div>
            <div class="text-sm text-gray-600">Regular Users</div>
        </div>
    </div>

    <!-- Users Table -->
    <div class="table-container bg-white">
        <div class="p-6">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-6">
                <h3 class="text-lg font-semibold text-gray-900">All Users</h3>
                
                <!-- Filters Form -->
                <form method="GET" action="{{ route('admin.users.index') }}" class="flex flex-col md:flex-row items-stretch md:items-center gap-3 w-full md:w-auto">
                    <!-- Search -->
                    <div class="relative">
                        <input type="text" 
                               name="search" 
                               value="{{ request('search') }}"
                               placeholder="Search users..." 
                               class="form-input pl-10 pr-4 py-2 w-full md:w-64">
                        <i class="bi bi-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                    </div>
                    
                    <!-- Role Filter -->
                    <select name="role" 
                            onchange="this.form.submit()"
                            class="form-input">
                        <option value="">All Roles</option>
                        <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="vendor" {{ request('role') == 'vendor' ? 'selected' : '' }}>Vendor</option>
                        <option value="user" {{ request('role') == 'user' ? 'selected' : '' }}>User</option>
                    </select>
                    
                    <!-- Sort -->
                    <select name="sort" 
                            onchange="this.form.submit()"
                            class="form-input">
                        <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Latest First</option>
                        <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Oldest First</option>
                        <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>Name A-Z</option>
                    </select>
                    
                    <!-- Search Button -->
                    <button type="submit" class="btn-primary">
                        <i class="bi bi-filter mr-2"></i>Filter
                    </button>
                    
                    <!-- Reset Button -->
                    @if(request()->anyFilled(['search', 'role', 'sort']))
                        <a href="{{ route('admin.users.index') }}" class="btn-secondary">
                            <i class="bi bi-x-circle"></i> Reset
                        </a>
                    @endif
                </form>
            </div>
            
            <!-- Active Filters -->
            @if(request()->anyFilled(['search', 'role']))
                <div class="mb-4 flex items-center gap-2 flex-wrap">
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
                            <td colspan="5" class="px-6 py-12 text-center">
                                <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <i class="bi bi-people text-gray-400 text-3xl"></i>
                                </div>
                                <h3 class="text-lg font-semibold text-gray-900 mb-2">No users found</h3>
                                <p class="text-gray-600">Try adjusting your search or filter criteria.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if ($users->hasPages())
                <div class="px-6 py-4 border-t border-gray-200">
                    {{ $users->links() }}
                </div>
            @endif
        </div>
    </div>
</div>

<!-- User Details Modal -->
<div id="userDetailsModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-2xl shadow-xl max-w-2xl w-full mx-4 max-h-[90vh] overflow-y-auto">
        <div class="p-6">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold text-gray-900">User Details</h3>
                <button onclick="closeUserDetailsModal()" class="text-gray-400 hover:text-gray-600 transition duration-200">
                    <i class="bi bi-x-lg text-xl"></i>
                </button>
            </div>
            
            <div id="userDetailsContent">
                <!-- User details will be loaded here via AJAX -->
            </div>
        </div>
    </div>
</div>

<!-- Role Change Confirmation Modal -->
<div id="roleChangeModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-2xl shadow-xl max-w-md w-full mx-4">
        <div class="p-6">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold text-gray-900">Change User Role</h3>
                <button onclick="closeRoleChangeModal()" class="text-gray-400 hover:text-gray-600 transition duration-200">
                    <i class="bi bi-x-lg text-xl"></i>
                </button>
            </div>
            
            <form id="roleChangeForm" method="POST">
                @csrf
                @method('PUT')
                <div class="space-y-4">
                    <p id="roleChangeMessage" class="text-gray-700"></p>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">New Role</label>
                        <select name="role" id="newRole" class="form-input w-full">
                            <option value="user">User</option>
                            <option value="vendor">Vendor</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>
                    
                    <div class="flex space-x-3 pt-2">
                        <button type="button" onclick="closeRoleChangeModal()" class="btn-secondary flex-1">
                            Cancel
                        </button>
                        <button type="submit" class="btn-primary flex-1">
                            Change Role
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div id="deleteUserModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-2xl shadow-xl max-w-md w-full mx-4">
        <div class="p-6">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold text-gray-900">Delete User</h3>
                <button onclick="closeDeleteUserModal()" class="text-gray-400 hover:text-gray-600 transition duration-200">
                    <i class="bi bi-x-lg text-xl"></i>
                </button>
            </div>
            
            <form id="deleteUserForm" method="POST">
                @csrf
                @method('DELETE')
                <div class="space-y-4">
                    <p id="deleteUserMessage" class="text-gray-700"></p>
                    
                    <div class="flex space-x-3 pt-2">
                        <button type="button" onclick="closeDeleteUserModal()" class="btn-secondary flex-1">
                            Cancel
                        </button>
                        <button type="submit" class="bg-red-600 text-white py-2 px-4 rounded-lg font-medium hover:bg-red-700 transition duration-200 flex-1">
                            Delete User
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
// View User Details
function viewUserDetails(userId) {
    fetch(`/admin/users/${userId}`)
        .then(response => response.json())
        .then(data => {
            document.getElementById('userDetailsContent').innerHTML = `
                <div class="space-y-6">
                    <div class="flex items-center space-x-4">
                        <div class="w-16 h-16 bg-gradient-to-r from-blue-500 to-purple-600 rounded-full flex items-center justify-center text-white font-bold text-xl">
                            ${data.name.charAt(0).toUpperCase()}
                        </div>
                        <div>
                            <h4 class="text-xl font-bold text-gray-900">${data.name}</h4>
                            <p class="text-gray-600">${data.email}</p>
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium 
                                ${data.role === 'admin' ? 'bg-purple-100 text-purple-800' : ''} 
                                ${data.role === 'vendor' ? 'bg-green-100 text-green-800' : ''} 
                                ${data.role === 'user' ? 'bg-gray-100 text-gray-800' : ''}">
                                ${data.role.charAt(0).toUpperCase() + data.role.slice(1)}
                            </span>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h5 class="font-medium text-gray-900 mb-2">Contact Information</h5>
                            <p class="text-sm text-gray-600"><i class="bi bi-envelope mr-2"></i> ${data.email}</p>
                            ${data.phone ? `<p class="text-sm text-gray-600 mt-1"><i class="bi bi-telephone mr-2"></i> ${data.phone}</p>` : ''}
                            ${data.company ? `<p class="text-sm text-gray-600 mt-1"><i class="bi bi-building mr-2"></i> ${data.company}</p>` : ''}
                        </div>
                        
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h5 class="font-medium text-gray-900 mb-2">Activity</h5>
                            <p class="text-sm text-gray-600"><i class="bi bi-calendar mr-2"></i> Joined: ${new Date(data.created_at).toLocaleDateString()}</p>
                            <p class="text-sm text-gray-600 mt-1"><i class="bi bi-chat-dots mr-2"></i> Inquiries: ${data.inquiries_count}</p>
                            <p class="text-sm text-gray-600 mt-1"><i class="bi bi-receipt mr-2"></i> Orders: ${data.orders_count}</p>
                        </div>
                    </div>
                    
                    ${data.inquiries.length > 0 ? `
                        <div>
                            <h5 class="font-medium text-gray-900 mb-2">Recent Inquiries</h5>
                            <div class="space-y-2">
                                ${data.inquiries.slice(0, 3).map(inquiry => `
                                    <div class="border border-gray-200 rounded-lg p-3">
                                        <div class="flex justify-between">
                                            <span class="font-medium text-gray-900">${inquiry.subject}</span>
                                            <span class="text-xs px-2 py-1 rounded-full 
                                                ${inquiry.status === 'pending' ? 'bg-yellow-100 text-yellow-800' : ''} 
                                                ${inquiry.status === 'processing' ? 'bg-blue-100 text-blue-800' : ''} 
                                                ${inquiry.status === 'resolved' ? 'bg-green-100 text-green-800' : ''}">
                                                ${inquiry.status.charAt(0).toUpperCase() + inquiry.status.slice(1)}
                                            </span>
                                        </div>
                                        <p class="text-sm text-gray-600 mt-1">${new Date(inquiry.created_at).toLocaleDateString()}</p>
                                    </div>
                                `).join('')}
                            </div>
                        </div>
                    ` : ''}
                </div>
            `;
            document.getElementById('userDetailsModal').classList.remove('hidden');
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error loading user details');
        });
}

function closeUserDetailsModal() {
    document.getElementById('userDetailsModal').classList.add('hidden');
}

// Role Change
function confirmRoleChange(userId, currentRole) {
    document.getElementById('roleChangeMessage').innerHTML = `Are you sure you want to change this user's role from <span class="font-semibold">${currentRole}</span>?`;
    document.getElementById('newRole').value = currentRole;
    document.getElementById('roleChangeForm').action = `/admin/users/${userId}`;
    document.getElementById('roleChangeModal').classList.remove('hidden');
}

function closeRoleChangeModal() {
    document.getElementById('roleChangeModal').classList.add('hidden');
}

// Delete User
function deleteUser(userId, userName) {
    document.getElementById('deleteUserMessage').innerHTML = `Are you sure you want to delete <span class="font-semibold">${userName}</span>? This action cannot be undone.`;
    document.getElementById('deleteUserForm').action = `/admin/users/${userId}`;
    document.getElementById('deleteUserModal').classList.remove('hidden');
}

function closeDeleteUserModal() {
    document.getElementById('deleteUserModal').classList.add('hidden');
}

// Close modals when clicking outside
document.querySelectorAll('#userDetailsModal, #roleChangeModal, #deleteUserModal').forEach(modal => {
    modal.addEventListener('click', function(e) {
        if (e.target === this) {
            this.classList.add('hidden');
        }
    });
});
</script>
@endsection