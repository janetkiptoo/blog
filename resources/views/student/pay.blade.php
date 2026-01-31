@extends('layouts.app')

@section('content')

<form action="{{ route('mpesa.stkpush') }}" method="POST">
    @csrf

    <div>
        <label>Phone Number</label>
        <input type="text" name="phonenumber" placeholder="2547XXXXXXXX" required>
    </div>

    <div>
        <label>Amount (KES)</label>
        <input type="number" name="amount" min="1" step="0.01" required>
    </div>

    <div>
        <label>Account / Reference</label>
        <input type="text" name="account_number" value="INV-{{ uniqid() }}" required>
    </div>

    <button type="submit">Pay Now</button>
</form>

@endsection
