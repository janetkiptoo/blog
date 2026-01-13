<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Student Loan Platform')</title>
   @vite('resources/css/app.css')



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