<footer class="bg-gray-900 text-gray-300">
    <div class="max-w-7xl mx-auto px-6 md:px-16 py-14">

        <div class="grid grid-cols-1 md:grid-cols-4 gap-10">

            {{-- Platform Info --}}
            <div>
                <div class="flex items-center gap-3 mb-4">
                    <img src="{{ asset('assets/loggo.jpeg') }}" alt="Student Loan Logo" class="h-10">
                    <span class="text-xl font-bold text-white">Student Loan</span>
                </div>
                <p class="text-sm leading-relaxed">
                    A student-focused digital loan platform providing accessible,
                    transparent, and affordable financing to support academic success.
                </p>
            </div>

            {{-- Quick Links --}}
            <div>
                <h3 class="text-white font-semibold mb-4">Quick Links</h3>
                <ul class="space-y-2 text-sm">
                    <li><a href="{{ route('web.home') }}" class="hover:text-white">Home</a></li>
                    <li><a href="#eligibility" class="hover:text-white">Check Eligibility</a></li>
                    <li><a href="#products" class="hover:text-white">Loan Products</a></li>
                    <li><a href="#calculator" class="hover:text-white">EMI Calculator</a></li>
                    <li><a href="#faqs" class="hover:text-white">FAQs</a></li>
                </ul>
            </div>

            

            {{-- Contact --}}
            <div>
                <h3 class="text-white font-semibold mb-4">Support</h3>
                <ul class="space-y-2 text-sm">
                    <li>Email: <a href="mailto:support@studentloan.com" class="hover:text-white">support@studentloan.com</a></li>
                    <li>Phone: +254 700 000 000</li>
                    <li>Mon – Fri, 9:00 AM – 5:00 PM</li>
                    <li>Location: Kenya</li>
                </ul>
            </div>

        </div>

        {{-- Divider --}}
        <div class="border-t border-gray-700 mt-10 pt-6 text-sm text-center">
            <p class="mb-2">
                Loan approval is subject to eligibility verification, institutional validation,
                and internal assessment. Meeting preliminary criteria does not guarantee approval.
            </p>
            <p class="text-gray-400">
                © {{ date('Y') }} Student Loan Platform. All rights reserved.
            </p>
        </div>

    </div>
</footer>
