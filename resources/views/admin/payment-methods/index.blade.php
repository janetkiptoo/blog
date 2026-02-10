@extends('layouts.adminn')

@section('content')
<div class=" py-6">
     <div class="flex justify-between items-center mb-4">
<h2 class="text-xl font-semibold ">Payment Methods</h2>

<a href="{{ route('admin.payment-methods.create') }}" class="bg-primary-100 hover:bg-primary-200 text-white px-4 py-2 rounded"> 
    +Add Payment Method
</a>
</div>

<table class="w-full border bg-white">
    <thead>
        <tr>
            <th>Name</th>
            <th>Code</th>
            <th>Requires Ref</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($methods as $method)
        <tr class="border-t" >
            <td class="p-2">{{ $method->name }}</td>
            <td class="p-2">{{ $method->code }}</td>
            <td class="p-2">{{ $method->requires_reference ? 'Yes' : 'No' }}</td>
            <td class="p-2">{{ $method->is_active ? 'Active' : 'Disabled' }}</td>
            <td class="p-2 space-x-2">
                <a href="{{ route('admin.payment-methods.edit', $method) }}" class="bg-primary-100 hover:bg-primary-200 text-white px-4 py-2 rounded">Edit</a>

                <form action="{{ route('admin.payment-methods.destroy', $method) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button class="bg-red-600 text-white px-4 py-2 rounded"
                        onclick="return confirm('Delete payment method?')">
                        Delete
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
</div>
@endsection
