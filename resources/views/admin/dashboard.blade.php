@extends('layouts.adminn')

@section('content')
<div class="max-w-7xl mx-auto py-8">

    <h1 class="text-2xl font-bold mb-6">Admin Dashboard</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

        
        <div class="bg-white p-6 rounded shadow">
            <p class="text-gray-500">Total Users</p>
           
        </div>

        <div class="bg-white p-6 rounded shadow">
            <p class="text-gray-500">Students</p>
            
        </div>

        <div class="bg-white p-6 rounded shadow">
            <p class="text-gray-500">Admins</p>
          
        </div>

      
        <div class="bg-white p-6 rounded shadow">
            <p class="text-gray-500">Total Applications</p>
            
        </div>

        <div class="bg-yellow-50 p-6 rounded shadow">
            <p class="text-gray-600">Pending Applications</p>
            <h2 class="text-3xl font-bold text-yellow-600">
               
            </h2>
        </div>

        <div class="bg-green-50 p-6 rounded shadow">
            <p class="text-gray-600">Approved Applications</p>
            <h2 class="text-3xl font-bold text-green-600">
              
            </h2>
        </div>

        <div class="bg-red-50 p-6 rounded shadow">
            <p class="text-gray-600">Rejected Applications</p>
            <h2 class="text-3xl font-bold text-red-600">
             
            </h2>
        </div>

       
        <div class="bg-blue-50 p-6 rounded shadow">
            <p class="text-gray-600">Total Applied Amount</p>
            <h2 class="text-2xl font-bold text-blue-700">
                
            </h2>
        </div>

        <div class="bg-indigo-50 p-6 rounded shadow">
            <p class="text-gray-600">Total Approved Amount</p>
            <h2 class="text-2xl font-bold text-indigo-700">
               
            </h2>
        </div>

    </div>
</div>
@endsection
