@extends('layouts.adminn')

@section('content')
<h2>Edit Payment Method</h2>

<form method="POST" action="{{ route('admin.payment-methods.update', $paymentMethod) }}">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label>Name</label>
        <input name="name" value="{{ $paymentMethod->name }}" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Code</label>
        <input name="code" value="{{ $paymentMethod->code }}" class="form-control" required>
    </div>

    <div class="mb-3">
        <input type="checkbox" name="requires_reference"
            {{ $paymentMethod->requires_reference ? 'checked' : '' }}>
        <label>Requires External Reference</label>
    </div>

    <div class="mb-3">
        <input type="checkbox" name="is_active"
            {{ $paymentMethod->is_active ? 'checked' : '' }}>
        <label>Active</label>
    </div>

    <button class="btn btn-primary">Update</button>
</form>
@endsection
