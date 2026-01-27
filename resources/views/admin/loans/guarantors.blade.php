@extends('layouts.adminn')

@section('content')

<h2>Guarantors for Loan #{{ $loan->id }}</h2>

<table class="min-w-full bg-white mt-4">
    <thead>
        <tr>
            <th>Name</th>
            <th>Relationship</th>
            <th>National ID</th>
            <th>Phone</th>
            <th>Employment</th>
            <th>Address</th>
            <th>Image</th>
        </tr>
    </thead>
    <tbody>
        @foreach($guarantors as $g)
        <tr>
            <td>{{ $g->name }}</td>
            <td>{{ $g->relationship }}</td>
            <td>{{ $g->national_id }}</td>
            <td>{{ $g->phone }}</td>
            <td>{{ $g->employment_status }}</td>
            <td>{{ $g->physical_address }}</td>
            <td>
                @if($g->image)
                <img src="{{ asset('storage/' . $g->image) }}" alt="Guarantor Image" class="w-16 h-auto">
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>


@endsection