<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Student Loan Platform')</title>
   @vite('resources/css/app.css')
<body class="bg-gray-100">

    <nav class="bg-sky-500 text-black p-4 flex justify-between">
        <div>
            <a href="{{ route('admin.dashboard') }}" class="font-bold">Admin Panel</a>
        </div>
        <div class="space-x-4">
            <a href="#loans" class="px-4 py-2 ">Loan Applications</a>
            <a href="#users" class="px-4 py-2 ">Users</a>
            <a href="#products" class="px-4 py-2 ">Loan Products</a>
            <a href="{{ route('profile.edit') }}" class="px-4 py-2 ">Profile</a>
            <form method="POST" action="{{ route('logout') }}" class="inline">
                @csrf
                <button type="submit">Logout</button>
            </form>
        </div>
    </nav>

    <main class="p-6">
        @yield('content')
    </main>

</body>
</html>
