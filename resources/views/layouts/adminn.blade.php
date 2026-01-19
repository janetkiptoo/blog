<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Student Loan Platform')</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 flex min-h-screen">


    <nav class="bg-blue-800 w-64 flex-shrink-0 p-6 flex flex-col">
        <div class="mb-8">
            <a href="{{ route('admin.dashboard') }}" class="text-white text-2xl font-bold block mb-6">Admin Panel</a>
        </div>
        
        <a href="{{ route('admin.users.index') }}" class="text-white py-2 px-3 rounded hover:bg-sky-600 mb-2">Users</a>
        <a href="{{ route('admin.loans') }}" class="text-white py-2 px-3 rounded hover:bg-sky-600 mb-2">Loan Applications</a>
        <a href="{{ route('admin.loan-products.index') }}" class="text-white py-2 px-3 rounded hover:bg-sky-600 mb-2">Loan Products</a>
         <a href="{{ route('admin.loan-products.create') }}" class="text-white py-2 px-3 rounded hover:bg-sky-600 mb-2">Loan Products add</a>
       

        <form method="POST" action="{{ route('logout') }}" class="mt-auto">
            @csrf
            <button type="submit" class="w-full text-left text-black py-2 px-3 rounded hover:bg-sky-600">
                Logout
            </button>
        </form>
    </nav>

    <!-- Main content -->
    <main class="flex-1 p-6">
        @yield('content')
    </main>

</body>
</html>
