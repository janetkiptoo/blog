@extends('layouts.adminn')

@section('content')
<form action="{{ route('admin.terms.update', $term) }}" method="POST">
    @csrf
    @method('PUT')
    <textarea name="content" rows="15" class="w-full border p-3 rounded">{{ $term->content }}</textarea>
    <button type="submit" class="bg-primary-100 hover:bg-primary-200 text-white px-4 py-2 rounded mt-2">Update Terms</button>
</form>






@endsection