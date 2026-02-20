@extends('layouts.adminn')

@section('title', 'User Guarantors')

@section('content')
<div class="py-6">

    <h1 class="text-2xl font-bold mb-4">
        Guarantors for {{ $user->name }}
    </h1>

    <table class="w-full bg-white shadow rounded">
        <thead>
            <tr class="bg-gray-100">
                <th class="p-3 text-left">Name</th>
                <th class="p-3 text-left">Relationship</th>
                <th class="p-3 text-left">Phone</th>
                <th class="p-3 text-left">Status</th>
                <th class="p-3 text-left">Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($guarantors as $guarantor)
                <tr class="border-t">
                    <td class="p-3">{{ $guarantor->name }}</td>
                    <td class="p-3 capitalize">{{ $guarantor->relationship }}</td>
                    <td class="p-3">{{ $guarantor->phone }}</td>
                    <td class="p-3">
                        <span class="
                            px-2 py-1 rounded text-sm
                            {{ $guarantor->status === 'approved' ? 'bg-green-100 text-green-700' : '' }}
                            {{ $guarantor->status === 'pending' ? 'bg-yellow-100 text-yellow-700' : '' }}
                            {{ $guarantor->status === 'rejected' ? 'bg-red-100 text-red-700' : '' }}
                             {{ $guarantor->status === 'replaced' ? 'bg-grey-100 text-grey-700' : '' }}
                        ">
                            {{ ucfirst($guarantor->status) }}
                        </span>
                    </td>
                    <td class="p-3">
                        <a href="{{ route('admin.guarantors.show', $guarantor) }}"
                           class="text-blue-600 underline">
                            Review
                        </a>

                        <div>
 @if($guarantor->trashed())
    <form method="POST"
          action="{{ route('admin.guarantors.restore', $guarantor->id) }}">
        @csrf
        <button class="bg-green-600 text-white px-3 py-1 rounded">
            Restore
        </button>
    </form>
@endif
</div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="p-4 text-center text-gray-500">
                        No guarantors submitted
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <a href="{{ route('admin.users.show', $user) }}"
       class="inline-block mt-6 bg-gray-500 text-white px-4 py-2 rounded">
        Back to User
    </a>
</div>
@endsection
