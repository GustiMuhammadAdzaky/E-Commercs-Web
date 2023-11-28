<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductModel;

// Learn cart = https://larainfo.com/blogs/laravel-8-add-to-cart-step-by-step-example

class Product extends Controller
{
    public function index()
    {
        $productModel = ProductModel::all();
        $data = [
            'title' => 'Product',
            'productModel' => $productModel,
        ];

        return view('welcome', $data);
    }

    public function detail(Request $request)
    {
        $produk = ProductModel::find($request->input("id"));


        return view('detail', compact('produk'));
    }
}
