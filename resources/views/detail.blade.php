@extends('layouts.app')

@section('content')


<!-- coba -->
<style>
    /* Custom CSS for Quantity Selector */
    .quantity-selector {
        display: flex;
        align-items: center;
    }

    .quantity-input {
        width: 50px;
        text-align: center;
    }

    .quantity-control {
        cursor: pointer;
    }
</style>

<!-- belajar autentifikasi admin, agar apabila userrole ==  admin alert berubah !, selain itu sdah benar semua -->

<main class="my-8">
    <div class="container">

        <div class="flex justify-center my-6">
            <div class="flex flex-col w-full p-8 text-gray-800 bg-white shadow-lg pin-r pin-y md:w-4/5 lg:w-4/5">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item active">Detail</li>
                    </ol>
                </nav>
                <h3 class="text-3xl text-bold">Detail Produk</h3>
                <div class="card mb-3 bg-white">
                    <div class="row g-0">
                        <div class="col">
                            <div class="card-body">
                                <img src="{{ asset('storage/images/' . $produk->foto_produk) }}"
                                    class="img-fluid rounded-start" alt="...">
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">{{ $produk->nama_produk }}</h5>
                                <p class="card-text">{!! $produk->deskripsi_produk !!}</p>
                                <div class="card" style="width: 20rem;">
                                    <div class="card-body">
                                        <form class="addToCartForm" action="/cart" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" value="{{ $produk->id_produk }}" name="id">
                                            <input type="hidden" value="{{ $produk->nama_produk }}" name="name">
                                            <input type="hidden" value="{{ $produk->harga_produk }}" name="price">
                                            <input type="hidden"
                                                value="{{ asset('storage/images/' . $produk->foto_produk) }}"
                                                name="image">
                                            <div class="container">
                                                <div class="quantity-selector">
                                                    <button class="btn btn-secondary quantity-control" id="decrement"
                                                        type="button">-</button>
                                                    <input type="text" name="quantity"
                                                        class="form-control quantity-input" id="quantity"
                                                        value="{{$produk->berat_produk}}" readonly>
                                                    <button class="btn btn-success quantity-control" id="increment"
                                                        type="button">+</button>
                                                    @if (Auth::check())
                                                    <input type="hidden" value="{{ Auth::user()->id }}"
                                                        name="id_pembeli">
                                                    <button type="submit" class="btn btn-success ml-2"><i
                                                            class="bi bi-cart4"></i>Keranjang</button>
                                                    @else
                                                    <button type="button"
                                                        class="btn btn-success ml-2 addToCartButton"><i
                                                            class="bi bi-cart4"></i> Keranjang</button>
                                                    @endif
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
    // JavaScript untuk mengatur kuantitas
    const decrementButton = document.getElementById('decrement');
    const incrementButton = document.getElementById('increment');
    const quantityInput = document.getElementById('quantity');

    decrementButton.addEventListener('click', () => {
        let currentValue = parseInt(quantityInput.value, 10);
        if (currentValue > 1) {
            quantityInput.value = (currentValue - 1).toString();
        }
    });

    incrementButton.addEventListener('click', () => {
        let currentValue = parseInt(quantityInput.value, 10);
        quantityInput.value = (currentValue + 1).toString();
    });


    const addToCartButtons = document.querySelectorAll(".addToCartButton");

    addToCartButtons.forEach((button) => {
        button.addEventListener("click", function () {
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
        });
    });
</script>
@endsection