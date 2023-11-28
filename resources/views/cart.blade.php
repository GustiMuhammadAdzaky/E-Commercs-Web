@extends('layouts.app')

@section('content')



<main class="my-8">
    <div class="container px-6 mx-auto">

        <div class="flex justify-center my-6">

            <div class="flex flex-col w-full p-8 text-gray-800 bg-white shadow-lg pin-r pin-y md:w-4/5 lg:w-4/5">
                @if ($message = Session::get('success'))
                <div class="alert alert-success" role="alert">
                    {{ $message }}
                </div>
                @endif
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item active">Cart</li>
                    </ol>
                </nav>
                <h3 class="text-3xl text-bold">Cart List</h3>
                <div class="flex-1">
                    <table class="w-full text-sm lg:text-base" cellspacing="0">
                        <thead>
                            <tr class="h-12 uppercase">
                                <th class="hidden md:table-cell"></th>
                                <th class="text-left">Nama</th>
                                <th>
                                    <span class="hidden lg:inline">Jumlah</span>
                                </th>
                                <th>Harga Satuan</th>
                                <th>Remove</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cartItems as $item)
                            <tr>
                                <td class="hidden pb-4 md:table-cell">
                                    <img src="{{ $item->attributes->image }}" class="w-20 rounded" alt="Thumbnail">
                                </td>
                                <td>
                                    <p>{{ $item->name }}</p>
                                </td>
                                <td>
                                    <div class="h-10 w-28">
                                        <div class="relative flex flex-row w-full h-8">

                                            <form action="{{ route('cart.update') }}" method="POST" class="flex">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $item->id }}">
                                                <input type="number" name="quantity" value="{{ $item->quantity }}"
                                                    class="w-12 text-center bg-gray-300" />
                                                <button type="submit"
                                                    class="px-2 pb-2 ml-2 text-white bg-blue-500">Update</button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="text-sm font-medium lg:text-base">
                                        Rp. {{ $item->price }}
                                    </span>
                                </td>
                                <td>
                                    <form action="{{ route('cart.remove') }}" method="POST">
                                        @csrf
                                        <input type="hidden" value="{{ $item->id }}" name="id">
                                        <button class="px-4 py-2 text-white bg-red-600">x</button>
                                    </form>

                                </td>
                            </tr>

                            @endforeach

                        </tbody>
                    </table>
                    <!-- <div>
                        Total: Rp.{{ Cart::getTotal() }}
                    </div> -->
                    <div class="container">
                        <div class="d-flex justify-content-between">
                            <form action="{{ route('checkout.store') }}" method="POST" class="mb-2">
                                @csrf
                                @foreach ($cartItems as $item)
                                <input type="hidden" name="id_produk[]" value="{{ $item->id }}">
                                @endforeach
                                <button type="submit" class="btn btn-outline-success">Check Out</button>
                            </form>
                            <form action="{{ route('cart.clear') }}" method="POST" class="mb-2">
                                @csrf
                                <button type="submit" class="btn btn-outline-danger">Remove All Cart</button>
                            </form>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
</main>
@endsection