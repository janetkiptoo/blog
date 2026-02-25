@extends('layouts.adminn')

@section('title', 'Manage FAQs')

@section('content')
<div class="max-w-5xl mx-auto py-10">

    <h1 class="text-2xl font-bold mb-6 text-gray-800">Manage FAQs</h1>

    {{-- ADD FAQ --}}
    <div class="bg-white shadow rounded-lg p-6 mb-10">
        <h2 class="text-lg font-semibold mb-4">Add New FAQ</h2>

        <form method="POST" action="{{ route('admin.faqs.store') }}" class="space-y-4">
            @csrf

            <div>
                <label class="block text-sm font-medium text-gray-700">Question</label>
                <input name="question" required class="w-full border rounded px-3 py-2 focus:ring focus:ring-blue-200">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Answer</label>
                <textarea name="answer" rows="4" required class="w-full border rounded px-3 py-2 focus:ring focus:ring-blue-200"></textarea>
            </div>

            <button class="bg-blue-600 text-white px-5 py-2 rounded hover:bg-blue-700">
                Add FAQ
            </button>
        </form>
    </div>

    {{-- FAQ LIST --}}
    <div class="bg-white shadow rounded-lg p-6">
        <h2 class="text-lg font-semibold mb-4">Existing FAQs</h2>

        <table class="w-full border-collapse">
            <thead>
                <tr class="bg-gray-100 text-left">
                    <th class="p-3 border">Question</th>
                    <th class="p-3 border w-40">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($faqs as $faq)
                    <tr class="hover:bg-gray-50">
                        <td class="p-3 border">
                            {{ $faq->question }}
                        </td>

                        <td class="p-3 border flex gap-2">
                            {{-- EDIT --}}
                           <a
   a href="{{ route('admin.faqs.edit', $faq) }}"
    class="px-3 py-1 text-sm bg-yellow-500 text-white rounded hover:bg-yellow-600"
>
    Edit
</a>

                            {{-- DELETE --}}
                            <form
                                method="POST"
                                action="{{ route('admin.faqs.destroy', $faq) }}"
                                onsubmit="return confirm('Delete this FAQ?')"
                            >
                                @csrf
                                @method('DELETE')
                                <button class="px-3 py-1 text-sm bg-red-600 text-white rounded hover:bg-red-700">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>


                @empty
                    <tr>
                        <td colspan="2" class="p-4 text-center text-gray-500">
                            No FAQs found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection