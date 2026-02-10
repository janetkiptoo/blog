 <div class=" flex items-center justify-between px-4 py-2 bg-primary">
        <div class="flex items-center gap-2">
         <img src="https://images.pexels.com/photos/2230796/pexels-photo-2230796.jpeg" class="h-14 w-14 rounded-full object-cover" alt="logo">
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

            <form method="POST" action="{{ route('logout') }}" class="inline text-white">
                @csrf
                <button type="submit">Logout</button>
            </form>
                @else
              <div class="flex gap-6  ">
                <a href="/login">
                 <button class="bg-primary-700 hover:bg-primary-500 text-white  px-4 rounded">login</button>
                </a>
                <a href="/register">
                <button class="bg-primary-700 hover:bg-primary-500 text-white px-4 rounded">sign up</button>
                </a>
                </div>
@endif
 </div>