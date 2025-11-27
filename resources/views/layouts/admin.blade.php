<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Admin Panel - DarkRock')</title>
    <meta name="description" content="Admin Panel for DarkRock Franchise Management">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800&display=swap" rel="stylesheet" />

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">

    <!-- Custom Styles -->
    <style>
        * {
            font-family: 'Inter', sans-serif;
        }
        
        .gradient-darkrock {
            background: linear-gradient(135deg, #1a1a1a 0%, #2d2d2d 50%, #1a1a1a 100%);
        }
        
        .gradient-accent {
            background: linear-gradient(135deg, #ff6b35 0%, #f7931e 100%);
        }

        .card-hover {
            transition: all 0.3s ease;
        }

        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(255, 107, 53, 0.2);
        }

        .nav-darkrock {
            backdrop-filter: blur(10px);
            background: rgba(26, 26, 26, 0.95);
            border-right: 1px solid rgba(255, 107, 53, 0.2);
        }
        
        .text-accent {
            color: #ff6b35;
        }
        
        .bg-accent {
            background-color: #ff6b35;
        }
        
        .border-accent {
            border-color: #ff6b35;
        }
        
        /* TailPanel-inspired styles */
        .sidebar {
            transition: all 0.3s ease;
            background: #1e293b;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }
        
        .sidebar-nav-item {
            transition: all 0.2s ease;
            border-radius: 0.5rem;
            margin-bottom: 0.25rem;
        }
        
        .sidebar-nav-item:hover {
            background: #334155;
        }
        
        .sidebar-nav-item.active {
            background: #0ea5e9;
            color: white;
        }
        
        .topbar {
            background: #f8fafc;
            border-bottom: 1px solid #e2e8f0;
        }
        
        .content-area {
            background: #f1f5f9;
        }
        
        .stat-card {
            transition: all 0.2s ease;
            border-radius: 0.75rem;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
        }
        
        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }
        
        .table-container {
            border-radius: 0.75rem;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
        }
        
        /* Main content styles */
        .main-content {
            transition: all 0.3s ease;
        }
        
        /* Button styles */
        .btn-primary {
            background: linear-gradient(135deg, #0ea5e9 0%, #0284c7 100%);
            color: white;
            border-radius: 0.5rem;
            padding: 0.5rem 1rem;
            font-weight: 500;
            transition: all 0.2s ease;
        }
        
        .btn-primary:hover {
            opacity: 0.9;
            transform: translateY(-1px);
        }
        
        .btn-secondary {
            background: #f1f5f9;
            color: #334155;
            border-radius: 0.5rem;
            padding: 0.5rem 1rem;
            font-weight: 500;
            transition: all 0.2s ease;
        }
        
        .btn-secondary:hover {
            background: #e2e8f0;
        }
        
        /* Form styles */
        .form-input {
            border: 1px solid #cbd5e1;
            border-radius: 0.5rem;
            padding: 0.5rem 1rem;
            transition: all 0.2s ease;
        }
        
        .form-input:focus {
            outline: none;
            border-color: #0ea5e9;
            box-shadow: 0 0 0 3px rgba(14, 165, 233, 0.2);
        }
        
        /* Badge styles */
        .badge {
            display: inline-flex;
            align-items: center;
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 500;
        }
    </style>

    @stack('styles')
</head>

<body class="h-full font-sans antialiased">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <aside class="sidebar w-64 fixed left-0 top-0 h-full z-50">
            <div class="flex flex-col h-full p-4">
                <!-- Logo -->
                <div class="p-4 border-b border-gray-700 mb-4">
                    <div class="flex items-center space-x-3">
                        <img src="{{ asset('images/logo.png') }}" alt="DarkRock Logo" class="w-10 h-10 rounded-lg object-contain">
                        <div>
                            <span class="text-xl font-black text-white tracking-tight">DARK<span class="text-accent">ROCK</span></span>
                            <p class="text-xs text-gray-400">ADMIN PANEL</p>
                        </div>
                    </div>
                </div>
                
                <!-- Navigation -->
                <nav class="flex-1 overflow-y-auto">
                    <ul class="space-y-1">
                        <li>
                            <a href="{{ route('admin.dashboard') }}" 
                               class="sidebar-nav-item flex items-center space-x-3 p-3 {{ request()->routeIs('admin.dashboard') ? 'active' : 'text-gray-300' }}">
                                <i class="bi bi-speedometer2 text-lg"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.franchises.index') }}" 
                               class="sidebar-nav-item flex items-center space-x-3 p-3 {{ request()->routeIs('admin.franchises.*') ? 'active' : 'text-gray-300' }}">
                                <i class="bi bi-shop text-lg"></i>
                                <span>Franchises</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.categories.index') }}" 
                               class="sidebar-nav-item flex items-center space-x-3 p-3 {{ request()->routeIs('admin.categories.*') ? 'active' : 'text-gray-300' }}">
                                <i class="bi bi-tags text-lg"></i>
                                <span>Categories</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.inquiries.index') }}" 
                               class="sidebar-nav-item flex items-center space-x-3 p-3 {{ request()->routeIs('admin.inquiries.*') ? 'active' : 'text-gray-300' }}">
                                <i class="bi bi-chat-dots text-lg"></i>
                                <span>Inquiries</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.call-requests.index') }}" 
                               class="sidebar-nav-item flex items-center space-x-3 p-3 {{ request()->routeIs('admin.call-requests.*') ? 'active' : 'text-gray-300' }}">
                                <i class="bi bi-telephone text-lg"></i>
                                <span>Call Requests</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.users.index') }}" 
                               class="sidebar-nav-item flex items-center space-x-3 p-3 {{ request()->routeIs('admin.users.*') ? 'active' : 'text-gray-300' }}">
                                <i class="bi bi-people text-lg"></i>
                                <span>Users</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.roles.create') }}" 
                               class="sidebar-nav-item flex items-center space-x-3 p-3 {{ request()->routeIs('admin.roles.*') ? 'active' : 'text-gray-300' }}">
                                <i class="bi bi-person-badge text-lg"></i>
                                <span>Create Role</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('operator.dashboard') }}" 
                               class="sidebar-nav-item flex items-center space-x-3 p-3 {{ request()->routeIs('operator.*') ? 'active' : 'text-gray-300' }}">
                                <i class="bi bi-headset text-lg"></i>
                                <span>Operator Panel</span>
                            </a>
                        </li>
                    </ul>
                </nav>
                
                <!-- User Profile -->
                <div class="p-4 border-t border-gray-700 mt-4">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 gradient-accent rounded-full flex items-center justify-center text-gray-900 font-bold">
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </div>
                        <div>
                            <p class="font-semibold text-white">{{ auth()->user()->name }}</p>
                            <p class="text-xs text-gray-400">Administrator</p>
                        </div>
                    </div>
                    <div class="mt-4">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full text-left text-sm text-red-400 hover:text-red-300 flex items-center space-x-2">
                                <i class="bi bi-box-arrow-right"></i>
                                <span>Logout</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </aside>
        
        <!-- Main Content -->
        <main class="main-content flex-1 ml-64 overflow-y-auto">
            <!-- Top Bar -->
            <header class="topbar sticky top-0 z-40">
                <div class="flex justify-between items-center p-4">
                    <div class="flex items-center space-x-4">
                        <h1 class="text-xl font-bold text-gray-900">@yield('header', 'Admin Panel')</h1>
                    </div>
                    <div class="flex items-center space-x-4">
                        <span class="text-sm text-gray-600">{{ now()->format('M d, Y - h:i A') }}</span>
                        <div class="w-8 h-8 gradient-accent rounded-full flex items-center justify-center text-gray-900 font-bold">
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </div>
                    </div>
                </div>
            </header>
            
            <!-- Page Content -->
            <div class="content-area min-h-screen p-6">
                @include('components.flash')
                @yield('content')
            </div>
        </main>
    </div>

    @stack('scripts')
</body>

</html>