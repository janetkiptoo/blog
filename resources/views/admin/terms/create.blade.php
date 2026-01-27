@extends('layouts.adminn')

@section('title', 'Create Terms & Conditions')

@section('content')
<div class="container mx-auto px-6 py-6">

    <h1 class="text-2xl font-bold mb-4">Create Terms & Conditions</h1>

    
    @if($errors->any())
        <div class="bg-red-100 text-red-800 p-3 rounded mb-4">
            <ul class="list-disc list-inside">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-white shadow rounded p-6">
        <form action="{{ route('admin.terms.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label class="block font-semibold mb-2">
                    Terms & Conditions Content
                </label>

                <textarea name="content" rows="12" class="w-full border rounded p-3 " placeholder="Enter the full terms and conditions..."required>{{ old('content') }}</textarea>
            </div>

            <div class="flex justify-between">
                <a href="{{ route('admin.terms.index') }}"class="text-white px-6 py-2 rounded bg-gray-600">Cancel
                </a>

                <button type="submit"
                        class="bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700">
                    Save Terms
                </button>
            </div>
        </form>
    </div>

</div>
@endsection
