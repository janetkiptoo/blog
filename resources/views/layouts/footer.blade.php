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
                    {{ optional($footerItems->get('about', collect())->first())->value
                        ?? 'A student-focused digital loan platform providing accessible, transparent, and affordable financing to support academic success.' }}
                </p>
            </div>

            {{-- Quick Links --}}
            <div>
                <h3 class="text-white font-semibold mb-4">Quick Links</h3>
                <ul class="space-y-2 text-sm">
                    @foreach ($footerItems->get('links', collect()) as $item)
                        <li>
                            <a href="{{ $item->url }}" class="hover:text-white">
                                {{ $item->label }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            {{-- Support / Contact --}}
            <div>
                <h3 class="text-white font-semibold mb-4">Support</h3>
                <ul class="space-y-2 text-sm">
                    @foreach ($footerItems->get('contact', collect()) as $item)
                        <li>
                            @if ($item->url)
                                {{ $item->label }}:
                                <a href="{{ $item->url }}" class="hover:text-white">
                                    {{ $item->value }}
                                </a>
                            @else
                                {{ $item->label }}: {{ $item->value }}
                            @endif
                        </li>
                    @endforeach
                </ul>
            </div>
{{--social--}}
          @if ($footerItems->has('social') && $footerItems->get('social')->isNotEmpty())
    <div>
        <h3 class="text-white font-semibold mb-4">Follow Us</h3>
        
        <div class="flex gap-4">
           @foreach ($footerItems->get('social', collect()) as $item)
    <a href="{{ $item->url }}" class="text-xl hover:text-white">
        <i class="fab {{ $item->icon }}"></i>
    </a>
@endforeach
        </div>
    </div>
@endif
        </div>

        {{-- Divider --}}
        <div class="border-t border-gray-700 mt-10 pt-6 text-sm text-center">
            <p class="mb-2">
                {{ optional($footerItems->get('disclaimer', collect())->first())->value
                    ?? 'Loan approval is subject to eligibility verification, institutional validation, and internal assessment.' }}
            </p>

            <p class="text-gray-400">
                {{ optional($footerItems->get('copyright', collect())->first())->value
                    ?? '© '.date('Y').' Student Loan Platform' }}
            </p>
        </div>

    </div>
</footer>