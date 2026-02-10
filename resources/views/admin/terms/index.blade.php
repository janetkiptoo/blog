@extends('layouts.adminn')

@section('title', 'Terms & Conditions')

@section('content')
<div class="container mx-auto px-6 py-6">

    <h1 class="text-2xl font-bold mb-4">Terms & Conditions</h1>

    
    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

   
    @if($term)
        <div class="bg-white shadow rounded p-6">
            <div class="prose max-w-none mb-6">
                {!! nl2br(e($term->content)) !!}
            </div>

            <a href="{{ route('admin.terms.edit', $term) }}"
               class="inline-block bg-primary-700 hover:bg-primary-500 text-white px-4 py-2 rounded">
                Edit Terms & Conditions
            </a>
        </div>
    @else
        
        <div class="bg-yellow-100 text-yellow-800 p-4 rounded mb-4">
            No Terms & Conditions have been created yet.
        </div>

        <a href="{{ route('admin.terms.create') }}"
           class="inline-block bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
            Create Terms & Conditions
        </a>
    @endif

</div>
@endsection
