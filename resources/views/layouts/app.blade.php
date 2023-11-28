<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <style>
        .navbar-search {
            margin-left: auto;
            /* Untuk memindahkan input ke tengah */
            margin-right: auto;
            /* Untuk memindahkan input ke tengah */
            display: flex;
            align-items: center;
            /* Pusatkan vertikal */
            max-width: 80%;
            /* Atur lebar maksimum sesuai kebutuhan Anda */
            width: 100%;
            /* Agar input mengisi sebanyak mungkin lebar yang tersedia */
        }

        .search-input {
            flex-grow: 1;
            /* Input akan mengisi sebanyak mungkin ruang yang tersedia */
        }



        .badge {
            position: absolute;
        }
    </style>
</head>



<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <!-- @if(request()->url() === url('/'))
                <div class="navbar-search">
                    <input class="form-control search-input" type="search" placeholder="Search" aria-label="Search">
                </div>
                @endif -->

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        <!-- Add your additional list items for all users here -->
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                        @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @endif

                        @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                        @endif

                        @elseif(Auth::user()->role == "admin")
                        <div class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" style="color: black;" href="#"
                                role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </div>
                        <!-- <a class="nav-link" href="{{ route('cart.list') }}">
                            <i class="bi bi-cart4"></i>Keranjang
                            <span class="badge rounded-pill bg-success">{{ Cart::getTotalQuantity() }}</span>
                        </a> -->
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('cart.list') }}">
                                <i class="bi bi-cart4"></i>Keranjang
                                <span class="badge rounded-pill bg-success">{{ Cart::getTotalQuantity() }}</span>
                            </a>
                        </li>
                        <li class="nav-item ml-5">
                            <a class="nav-link" href="/dashboard">Dashboard</a>
                        </li>
                        @else
                        <div class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" style="color: black;" href="#"
                                role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-end " aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </div>

                        <a class="nav-link" style="color: black;" href="{{ route('cart.list') }}">
                            <i class="bi bi-cart4"></i>Keranjang
                            <span class="badge rounded-pill bg-success">{{ Cart::getTotalQuantity() }}</span>
                        </a>
                        @endguest


                    </ul>
                </div>
            </div>

        </nav>

        <main class="py-4">
            @yield('content')
        </main>

        <div class="container" style="border-top: 1px solid #CCCED0">
            <footer class="">
                <div class="text-center">
                    <span>&copy; 2023 Gusti Muhammad Adzaky, Pontianak</span>
                </div>
            </footer>
        </div>
    </div>
</body>

</html>