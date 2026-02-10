@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto p-6 bg-white rounded shadow">

    <h1 class="text-2xl font-bold mb-4">Terms & Conditions</h1>

  
        <div class="prose max-w-none">
            {!! nl2br(e($term->content)) !!}
        </div>
  <a href="{{ route('student.dashboard') }}"
                       class="mt-2 inline-block bg-primary-700 hover:bg-primary-500 text-white px-4 py-2 rounded">
                        Back To Apply
                    </a>

</div>

@endsection
