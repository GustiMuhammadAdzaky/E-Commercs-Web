@extends('layout_login.app')

@section('content')
<div class="page-heading">
    <h3>Selamat Data di {{$nama}}</h3>
</div>



@if (session('status'))
<script>
    Swal.fire({
        // position: 'top-end',
        icon: 'success',
        title: "{{ session('status') }}",
        showConfirmButton: false,
        timer: 1500
    })
</script>
@endif






<section id="basic-horizontal-layouts">
    <div class="row match-height">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">
                        Pengaturan Akun
                    </h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <form class="form form-horizontal" method="post" action="optionsadmin/ubah" onsubmit="return validateForm()">
                            @csrf
                            <input type="hidden" name="id" value="{{$userModel[0]->id}}">
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label>Nama Lengkap</label>
                                    </div>
                                    <div class="col-md-8 form-group">
                                        <input type="text" id="nama" name="nama" class="form-control" value="{{$userModel[0]->name}}" placeholder="Tuliskan Nama Lengkap Anda !" />
                                        <div id="nama-feedback" class="invalid-feedback"></div>
                                    </div>
                                    <div class="col-md-4">
                                        <label>Username</label>
                                    </div>
                                    <div class="col-md-8 form-group">
                                        <input type="email" id="email" value="{{$userModel[0]->email}}" class="form-control" name="email" placeholder="Tuliskan email" />
                                        <div id="email-feedback" class="invalid-feedback"></div>
                                    </div>
                                    <div class="col-md-4">
                                        <label>Password</label>
                                    </div>
                                    <div class="col-md-8 form-group">
                                        <input type="password" id="password" name="password" class="form-control" value="" placeholder="Password" />
                                        <div id="password-feedback" class="invalid-feedback"></div>
                                    </div>

                                    <div class="col-sm-12 d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary me-1 mb-1">
                                            Ganti
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<script>
    function validateForm() {
        // Ambil nilai input
        var nama = document.getElementById("nama").value;
        var username = document.getElementById("username").value;
        var password = document.getElementById("password").value;

        // Inisialisasi mesej ralat
        var errorMessages = [];

        // Validasi
        if (nama.trim() === "") {
            errorMessages.push("Nama Lengkap wajib diisi");
            document.getElementById("nama-feedback").innerHTML = "Nama Lengkap wajib diisi";
            document.getElementById("nama-feedback").style.display = "block";
            document.getElementById("nama").classList.add("is-invalid");
        } else {
            document.getElementById("nama-feedback").style.display = "none";
            document.getElementById("nama").classList.remove("is-invalid");
        }

        if (username.trim() === "") {
            errorMessages.push("Username wajib diisi");
            document.getElementById("username-feedback").innerHTML = "Username wajib diisi";
            document.getElementById("username-feedback").style.display = "block";
            document.getElementById("username").classList.add("is-invalid");
        } else {
            document.getElementById("username-feedback").style.display = "none";
            document.getElementById("username").classList.remove("is-invalid");
        }

        if (password.trim() === "") {
            errorMessages.push("Password wajib diisi");
            document.getElementById("password-feedback").innerHTML = "Password wajib diisi";
            document.getElementById("password-feedback").style.display = "block";
            document.getElementById("password").classList.add("is-invalid");
        } else {
            document.getElementById("password-feedback").style.display = "none";
            document.getElementById("password").classList.remove("is-invalid");
        }

        // Tampilkan mesej ralat jika ada
        if (errorMessages.length > 0) {
            return false;
        }

        // Jika semua input sah
        return true;
    }
</script>




@endsection