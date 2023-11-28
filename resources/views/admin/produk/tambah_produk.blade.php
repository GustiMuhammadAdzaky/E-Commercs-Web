<!-- Selesaikan Validation Deskripsi Produk dan belajar upload gambar di : https://www.malasngoding.com/membuat-upload-file-laravel/ -->
@extends('layout_login.app')


@section('content')
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
<style>
    .required-field::after {
        content: "*";
        color: red;
    }
</style>

<div class="page-heading">
    <h3>Selamat Data di {{$nama}}</h3>
</div>


@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif



<section id="multiple-column-form">
    <div class="row match-height">
        <div class="col-md-8 col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Form Data Produk</h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <form class="form" data-parsley-validate action="/kelola_produk/tambah_validation" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group mandatory">
                                        <label for="nama-produk" class="form-label required-field">Nama Produk</label>
                                        <input type="text" id="nama-produk" class="form-control" placeholder="Isikan Nama Produk !" name="nama-produk" value="" />
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="harga-produk" class="form-label required-field">Harga Produk</label>
                                        <input type="text" id="harga-produk" class="form-control" placeholder="Isikan Harga Produk" name="harga-produk" value="" />
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="berat-produk" class="form-label required-field">Berat Produk</label>
                                        <input type="text" id="berat-produk" class="form-control" placeholder="Isikan Harga Produk" name="berat-produk" value="" />
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="image" class="form-label required-field">Gambar</label>
                                        <input name="foto_produk" class="form-control" type="file" id="image" onchange="previewImage()">
                                    </div>
                                </div>
                                <div class="col-sm-5 mb-2">
                                    <div class="text-center">
                                        <img class="img-preview img-fluid">
                                    </div>
                                </div>

                                <div class="col-12">
                                    <textarea class="form-control" name="deskripsi_produk" id="summernote"></textarea>
                                </div>

                            </div>

                            <div class="row mt-5">
                                <div class="col-12 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary me-1 mb-1">
                                        Tambah
                                    </button>
                                    <button type="reset" onClick="parent.location='/kelola_produk'" class="btn btn-light-secondary me-1 mb-1">
                                        back
                                    </button>
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
    $('#summernote').summernote({
        placeholder: 'Tuliskan Deskripsi dengan minimal 20 kata dan maksimal 50 kata',
        tabsize: 2,
        height: 400,
        toolbar: [
            // ['style', ['style']],
            // ['font', ['bold', 'underline', 'clear']],
            // ['color', ['color']],
            // ['para', ['ul', 'ol', 'paragraph']],
            // ['table', ['table']],
            // ['insert', ['link', 'picture', 'video']],
            ['view', ['codeview', 'help']]
        ]
    });

    function previewImage() {
        const image = document.querySelector("#image");
        const imgPreview = document.querySelector('.img-preview');
        imgPreview.style.display = 'block';

        const oFReader = new FileReader();
        oFReader.readAsDataURL(image.files[0]);

        oFReader.onload = function(oFREvent) {
            imgPreview.src = oFREvent.target.result;
        }
    }
</script>
@endsection