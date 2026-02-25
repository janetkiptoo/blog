@extends('layouts.adminn')

@section('title', 'Footer Management')

@section('content')
<div class="max-w-6xl mx-auto py-10">

    <h1 class="text-2xl font-bold mb-6">Footer Management</h1>

    {{-- ADD FOOTER ITEM --}}
    <div class="bg-white shadow rounded-lg p-6 mb-8">
        <h2 class="font-semibold mb-4">Add Footer Item</h2>

        <form method="POST" action="{{ route('admin.footer.store') }}" class="grid grid-cols-1 md:grid-cols-2 gap-4">
            @csrf

            <input name="section" placeholder="Section (e.g. links, contact, social)" class="border p-2 rounded">
            <input name="label" placeholder="Label (e.g. Email, About)" class="border p-2 rounded">
            <input name="value" placeholder="Value (text)" class="border p-2 rounded">
            <input name="url" placeholder="URL (optional)" class="border p-2 rounded">
            <input name="icon" placeholder="Icon class (optional)" class="border p-2 rounded">

            <button class="md:col-span-2 bg-blue-600 text-white py-2 rounded hover:bg-blue-700">
                Add Item
            </button>
        </form>
    </div>

    {{-- FOOTER ITEMS LIST --}}
    <div class="bg-white shadow rounded-lg p-6">
        <table class="w-full">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-3 text-left">Section</th>
                    <th class="p-3 text-left">Label</th>
                    <th class="p-3 text-left">Value / URL</th>
                    <th class="p-3 text-left w-40">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($items as $item)
                <tr class="border-t">
                    <td class="p-3">{{ $item->section }}</td>
                    <td class="p-3">{{ $item->label }}</td>
                    <td class="p-3 text-sm text-gray-600">
                        {{ $item->value ?? $item->url }}
                    </td>
                    <td class="p-3 flex gap-2">
                        <a
                            href="{{ route('admin.footer.edit', $item) }}"
                            class="px-3 py-1 bg-yellow-500 text-white rounded"
                        >
                            Edit
                        </a>

                        <form method="POST" action="{{ route('admin.footer.destroy', $item) }}"
                              onsubmit="return confirm('Delete this item?')">
                            @csrf
                            @method('DELETE')
                            <button class="px-3 py-1 bg-red-600 text-white rounded">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>
@endsection