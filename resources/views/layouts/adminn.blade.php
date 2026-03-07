<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Student Loan Platform')</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 min-h-screen">

    <!-- Mobile Top Bar -->
    <div class="bg-primary lg:hidden flex items-center justify-between px-4 py-3 sticky top-0 z-50 shadow-md">
        <a href="{{ route('admin.dashboard') }}" class="text-white text-xl font-bold">Admin Panel</a>
        <button id="menuToggle" class="text-white focus:outline-none" aria-label="Toggle menu">
            <svg id="menuIcon" class="w-7 h-7" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
            <svg id="closeIcon" class="w-7 h-7 hidden" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
    </div>

    <div class="flex min-h-screen h-full">

        <!-- Sidebar Overlay (mobile) -->
        <div id="sidebarOverlay" class="fixed inset-0 bg-black bg-opacity-50 z-30 hidden lg:hidden" onclick="closeSidebar()"></div>

        <!-- Sidebar -->
        <nav id="sidebar" class="bg-primary w-64 flex-shrink-0 p-6 flex flex-col fixed lg:static top-0 left-0 h-full z-40 transform -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out overflow-y-auto min-h-screen">

            <!-- Desktop Brand -->
            <div class="mb-8 hidden lg:block">
                <a href="{{ route('admin.dashboard') }}" class="text-white text-2xl font-bold block mb-6">Admin Panel</a>
            </div>

            <!-- Mobile spacing top -->
            <div class="mt-4 lg:mt-0"></div>

            @php $unread = auth()->user()->unreadNotifications->count(); @endphp

            <!-- Nav Items -->
            <ul class="space-y-1 flex-1">

                <!-- Dashboard -->
                <li>
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 text-white py-2 px-3 rounded-lg hover:bg-white/10 transition-colors">
                        <svg class="w-8 h-8 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd" d="M11.293 3.293a1 1 0 0 1 1.414 0l6 6 2 2a1 1 0 0 1-1.414 1.414L19 12.414V19a2 2 0 0 1-2 2h-3a1 1 0 0 1-1-1v-3h-2v3a1 1 0 0 1-1 1H7a2 2 0 0 1-2-2v-6.586l-.293.293a1 1 0 0 1-1.414-1.414l2-2 6-6Z" clip-rule="evenodd"/>
                        </svg>
                        <span>Dashboard</span>
                    </a>
                </li>

                <!-- Notifications -->
                <li>
                    <a href="{{ route('admin.notifications') }}" class="flex items-center gap-3 text-white py-2 px-3 rounded-lg hover:bg-white/10 transition-colors relative">
                        <svg class="w-8 h-8 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6 6 0 10-12 0v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                        </svg>
                        <span>Notifications</span>
                        @if($unread > 0)
                            <span class="ml-auto bg-red-500 text-white text-xs font-bold px-2 py-0.5 rounded-full">{{ $unread }}</span>
                        @endif
                    </a>
                </li>

                <!-- User Management -->
                <li>
                    <a href="{{ route('admin.users.index') }}" class="flex items-center gap-3 text-white py-2 px-3 rounded-lg hover:bg-white/10 transition-colors">
                        <svg class="w-5 h-5 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87m9-4.13a4 4 0 11-8 0 4 4 0 018 0zm6 4a3 3 0 00-3-3m-9 3a3 3 0 013-3"/>
                        </svg>
                        <span>User Management</span>
                    </a>
                </li>

                <!-- Loan Applications -->
                <li>
                    <a href="{{ route('admin.loans.index') }}" class="flex items-center gap-3 text-white py-2 px-3 rounded-lg hover:bg-white/10 transition-colors">
                        <svg class="w-5 h-5 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m-6-8h6M7 20h10a2 2 0 002-2V6a2 2 0 00-2-2H7a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <span>Loan Applications</span>
                    </a>
                </li>

                <!-- Terms & Conditions -->
                <li>
                    <a href="{{ route('admin.terms.index') }}" class="flex items-center gap-3 text-white py-2 px-3 rounded-lg hover:bg-white/10 transition-colors">
                        <svg class="w-5 h-5 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 16h8M8 12h8M8 8h8M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <span>Terms &amp; Conditions</span>
                    </a>
                </li>

                <!-- Loan Products -->
                <li>
                    <a href="{{ route('admin.loan-products.index') }}" class="flex items-center gap-3 text-white py-2 px-3 rounded-lg hover:bg-white/10 transition-colors">
                        <svg class="w-5 h-5 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                        </svg>
                        <span>Loan Products</span>
                    </a>
                </li>

                <!-- FAQs -->
                <li>
                    <a href="{{ route('admin.faqs.index') }}" class="flex items-center gap-3 text-white py-2 px-3 rounded-lg hover:bg-white/10 transition-colors">
                        <svg class="w-5 h-5 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span>FAQs</span>
                    </a>
                </li>

                <!-- Footer -->
                <li>
                    <a href="{{ route('admin.footer.index') }}" class="flex items-center gap-3 text-white py-2 px-3 rounded-lg hover:bg-white/10 transition-colors">
                        <svg class="w-5 h-5 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 10h16M4 14h10M4 18h6"/>
                        </svg>
                        <span>Footer</span>
                    </a>
                </li>

                <!-- Cash Payments -->
                <li>
                    <a href="{{ route('admin.cash-payments.index') }}" class="flex items-center gap-3 text-white py-2 px-3 rounded-lg hover:bg-white/10 transition-colors">
                        <svg class="w-5 h-5 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 9V7a4 4 0 00-8 0v2M5 9h14l1 12H4L5 9z"/>
                        </svg>
                        <span>Cash Payments</span>
                    </a>
                </li>

                <!-- Messages -->
                <li>
                    <a href="{{ route('admin.support-tickets.index') }}" class="flex items-center gap-3 text-white py-2 px-3 rounded-lg hover:bg-white/10 transition-colors">
                        <svg class="w-5 h-5 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 10h.01M12 10h.01M16 10h.01M21 12c0 4.418-4.03 8-9 8a9.862 9.862 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                        </svg>
                        <span>Messages</span>
                    </a>
                </li>

                <!-- Eligibility Requirements -->
                <li>
                    <a href="{{ route('admin.eligibility.index') }}" class="flex items-center gap-3 text-white py-2 px-3 rounded-lg hover:bg-white/10 transition-colors">
                        <svg class="w-5 h-5 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span>Eligibility Requirements</span>
                    </a>
                </li>

            </ul>

            <!-- Divider -->
            <div class="border-t border-white/20 my-4"></div>

            <!-- Logout -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="flex items-center gap-3 w-full text-white py-2 px-3 rounded-lg hover:bg-white/10 transition-colors">
                    <svg class="w-5 h-5 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h6a2 2 0 012 2v1"/>
                    </svg>
                    <span>Logout</span>
                </button>
            </form>

        </nav>

        <!-- Main content -->
        <main class="flex-1 p-4 lg:p-6 min-w-0">
            @yield('content')
        </main>

    </div>

    <script>
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebarOverlay');
        const menuIcon = document.getElementById('menuIcon');
        const closeIcon = document.getElementById('closeIcon');

        document.getElementById('menuToggle').addEventListener('click', () => {
            const isOpen = !sidebar.classList.contains('-translate-x-full');
            if (isOpen) {
                closeSidebar();
            } else {
                openSidebar();
            }
        });

        function openSidebar() {
            sidebar.classList.remove('-translate-x-full');
            overlay.classList.remove('hidden');
            menuIcon.classList.add('hidden');
            closeIcon.classList.remove('hidden');
        }

        function closeSidebar() {
            sidebar.classList.add('-translate-x-full');
            overlay.classList.add('hidden');
            menuIcon.classList.remove('hidden');
            closeIcon.classList.add('hidden');
        }
    </script>

</body>
</html>