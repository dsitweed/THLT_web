<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="/images/logo.png" type="image/ong">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Online Exam') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    @vite('resources/css/app.css')
</head>

<body class="min-h-screen flex flex-col">

    {{-- Toggle navbar --}}
    <nav class="bg-slate-800 text-slate-200 border-gray-200 px-2 sm:px-4 py-2.5">
        <div class="container flex flex-wrap items-center justify-between mx-auto">
            <a href="/" class="flex items-center hover:text-white">
                <img src="{{ asset('images/logo.png') }}" class="h-6 mr-3 sm:h-9" alt="Flowbite Logo" />
                <span class="self-center text-xl font-semibold whitespace-nowrap dark:text-white">Kiểm tra Online</span>
            </a>
            <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-search">
                <div class="flex flex-row gap-3 px-4 py-2 rounded-lg bg-slate-600 text-white">
                    {{-- Check is login ? --}}
                    @guest
                        <li class="text-lg">
                            <a href="{{ route('login') }}"
                                class="block py-2 pl-3 pr-4  rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-100 md:p-0 dark:text-gray-400 md:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Login</a>
                        </li>
                        <li class="text-lg">
                            <a href="{{ route('register') }}"
                                class="block py-2 pl-3 pr-4  rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-100 md:p-0 dark:text-gray-400 md:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Register</a>
                        </li>
                    @else
                        <a href="/profile" class="block py-2 px-3 rounded-lg hover:bg-gray-800">
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>
                        <a href="{{ route('logout') }}" class="block py-2 px-3  rounded-lg hover:bg-gray-800"
                            onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">Đăng
                            xuất</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    @endguest
                </div>
            </div>
        </div>

    </nav>
    @include('partials.errors')
    @include('partials.success')

    @yield('content')
    <!-- Scripts -->
    <div>
        <script src="{{ asset('js/app.js') }}"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
            });

            $('.ansform').on('submit', function(e) {
                var form = $(this);
                var submit = form.find("[type=submit]");
                var submitOriginalText = submit.attr("value");

                e.preventDefault();
                var data = form.serialize();
                var url = form.attr('action');
                var post = form.attr('method');
                $.ajax({
                    type: post,
                    url: url,
                    data: data,
                    success: function(data) {
                        submit.attr("value", "Submitted");
                    },
                    beforeSend: function() {
                        submit.attr("value", "Loading...");
                        submit.prop("disabled", true);
                    },
                    error: function() {
                        submit.attr("value", submitOriginalText);
                        submit.prop("disabled", false);
                        // show error to end user
                    }
                })
            })
        </script>
        @yield('script')
    </div>

    <script language="javascript">
        function collapMenu() {
            var menu_content = document.getElementById("menu-content");
            if (menu_content.style.display === "none" || menu_content.style.display === "") {
                menu_content.style.display = "block";
            } else {
                menu_content.style.display = "none";
            }
        };
    </script>
</body>

</html>
