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
        
        
        <div class="flex items-center text-white mb-6">
 
 <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" viewBox="0 0 24 24">
  <path fill-rule="evenodd" d="M11.293 3.293a1 1 0 0 1 1.414 0l6 6 2 2a1 1 0 0 1-1.414 1.414L19 12.414V19a2 2 0 0 1-2 2h-3a1 1 0 0 1-1-1v-3h-2v3a1 1 0 0 1-1 1H7a2 2 0 0 1-2-2v-6.586l-.293.293a1 1 0 0 1-1.414-1.414l2-2 6-6Z" clip-rule="evenodd"/>
</svg>
  <span class="ml-2"><a href="{{ route('admin.dashboard') }}" class="text-white py-2 px-3 rounded mb-2">Dashboard</a></span>
</div>

 <div class="flex items-center text-white mb-6">
 <svg class="w-[32px] h-[32px] text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24">
  <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="M4.5 17H4a1 1 0 0 1-1-1 3 3 0 0 1 3-3h1m0-3.05A2.5 2.5 0 1 1 9 5.5M19.5 17h.5a1 1 0 0 0 1-1 3 3 0 0 0-3-3h-1m0-3.05a2.5 2.5 0 1 0-2-4.45m.5 13.5h-7a1 1 0 0 1-1-1 3 3 0 0 1 3-3h3a3 3 0 0 1 3 3 1 1 0 0 1-1 1Zm-1-9.5a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0Z"/>
</svg>
  <a href="{{ route('admin.users.index') }}" class="text-white py-2 px-3 rounded 0 mb-2">Users</a>
</div>

<div class="flex items-center text-white mb-6">
 <svg class="w-[32px] h-[32px] mr-3 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m-6-8h6M7 20h10a2 2 0 002-2V6a2 2 0 00-2-2H7a2 2 0 00-2 2v12a2 2 0 002 2z"/>
    </svg>
 <a href="{{ route('admin.loans') }}" class="text-white py-2 px-3  mb-2">Loan Applications</a>
</div>

<div class="flex items-center text-white mb-6">
<svg class="w-[32px] h-[32px] mr-3 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8 16h8M8 12h8M8 8h8M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
    </svg>

 <a href="{{ route('admin.terms.index') }}" class="text-white py-2 px-3 mb-2"> Edit Terms & Conditions</a>
</div>

<div class="flex items-center text-white mb-6">
 <svg class="w-[32px] h-[32px] mr-3" xmlns="http://www.w3.org/2000/svg"fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 7h18M3 12h18M3 17h18M7 7v10m10-10v10" />
    </svg>
<a href="{{ route('admin.loan-products.index') }}" class="text-white py-2 px-3  mb-2">Loan Products</a>
</div>

<div class="flex items-center text-white mb-6">
  <svg class="w-[32px] h-[32px] mr-3" xmlns="http://www.w3.org/2000/svg"fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round"d="M9 13h6m-3-3v6m-4-8h8a2 2 0 012 2v10a2 2 0 01-2 2H8a2 2 0 01-2-2V8a2 2 0 012-2z" />
    </svg>
 <a href="{{ route('admin.loan-products.create') }}" class="text-white py-2 px-3   mb-2">Loan Products add</a>
</div>

<div class="flex items-center text-white mb-6">
 <svg class="w-[40px] h-[40px] mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round"
            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8V6m0 12v-2m9-4a9 9 0 11-18 0 9 9 0 0118 0z" />
    </svg>
  <a href="{{ route('admin.repayments.index') }}" class="text-white py-2 px-3  mb-2">Repayments history</a>
       
</div>



       
       
      <form method="POST" action="{{ route('logout') }}" class="mt-auto">
    @csrf
    <button type="submit" class="flex items-center w-full text-left text-white py-2 px-3 ">
        <svg class="w-6 h-6 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h6a2 2 0 012 2v1"/>
        </svg>
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




