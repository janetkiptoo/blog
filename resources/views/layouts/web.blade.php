<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Student Loan Platform')</title>
   @vite('resources/css/app.css')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-pVjZ1d4w+v2X0v4+ZfD9M3xKUPTQ9nRj3O5sVj4+dsPZwTTXG6lgp+zQ/tV0d0evzXfKKl8HYNhU55qlu1g0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />



    <style></style>
</head>
<body class="bg-white min-h-screen flex flex-col justify-between">
   
@include('layouts.navbar')

<main>
    @yield('content')
</main>

@include('layouts.footer')
    
</body>
</html>