@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto py-8">

    <h1 class="text-2xl font-bold mb-4">Confirm Guarantors</h1>
    <p class="mb-4 text-gray-600">
        The following guarantors will be attached to this loan application.
    </p> 

    <p class="text-sm text-gray-600 mb-4">
    Guarantors added: {{ $loan->guarantors->count() }} / 2
</p>

@if($loan->guarantors->count() < 2)
    <a href="{{ route('student.loans.guarantors.create', $loan) }}"
       class="btn btn-primary">
        Add another guarantor
    </a>
@endif

@if($loan->guarantors->count() === 2)
    <a href="{{ route('student.loans.review', $loan) }}"
       class="btn btn-success">
        Continue to Review
    </a>
@endif

    @foreach($guarantors as $guarantor)
    <div class="border p-4 rounded mb-3 flex justify-between items-center">
        <div>
            <p><strong>Name:</strong> {{ $guarantor->name }}</p>
            <p><strong>Relationship:</strong> {{ ucfirst($guarantor->relationship) }}</p>
            <p class="text-green-600 font-semibold">Approved</p>
        </div>
        @if($loan->status === 'draft')
            <form 
                id="replace-form-{{ $guarantor->id }}"
                action="{{ route('student.loans.guarantors.replace', [$loan, $guarantor]) }}"
                method="POST">
                @csrf
                @method('DELETE')
                <button 
                    type="button"
                    onclick="showReplaceModal({{ $guarantor->id }}, '{{ $guarantor->name }}')"
                    class="bg-red-600 text-white px-4 py-2 rounded">
                    Replace
                </button>
            </form>
        @endif
    </div>
@endforeach


<div id="replaceModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50">
    <div class="bg-white rounded-lg shadow-xl p-6 w-full max-w-sm mx-4">
        <div class="flex items-center gap-3 mb-3">
            
            <h3 class="text-lg font-semibold text-gray-800">Replace Guarantor</h3>
        </div>
        <p class="text-gray-600 mb-1">Are you sure you want to replace</p>
        <p class="font-semibold text-gray-800 mb-4" id="modalGuarantorName"></p>
        <p class="text-sm text-gray-500 mb-6">This action cannot be undone. You will need to add a new guarantor.</p>
        <div class="flex justify-end gap-3">
            <button 
                onclick="closeReplaceModal()"
                class="px-4 py-2 rounded border border-gray-300 text-gray-700 hover:bg-gray-100 transition">
                Cancel
            </button>
            <button 
                onclick="confirmReplace()"
                class="px-4 py-2 rounded bg-red-600 text-white hover:bg-red-700 transition">
                Yes, Replace
            </button>
        </div>
    </div>
</div>

<script>
    let activeFormId = null;

    function showReplaceModal(guarantorId, guarantorName) {
        activeFormId = guarantorId;
        document.getElementById('modalGuarantorName').textContent = guarantorName;
        const modal = document.getElementById('replaceModal');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function closeReplaceModal() {
        activeFormId = null;
        const modal = document.getElementById('replaceModal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }

    function confirmReplace() {
        if (activeFormId !== null) {
            document.getElementById('replace-form-' + activeFormId).submit();
        }
    }

    
    document.getElementById('replaceModal').addEventListener('click', function (e) {
        if (e.target === this) closeReplaceModal();
    });
</script>

    <form method="GET" action="{{ route('student.loans.review', $loan) }}">
        <button class="mt-4 bg-primary-700 text-white px-6 py-2 rounded-full">
            Confirm & Continue
        </button>
    </form>

</div>
@endsection

