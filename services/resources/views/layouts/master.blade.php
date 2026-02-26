<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>@yield('title', 'PayShield - Hệ thống quản lý nhân sự')</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    }
                }
            }
        }
    </script>

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    @stack('styles')
</head>

<body class="bg-gray-50 text-gray-800 font-sans antialiased flex flex-col min-h-screen selection:bg-blue-200 selection:text-blue-900">

    @include('partials.navbar')

    <main class="flex-grow w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        @yield('content')
    </main>

    <footer class="bg-white border-t border-gray-200 mt-auto">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row justify-between items-center gap-4">
            <p class="text-sm text-gray-500 font-medium">
                &copy; {{ date('Y') }} PayShield. Hệ thống quản lý nội bộ.
            </p>
            <div class="flex space-x-4 text-sm text-gray-400">
                <span class="hover:text-gray-600 cursor-pointer transition">Hỗ trợ</span>
                <span>&bull;</span>
                <span class="hover:text-gray-600 cursor-pointer transition">Phiên bản 1.0.0</span>
            </div>
        </div>
    </footer>

    <script src="{{ asset('js/app.js') }}"></script>
    
    @stack('scripts')

</body>
</html>