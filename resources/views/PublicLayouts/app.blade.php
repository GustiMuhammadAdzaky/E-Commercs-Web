<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <title>Toko Online</title>

    <style>
        /* CSS kustom untuk membuat input pencarian berada di tengah navbar */
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
    </style>
</head>



<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="#">Logo</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2">
                </ul>
                <div class="navbar-search">
                    <input class="form-control search-input" type="search" placeholder="Search" aria-label="Search">
                </div>



                @guest
                @if (Route::has('login'))
                <a class="nav-link" style="color: black;" href="{{ route('login') }}">{{ __('Login') }}</a>
                @endif
                @if (Route::has('register'))
                <a class="nav-link" style="color: black;" href="{{ route('register') }}">{{ __('Register') }}</a>
                @endif
                @else
                <div class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" style="color: black;" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }}
                    </a>

                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </div>

                <a class="nav-link" style="color: black;" href="#"><i class="bi bi-cart4"></i>Keranjang<span class="badge bg-success">0</span></a>

                @endguest
            </div>
        </div>
    </nav>


    <div class="main">
        @yield('content')
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>