@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto p-6 bg-white rounded shadow">
    <h2 class="text-2xl font-bold mb-4">Student Loan Terms & Conditions</h2>

    <p>Please read the following terms carefully before applying for a student loan. By submitting your application and accepting these terms, you agree to comply with all obligations outlined below.</p>

    <hr class="my-4">

    <h3 class="text-xl font-semibold mt-4">1. Eligibility</h3>
    <p>Applicants must be enrolled in a recognized tertiary institution and have a valid student registration number. Applicants with unpaid loans or outstanding balances from prior applications may be ineligible.</p>

    <h3 class="text-xl font-semibold mt-4">2. Loan Purpose</h3>
    <p>Loans may only be used for educational purposes, including tuition fees, books, and accommodation. Use of funds for illegal activities or personal business ventures is strictly prohibited.</p>

    <h3 class="text-xl font-semibold mt-4">3. Loan Amount & Terms</h3>
    <p>The minimum and maximum loan amounts are determined by the loan product. Repayment schedules, interest rates (if applicable), and penalties for late payments will be clearly communicated upon approval. The loan must be repaid in full within the agreed term.</p>

    <h3 class="text-xl font-semibold mt-4">4. Guarantors</h3>
    <p>Each applicant must provide at least two guarantors. Guarantors are responsible for ensuring repayment in case the applicant defaults. Providing false guarantor information may result in application rejection or legal consequences.</p>

    <h3 class="text-xl font-semibold mt-4">5. Application Accuracy</h3>
    <p>Applicants must provide truthful and accurate information. Any false information may lead to rejection of the application or legal action.</p>

    <h3 class="text-xl font-semibold mt-4">6. Privacy & Data Usage</h3>
    <p>Applicant information will be used solely for loan processing and administrative purposes. Personal data may be accessed by authorized personnel only and will be handled in accordance with privacy regulations.</p>

    <h3 class="text-xl font-semibold mt-4">7. Approval & Disbursement</h3>
    <p>Loan approval is subject to verification and discretion of the loan administrator. Disbursement will be made via the chosen method (bank transfer or mobile money). Any errors or delays in disbursement due to incorrect details provided by the applicant are the applicant's responsibility.</p>

    <h3 class="text-xl font-semibold mt-4">8. Repayment Obligations</h3>
    <p>Repayment is mandatory. Failure to repay the loan on time may result in penalties, interest, and potential legal action. Methods of repayment will be provided upon approval.</p>

    <h3 class="text-xl font-semibold mt-4">9. Termination / Cancellation</h3>
    <p>The loan may be canceled by the administrator if eligibility requirements are not met or if false information is detected. Withdrawal from school may also affect loan obligations.</p>

    <h3 class="text-xl font-semibold mt-4">10. Liability Disclaimer</h3>
    <p>The loan provider is not liable for technical errors, delays, or system outages during the application process. Applicants are responsible for providing accurate contact and banking information.</p>

    <h3 class="text-xl font-semibold mt-4">11. Acceptance</h3>
    <p>By submitting the loan application and checking the “I accept the Terms & Conditions” box, you acknowledge that you have read, understood, and agree to these terms. You accept your responsibilities to provide accurate information and repay the loan according to the agreed schedule.</p>
</div>


 <a href="{{ route('student.dashboard') }}"class="inline-block mt-4 text-blue-600 rounded bg-blue-600"> Back to Dashboard
    </a>
@endsection


