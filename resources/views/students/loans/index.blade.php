@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">

    <h1 class="text-2xl font-bold text-center mb-6">My Loans</h1>

    @forelse($loans as $loan)
        <div class="bg-white shadow p-6 rounded mb-4">

            <p><strong>Product:</strong>
                {{ $loan->loanProduct->product_name ?? 'N/A' }}
            </p>

            <p><strong>Loan Amount:</strong>
                KES {{ number_format($loan->loan_amount, 2) }}
            </p>

            <p><strong>Balance:</strong>
                KES {{ number_format($loan->balance, 2) }}
            </p>

            <p><strong>Status:</strong>
                <span class="capitalize">{{ $loan->status }}</span>
            </p>

            {{-- Actions --}}
            <div class="mt-4 flex flex-wrap gap-3">

                {{-- Resume Draft --}}
                @if($loan->status === 'draft')
                    <a
                        href="{{ route('student.loans.resume', $loan->id) }}"
                        class="bg-yellow-500 text-white px-4 py-2 rounded"
                    >
                        Resume Application
                    </a>
                @endif

                {{-- Repayment --}}
                @if($loan->status === \App\Models\LoanApplication::STATUS_DISBURSED)
                    <a
                        href="{{ route('student.loans.repay.form', $loan->id) }}"
                        class="bg-green-600 text-white px-4 py-2 rounded"
                    >
                        Make Repayment
                    </a>
                @else
                    <span class="text-gray-400 text-sm">
                        Repayment available after disbursement
                    </span>
                @endif

                {{-- Paid --}}
                @if($loan->status === 'paid')
                    <span class="text-green-600 font-semibold">
                        Loan fully paid
                    </span>
                @endif

                {{-- Cancel (Draft / Pending only) --}}
                @if(in_array($loan->status, ['draft', 'pending']))
                    <button
                        class="bg-red-600 text-white px-4 py-2 rounded open-cancel-modal"
                        data-loan-id="{{ $loan->id }}"
                    >
                        Cancel Application
                    </button>
                @endif
            </div>
        </div>

        {{-- Cancel Modal --}}
        <div
            id="cancel-modal-{{ $loan->id }}"
            class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50"
        >
            <div class="bg-white rounded-lg p-6 w-full max-w-md">
                <h2 class="text-lg font-bold mb-4">
                    Cancel Loan Application
                </h2>

                <p class="mb-6 text-gray-600">
                    Are you sure you want to cancel this loan application?
                    This action cannot be undone.
                </p>

                <div class="flex justify-end gap-3">
                    <button
                        type="button"
                        class="px-4 py-2 border rounded close-modal"
                    >
                        No, Go Back
                    </button>

                    <form
                        action="{{ route('student.loans.destroy', $loan) }}"
                        method="POST"
                    >
                        @csrf
                        @method('DELETE')
                        <button
                            type="submit"
                            class="px-4 py-2 bg-red-600 text-white rounded"
                        >
                            Yes, Cancel
                        </button>
                    </form>
                </div>
            </div>
        </div>

    @empty
        <p class="text-center text-gray-500">
            You have not applied for any loans yet.
        </p>
    @endforelse

    {{-- Flash Messages --}}
    @if (session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mt-4">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="bg-red-100 text-red-700 p-3 rounded mt-4">
            {{ session('error') }}
        </div>
    @endif

</div>


<script>
document.addEventListener('DOMContentLoaded', function () {

   
    document.querySelectorAll('.open-cancel-modal').forEach(button => {
        button.addEventListener('click', function () {
            const loanId = this.dataset.loanId;
            const modal = document.getElementById('cancel-modal-' + loanId);

            modal.classList.remove('hidden');
            modal.classList.add('flex');
        });
    });

    
    document.querySelectorAll('.close-modal').forEach(button => {
        button.addEventListener('click', function () {
            const modal = this.closest('.fixed');

            modal.classList.add('hidden');
            modal.classList.remove('flex');
        });
    });

    
    document.querySelectorAll('[id^="cancel-modal-"]').forEach(modal => {
        modal.addEventListener('click', function (e) {
            if (e.target === modal) {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
            }
        });
    });

});
</script>
@endsection