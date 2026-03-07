@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto py-8 space-y-6">

   <div class="bg-white shadow rounded p-6 mb-3 flex justify-between items-center">
<div>
        <h2 class="text-xl font-bold mb-4">Loan Summary</h2>
        <p><span class="font-semibold">Product:</span> {{ $loan->loanProduct->product_name }}</p>
        <p><span class="font-semibold">Amount:</span> KES {{ number_format($loan->loan_amount, 2) }}</p>
        <p><span class="font-semibold">Interest Rate:</span> {{ $loan->interest_rate }}%</p>
        <p><span class="font-semibold">Term:</span> {{ $loan->term_months }} months</p>
        <p><span class="font-semibold">Monthly Payment:</span> KES {{ number_format($loan->monthly_payment, 2) }}</p>
</div>
        <a href="{{ route('student.loan.apply', $loan->loan_product_id) }}"
   class="bg-primary-600 text-white px-4 py-2 rounded-full">
   Edit loan details
</a>

    </div>

    <div class="bg-white shadow rounded p-6">
        <h2 class="text-xl font-bold mb-4">Personal Details</h2>
        <p><span class="font-semibold">Name:</span> {{ auth()->user()->name }}</p>
        <p><span class="font-semibold">Nationality:</span> {{ $personalProfile->nationality }}</p>
        <p><span class="font-semibold">ID Type:</span> {{ $personalProfile->government_id_type }}</p>
       <p><span class="font-semibold">ID Number:</span> {{ $personalProfile->government_id_number }}</p>
        <p><span class="font-semibold">Address:</span> {{ $personalProfile->address }}</p>
    </div>

    <div class="bg-white shadow rounded p-6">
        <h2 class="text-xl font-bold mb-4">Academic Details</h2>
        <p><span class="font-semibold">Institution:</span> {{ $academicProfile->institution_name }}</p>
        <p><span class="font-semibold">Course:</span> {{ $academicProfile->course_name }}</p>
        <p><span class="font-semibold">Level:</span> {{ $academicProfile->level }}</p>
         <p><span class="font-semibold">Student Registration Number:</span> {{ $academicProfile->student_registration_number }}</p>

         <p class=" text-gray-900 mt-2">
   If any personal or academic detail is incorrect, update your profile and wait for re-approval.
</p>
    </div>

     <div class="bg-white shadow rounded p-6 mb-3 flex justify-between items-center">
        <div>
    <h2 class="text-lg font-bold mt-6">Disbursement Details</h2>
    <p><strong>Method:</strong> {{ strtoupper($loan->disbursement_method) }}</p>
         @if($loan->disbursement_method === 'mpesa')
    <p><strong>Phone:</strong> {{ $loan->disbursement_phone }}</p>
        @else
    <p><strong>Bank:</strong> {{ $loan->bank_name }}</p>
    <p><strong>Account No:</strong> {{ $loan->bank_account_number }}</p>
         @endif
</div>

         <a href="{{ route('student.loans.disbursement', $loan) }}"
   class=" bg-primary-600 text-white px-4 py-2 rounded-full">
   Edit disbursement details
</a>
</div>
    

 <div class="bg-white shadow rounded p-6">
      <h2 class="text-lg font-bold mt-6">Guarantors</h2>
     @foreach($guarantors as $guarantor)
    <div class="border p-4 rounded mb-3 flex justify-between items-center">
        <div>
            <p><strong>Name:</strong> {{ $guarantor->name }}</p>
            <p><strong>Relationship:</strong> {{ ucfirst($guarantor->relationship) }}</p>
           
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
                    class="bg-red-600 text-white px-4 py-2 rounded-full">
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

@if($loan->guarantors->count() < 2)
    <a href="{{ route('student.loans.guarantors.create', $loan) }}"
       class="btn btn-primary">
        Add another guarantor
    </a>
@endif




    <form method="POST" action="{{ route('student.loans.submit', $loan) }}" class="bg-white shadow rounded p-6 space-y-4">
        @csrf

        <label class="flex items-center">
            <input type="checkbox" name="accept_terms" required class="mr-2" 
                @if($guarantors->count() < 2) disabled @endif >
            <span class="text-gray-700">
                I accept the
                <a href="{{ route('student.terms') }}" target="_blank" class="text-blue-600 underline">Terms & Conditions</a>
            </span>
        </label>

        <button type="submit" 
            class="w-full bg-primary-700 text-white px-6 py-2 rounded hover:bg-primary-800"
            @if($guarantors->count() < 2) disabled @endif>
            Submit Loan Application
</form>
            </div>

            @endsection