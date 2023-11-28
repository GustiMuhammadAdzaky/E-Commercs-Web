<!-- https://laravel.com/docs/10.x/authentication#authenticating-users -->
<!-- https://www.youtube.com/watch?v=FvHHX0Jv45s -->
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

    <style>
        .middle {

            margin: 100px;

        }
    </style>
</head>

<body>

    <div id="app">
        <div class="container">
            <div class="card middle">
                <div class="card-header">
                    <h4 class="card-title">Login</h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <form action="/login_admin" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input autofocus type="username" name="username" class="form-control @error('username') is-invalid @enderror" id="username" autofocus>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" name="password" class="form-control" id="password">
                            </div>
                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                <label class="form-check-label" for="exampleCheck1">Login</label>
                            </div>
                            <a href="/registrasi">registerasi</a>
                            <br>
                            <button type="submit" class="btn btn-primary mt-3">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="<?= url('mazer-1.3/dist/assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js'); ?>"></script>
    <script src="<?= url('mazer-1.3/dist/assets/js/bootstrap.bundle.min.js'); ?>"></script>

    <script src="<?= url('mazer-1.3/dist/assets/vendors/apexcharts/apexcharts.js'); ?>"></script>
    <script src="<?= url('mazer-1.3/dist/assets/js/pages/dashboard.js'); ?>"></script>

    <script src="<?= url('mazer-1.3/dist/assets/js/mazer.js'); ?>"></script>
</body>

</html>