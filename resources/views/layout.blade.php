<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="icon" href="images/favicon.ico" />
        <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
            integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
            crossorigin="anonymous"
            referrerpolicy="no-referrer"
        />
        <script src="https://cdn.tailwindcss.com"></script>
        <script>
            tailwind.config = {
                theme: {
                    extend: {
                        colors: {
                            laravel: "#ef3b2d",
                        },
                    },
                },
            };
        </script>
        <title>Thi trực tuyến</title>
    </head>
    <body class="mb-48">
        <nav class="bg-red-600 text-slate-900 border-gray-200 px-2 sm:px-4 py-2.5 flex justify-between items-center mb-4">
            {{-- style="background-image: url('images/header-bg.png')"> --}}
            <a href="/"
                ><img class="w-24" src="{{asset('images/logo.png')}}" alt="" class="logo"
            /></a>
            <ul class="flex space-x-6 mr-6 text-lg">
            <div class="flex flex-row gap-3 px-4 py-2 rounded-lg bg-red-400 text-white">
                @guest
                    <li>
                        <a href="/login" class="hover:text-black"
                        ><i class="fa-solid fa-arrow-right-to-bracket"></i>
                            Login</a
                        >
                    </li>
                    <li>
                        <a href="/register" class="hover:text-black"
                            ><i class="fa-solid fa-user-plus"></i> Register</a
                        >
                    </li>
                </ul>
                @else
                        <a href="/home" class="block py-2 px-3 rounded-lg  hover:bg-gray-800 hover:text-white">
                            <i class="fa-sharp fa-solid fa-book"></i>    My Course</a
                        >
                        <a href="/profile" class="block py-2 px-3 rounded-lg  hover:bg-gray-800 hover:text-white">
                            <i class="fa-sharp fa-solid fa-user"></i> 
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>
                        <a href="{{ route('logout') }}" class="block py-2 px-3  rounded-lg  hover:bg-gray-800 hover:text-white"
                            onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                <i class="fa-sharp fa-solid fa-right-from-bracket"></i>
                                Log Out</a
                            >                        
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                @endguest
            </div>
        </nav>
        <main>
            {{-- VIEW OUTPUT --}}
            @yield('content')
            {{-- all the content section wrap aroung layout --}}
        </main>
        @guest
        @else
        <footer
            class="fixed bottom-0 left-0 w-full flex items-center justify-start font-bold bg-laravel text-white h-24 mt-24 opacity-90 md:justify-center"
        >
            <p class="ml-2">Copyright &copy; 2022, All Rights reserved</p>

            <a
                href="create.html"
                class="absolute top-1/3 right-10 bg-black text-white py-2 px-5"
                >Post Job</a
            >
        </footer>
        @endguest
        <x-flash-message />
</body>
</html>