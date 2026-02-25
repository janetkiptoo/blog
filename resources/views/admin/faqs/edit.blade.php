@extends('layouts.adminn')

@section('title', 'Edit FAQ')

@section('content')
<div class="max-w-6xl mx-auto py-10">

    <h1 class="text-2xl font-bold mb-6 text-gray-800">Edit FAQ</h1>

    <div class="bg-white shadow rounded-lg p-6">

        <form method="POST" action="{{ route('admin.faqs.update', $faq) }}" class="space-y-4">
            @csrf
            @method('PUT')
            <div>
                <label class="block ">
                    Question
                </label>
                <input
                    type="text"
                    name="question"
                    value="{{ old('question', $faq->question) }}"
                    class="w-full border rounded px-3 py-2 focus:ring focus:ring-blue-200"
                    required
                >
            </div>

            <div>
                <label class="block  ">
                    Answer
                </label>
                <textarea
                    name="answer"
                    rows="5"
                    class="w-full border rounded px-3 py-2 focus:ring focus:ring-blue-200"
                    required
                >{{ old('answer', $faq->answer) }}</textarea>
            </div>

            <div class="flex justify-end gap-2">
                <a
                    href="{{ route('admin.faqs.index') }}"
                    class="px-4 py-2 border rounded hover:bg-gray-100"
                >
                    Cancel
                </a>

                <button
                    type="submit"
                    class="px-5 py-2 bg-blue-600 text-white rounded hover:bg-blue-700"
                >
                    Update FAQ
                </button>
            </div>
        </form>

    </div>
</div>
@endsection