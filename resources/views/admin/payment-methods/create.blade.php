@extends('layouts.adminn')

@section('content')
<h2>Add Payment Method</h2>

<form method="POST" action="{{ route('admin.payment-methods.store') }}">
    @csrf

    <div class="mb-3">
        <label>Name</label>
        <input name="name" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Code (mpesa, cash, bank)</label>
        <input name="code" class="form-control" required>
    </div>

    <div class="mb-3">
        <input type="checkbox" name="requires_reference" checked>
        <label>Requires External Reference</label>
    </div>

    <button class="btn btn-success">Save</button>
</form>
@endsection
