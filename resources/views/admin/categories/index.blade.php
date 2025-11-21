@extends('layouts.app')

@section('title', 'Manage Categories - Admin Panel')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-blue-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Manage Categories</h1>
                <p class="text-gray-600 mt-2">Organize franchises into categories</p>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Add Category Form -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Add New Category</h3>
                    <form action="{{ route('admin.categories.store') }}" method="POST">
                        @csrf
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Category Name</label>
                                <input type="text" name="name" required class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200" placeholder="Enter category name">
                            </div>
                            <button type="submit" class="w-full bg-gradient-to-r from-blue-500 to-purple-600 text-white py-3 rounded-xl font-semibold hover:from-blue-600 hover:to-purple-700 transition duration-200">
                                Add Category
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Categories List -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-900">All Categories ({{ $categories->count() }})</h3>
                    </div>
                    
                    <div class="divide-y divide-gray-200">
                        @forelse($categories as $category)
                        <div class="p-6 hover:bg-gray-50 transition duration-200">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-4">
                                    <div class="w-12 h-12 bg-gradient-to-r from-green-500 to-blue-600 rounded-xl flex items-center justify-center">
                                        <i class="bi bi-tag text-white"></i>
                                    </div>
                                    <div>
                                        <h4 class="text-lg font-semibold text-gray-900">{{ $category->name }}</h4>
                                        <p class="text-sm text-gray-600">{{ $category->franchises_count }} franchises</p>
                                        <p class="text-xs text-gray-500">Slug: {{ $category->slug }}</p>
                                    </div>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <button onclick="editCategory({{ $category->id }}, '{{ $category->name }}')" class="text-green-600 hover:text-green-700 transition duration-200" title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('Are you sure? This will delete the category and all associated franchises!')" class="text-red-600 hover:text-red-700 transition duration-200" title="Delete">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="p-8 text-center">
                            <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                <i class="bi bi-tags text-gray-400 text-2xl"></i>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">No categories yet</h3>
                            <p class="text-gray-600">Create your first category to organize franchises.</p>
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Edit Category Modal -->
<div id="editCategoryModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-2xl shadow-xl max-w-md w-full mx-4">
        <div class="p-6">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold text-gray-900">Edit Category</h3>
                <button onclick="closeEditModal()" class="text-gray-400 hover:text-gray-600 transition duration-200">
                    <i class="bi bi-x-lg text-xl"></i>
                </button>
            </div>
            
            <form id="editCategoryForm" method="POST">
                @csrf
                @method('PUT')
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Category Name</label>
                        <input type="text" name="name" id="editCategoryName" required class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200">
                    </div>
                    <div class="flex space-x-3 pt-2">
                        <button type="button" onclick="closeEditModal()" class="flex-1 bg-gray-100 text-gray-700 py-3 rounded-xl font-medium hover:bg-gray-200 transition duration-200">
                            Cancel
                        </button>
                        <button type="submit" class="flex-1 bg-gradient-to-r from-blue-500 to-purple-600 text-white py-3 rounded-xl font-medium hover:from-blue-600 hover:to-purple-700 transition duration-200">
                            Update Category
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function editCategory(id, name) {
    document.getElementById('editCategoryName').value = name;
    document.getElementById('editCategoryForm').action = `/admin/categories/${id}`;
    document.getElementById('editCategoryModal').classList.remove('hidden');
}

function closeEditModal() {
    document.getElementById('editCategoryModal').classList.add('hidden');
}

// Close modal when clicking outside - setTimeout OLIB TASHLANDI
document.getElementById('editCategoryModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeEditModal();
    }
});
</script>
@endsection