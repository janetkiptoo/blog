 <div class=" flex items-center justify-between px-4 py-2 bg-primary">
        <div class="flex items-center gap-2">
         <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQu_LjE_ntilN9e8hzWjvBW8TwnUStrRxss1oKkJPq4U41SGXvLFfFGNME&s" class="h-14 w-14 rounded-full object-cover" alt="logo">
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
                 <button class=" text-white  px-4 rounded">login</button>
                </a>
                <a href="/register">
                <button class=" text-white px-4 rounded">sign up</button>
                </a>
                </div>
@endif
 </div>