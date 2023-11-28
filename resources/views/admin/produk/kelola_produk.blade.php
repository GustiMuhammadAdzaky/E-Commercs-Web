@extends('layout_login.app')
@section('content')


<div class="page-heading">
    <h3>Selamat Data di {{$nama}}</h3>
</div>
@if (session('status'))
<div class="alert alert-success">
    {{ session('status') }}
</div>
@endif
<section class="section">
    <div class="row" id="basic-table">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Tabel {{$nama}}</h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary me-1 mb-1" onClick="parent.location='/kelola_produk/tambah_produk'">
                                    Tambah Data
                                </button>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-lg">
                                <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <th>Harga Produk</th>
                                        <th>Detail</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach($productModel as $product)
                                    <tr>
                                        <td>{{ $product["nama_produk"]  }}</td>
                                        <td>{{ $product["harga_produk"] }}</td>
                                        <td><a href="kelola_produk/detail?id={{$product['id_produk']}}"><span class="badge bg-info text-light">detail</span></a></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Basic Tables end -->




</section>
@endsection