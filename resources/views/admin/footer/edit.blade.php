@extends('layouts.adminn')

@section('title', 'Edit Footer Item')

@section('content')
<div class="max-w-3xl mx-auto py-10">

    <h1 class="text-2xl font-bold mb-6">Edit Footer Item</h1>

    <div class="bg-white shadow rounded-lg p-6">
        <form method="POST" action="{{ route('admin.footer.update', $footer) }}" class="space-y-4">
            @csrf
            @method('PUT')

            <input name="section" value="{{ $footer->section }}" class="border p-2 w-full rounded">
            <input name="label" value="{{ $footer->label }}" class="border p-2 w-full rounded">
            <input name="value" value="{{ $footer->value }}" class="border p-2 w-full rounded">
            <input name="url" value="{{ $footer->url }}" class="border p-2 w-full rounded">
            <input name="icon" value="{{ $footer->icon }}" class="border p-2 w-full rounded">

            <div class="flex justify-end gap-2">
                <a href="{{ route('admin.footer.index') }}" class="px-4 py-2 border rounded">
                    Cancel
                </a>
                <button class="px-4 py-2 bg-blue-600 text-white rounded">
                    Update
                </button>
            </div>
        </form>
    </div>

</div>
@endsection