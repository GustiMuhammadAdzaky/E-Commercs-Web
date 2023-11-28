@extends('layouts.app')

@section('content')




<div class="container">
    <div class="text-center">
        <img src="<?= url('/image/bangunan.png'); ?>" alt="" width="100%">
    </div>
</div>



<br>


@if($message = Session::get('status'))
<script>
    Swal.fire({
        position: 'top-end',
        icon: 'success',
        title: '{{$message}}',
        showConfirmButton: false,
        timer: 1500
    })
</script>
@endif



@if(session('cartgagal'))

<script>
    Swal.fire({
        icon: 'warning',
        title: 'Peringatan',
        text: 'Anda harus login terlebih dahulu.',
        confirmButtonText: 'OK'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "/login"; // Redirect to the login page
        }
    });
</script>

@endif



@if($message = Session::get('success'))
<script>
    Swal.fire({
        position: 'top-end',
        icon: 'success',
        title: '{{$message}}',
        showConfirmButton: false,
        timer: 1500
    })
</script>
@endif



<div class="container">
    <div class="card shadow p-3 mb-5 bg-body rounded">
        <div class="card-body">
            <h3 class="mb-5">Barang</h3>
            <!-- container -->
            <div class="container">
                <div class="row">
                    @foreach($productModel as $product)
                    <div class="col-sm">
                        <div class="card shadow p-3 mb-5 bg-body rounded" style="width: 18rem;">
                            <img src="{{ asset('storage/images/' . $product['foto_produk']) }}" class="card-img-top"
                                alt="...">
                            <div class="card-body">
                                <h5 class="card-title">{{ $product["nama_produk"] }}</h5>
                                <div class="card-text">{!! Str::limit(strip_tags($product["deskripsi_produk"]), 50) !!}
                                </div>
                                <form action="detail" method="">
                                    <input type="hidden" value="{{ $product->id_produk }}" name="id">
                                    <button type="submit" class="btn btn-success mt-2"></i>Detail Produk</button>
                                </form>

                            </div>
                        </div>
                    </div>
                    @endforeach


                </div>
            </div>
            <!-- container -->
        </div>
    </div>
</div>




@endsection