<div class="flex items-center justify-between px-4 py-2 bg-primary relative">

    <div class="flex items-center gap-2">
        <img src="{{ asset('assets/loggo.jpeg') }}" alt="Student Loan Logo" 
             class="h-14 w-14 rounded-full object-cover">
    </div>

 
    <div class="hidden md:flex items-center gap-9">
        <ul class="text-white flex font-bold items-center gap-9">
            <li><a href="/home" class="hover:text-primary-200">HOME</a></li>
            <li><a href="/about" class="hover:text-primary-200">ABOUT</a></li>
            <li><a href="/services" class="hover:text-primary-200">SERVICES</a></li>
            <li><a href="/contact" class="hover:text-primary-200">CONTACT</a></li>
        </ul>
    </div>

    
    <div class="hidden md:flex items-center">
        @if (Auth::check())
            <form method="POST" action="{{ route('logout') }}" class="inline">
                @csrf
                <button type="submit" class="text-white font-bold hover:text-primary-200">LOG OUT</button>
            </form>
        @else
            <div class="flex gap-4 text-white font-bold">
                <a href="/login">
                    <button class="text-white px-4 py-1 rounded border border-white hover:bg-white hover:text-primary">LOGIN</button>
                </a>
                <a href="/register">
                    <button class="text-white px-4 py-1 rounded border border-white hover:bg-white hover:text-primary">SIGN UP</button>
                </a>
            </div>
        @endif
    </div>

   
    <button id="menu-btn" class="md:hidden text-white text-3xl focus:outline-none">
        ☰
    </button>

    
    <div id="mobile-menu" class="hidden absolute top-full left-0 w-full bg-primary z-50 px-6 py-4 flex-col gap-4 md:hidden">
        <ul class="text-white font-bold flex flex-col gap-4">
            <li><a href="/home" class="hover:text-primary-200">HOME</a></li>
            <li><a href="/about" class="hover:text-primary-200">ABOUT</a></li>
            <li><a href="/services" class="hover:text-primary-200">SERVICES</a></li>
            <li><a href="/contact" class="hover:text-primary-200">CONTACT</a></li>
        </ul>

        @if (Auth::check())
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="text-white font-bold hover:text-primary-200">LOG OUT</button>
            </form>
        @else
            <div class="flex flex-col gap-3 text-white font-bold">
                <a href="/login"><button class="w-full text-white px-4 py-2 rounded border border-white">LOGIN</button></a>
                <a href="/register"><button class="w-full text-white px-4 py-2 rounded border border-white">SIGN UP</button></a>
            </div>
        @endif
    </div>

</div>


<script>
    const btn = document.getElementById('menu-btn');
    const menu = document.getElementById('mobile-menu');

    btn.addEventListener('click', () => {
        menu.classList.toggle('hidden');
        menu.classList.toggle('flex');
        btn.textContent = menu.classList.contains('hidden') ? '☰' : '✕';
    });
</script>
