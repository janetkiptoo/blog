 <div class=" flex items-center justify-between px-4 py-2 bg-primary">
        <div class="flex items-center gap-2">
         <img src="{{ asset('assets/loggo.jpeg') }}" alt="Student Loan Logo" class="mx-auto block h-20 rounded-full sm:mx-0 sm:shrink-0">
        </div>

        <div >
            <ul class=" text-white flex font-bold items-center gap-9">
                <li><a href="/home" class=" hover:text-primary-200">HOME</a></li>
                <li><a href="/about" class=" hover:text-primary-200">ABOUT</a></li>
                <li><a href="/services" class=" hover:text-primary-200">SERVICES</a></li>
                <li><a href="/contact" class=" hover:text-primary-200">CONTACT</a></li>
               
                </ul>
                </div>

                @if (Auth::check())

            <form method="POST" action="{{ route('logout') }}" class="inline text-white font-bold">
                @csrf
                <button type="submit">LOG OUT</button>
            </form>
                @else
              <div class="flex gap-6  text-white font-bold  ">
                <a href="/login">
                 <button class=" text-white  px-4 rounded">LOGIN</button>
                </a>
                <a href="/register">
                <button class=" text-white px-4 rounded">SIGN UP</button>
                </a>
                </div>
@endif
 </div>