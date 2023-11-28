<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// use App\Models\ProductModel;

class CheckOut extends Controller
{

    function store(Request $request)
    {
        // $id_produk = $request->input("id_produk");
        // $filteredProducts = ProductModel::whereIn('id_produk', $id_produk)->get();
        // return view("checkout", compact("filteredProducts"));
        $cartItems = \Cart::getContent();
        return view("checkout", compact("cartItems"));
    }
}
