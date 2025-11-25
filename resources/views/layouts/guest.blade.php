<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>@yield('title', config('app.name', 'FranchiseShop'))</title>
    
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
            border-bottom: 1px solid rgba(255, 107, 53, 0.2);
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
    </style>
</head>
<body class="h-full font-sans antialiased bg-gray-900">
    @yield('content')
    
    @stack('scripts')
</body>
</html>