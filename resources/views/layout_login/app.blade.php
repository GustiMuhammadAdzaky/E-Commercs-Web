<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Mazer Admin Dashboard</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= url('mazer-1.3/dist/assets/css/bootstrap.css'); ?>">

    <link rel="stylesheet" href="<?= url('mazer-1.3/dist/assets/vendors/iconly/bold.css'); ?>">

    <link rel="stylesheet" href="<?= url('mazer-1.3/dist/assets/vendors/perfect-scrollbar/perfect-scrollbar.css'); ?>">
    <link rel="stylesheet" href="<?= url('mazer-1.3/dist/assets/vendors/bootstrap-icons/bootstrap-icons.css'); ?>">
    <link rel="stylesheet" href="<?= url('mazer-1.3/dist/assets/css/app.css'); ?>">
    <link rel="shortcut icon" href="<?= url('mazer-1.3/dist/assets/images/favicon.svg'); ?>" type="image/x-icon">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <div id="app">
        <div id="sidebar" class="active">
            <div class="sidebar-wrapper active">
                <div class="sidebar-header">
                    <div class="d-flex justify-content-between">
                        <div class="logo">
                            <a href="index.html"><img src="<?= url('mazer-1.3/dist/assets/images/logo/logo.png'); ?>" alt="Logo" srcset=""></a>
                        </div>
                        <div class="toggler">
                            <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                        </div>
                    </div>
                </div>
                <div class="sidebar-menu">
                    <ul class="menu">
                        <li class="sidebar-title">Menu</li>

                        <li class="sidebar-item" id="id1">
                            <a href="/dashboard" class='sidebar-link'>
                                <i class="bi bi-grid-fill"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>

                        <li class="sidebar-item" id="id2">
                            <a href="/optionsadmin" class='sidebar-link'>
                                <i class="bi bi-person-badge-fill"></i>
                                <span>Ganti Informasi Admin</span>
                            </a>
                        </li>


                        <li class="sidebar-item  has-sub" id="id3">
                            <a href="#" class='sidebar-link'>
                                <i class="bi bi-stack"></i>
                                <span>Kelola Data</span>
                            </a>
                            <ul class="submenu ">
                                <li class="submenu-item ">
                                    <a href="/kelola_produk">Produk</a>
                                </li>
                                <li class="submenu-item ">
                                    <a href="component-badge.html">Pembelian</a>
                                </li>
                                <li class="submenu-item ">
                                    <a href="component-breadcrumb.html">Pelanggan</a>
                                </li>
                            </ul>
                        </li>



                        <li class="sidebar-item">
                            <a href="{{ route('logout') }}" class='sidebar-link' onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                <i class="bi bi-box-arrow-left"></i>
                                <span>Logout</span>
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>


                    </ul>
                </div>
                <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
            </div>
        </div>

        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>

            @yield('content')

            <!-- sini -->
        </div>


    </div>
    </div>



    <script>
        let urlSaatini = window.location.href;

        const dashboard = '<?= url('/dashboard'); ?>';
        const admin = '<?= url('/optionsadmin'); ?>';
        // const element = '';
        if (dashboard == urlSaatini) {
            const element = document.getElementById('id1');
            element.classList.add('active');
        } else if (admin == urlSaatini) {
            const element = document.getElementById('id2');
            element.classList.add('active');
        } else {
            const element = document.getElementById('id3');
            element.classList.add('active');
        }
        // console.log("");
        // var element = document.getElementById('id1');

        // if (urlSaatini == "") {

        // }


        // Tambahkan kelas "active" ke elemen tersebut
        // element.classList.add('active');





        // var element = document.getElementById('id2');

        // // Dapatkan elemen <a> di dalam elemen tersebut
        // var linkElement = element.querySelector('a');

        // // Dapatkan nilai atribut "href" dari elemen <a>
        // var hrefValue = linkElement.getAttribute('href');

        // var url = `${'<?= url('/'); ?>'hrefValue}`;


        // // Tampilkan nilai href di console
        // // console.log(hrefValue);
        // console.log(url);
    </script>








    <script src="<?= url('mazer-1.3/dist/assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js'); ?>"></script>
    <script src="<?= url('mazer-1.3/dist/assets/js/bootstrap.bundle.min.js'); ?>"></script>

    <script src="<?= url('mazer-1.3/dist/assets/vendors/apexcharts/apexcharts.js'); ?>"></script>
    <script src="<?= url('mazer-1.3/dist/assets/js/pages/dashboard.js'); ?>"></script>

    <script src="<?= url('mazer-1.3/dist/assets/js/mazer.js'); ?>"></script>
</body>

</html>