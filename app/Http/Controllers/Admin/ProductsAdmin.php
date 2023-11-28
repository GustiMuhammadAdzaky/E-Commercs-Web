<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Product;
use Illuminate\Http\Request;
use App\Models\ProductModel;


class ProductsAdmin extends Controller
{
    public function index()
    {
        $productModel = ProductModel::all();
        $data = [
            'nama' => 'Kelola Produk',
            'productModel' => $productModel,
        ];
        return view("Admin.produk.kelola_produk", $data);
    }
    public function tambahProduk()
    {
        $data = [
            "nama" => "Tambah Produk"
        ];
        return view("Admin.produk.tambah_produk", $data);
    }

    public function tambahValidation(Request $request)
    {
        // dd($request->input());
        $validated = $request->validate([
            'nama-produk' => 'required',
            'harga-produk' => 'required',
            'berat-produk' => 'required',
            'foto_produk' => 'required|image|max:5000', // Maksimum 1000KB (1MB)
            'deskripsi_produk' => 'required',
        ], [
            'nama-produk.required' => 'Kolom nama produk harus diisi.',
            'harga-produk.required' => 'Kolom harga produk harus diisi.',
            'berat-produk.required' => 'Kolom berat produk harus diisi.',
            'foto_produk.required' => 'Kolom foto produk harus diisi.',
            'foto_produk.image' => 'Harus mengunggah file gambar.',
            'foto_produk.mimes' => 'File gambar hanya dapat dalam format JPG, JPEG, atau PNG.',
            'foto_produk.max' => 'Ukuran file gambar tidak boleh lebih dari 5000KB (1MB).',
            'deskripsi_produk.required' => 'Kolom deskripsi produk harus diisi dan memiliki minimal 20 kata.',
        ]);

        // dd($request->input('deskripsi_produk'));
        // Mendapatkan file gambar yang diunggah
        $gambar = $request->file('foto_produk');

        // Menentukan nama unik untuk file gambar, misalnya dengan timestamp
        $namaFile = time() . '_' . $gambar->getClientOriginalName();

        // Menyimpan file gambar ke dalam sistem penyimpanan yang telah Anda konfigurasi
        // C:\xampp\htdocs\toko-online\storage\app\
        $gambar->storeAs('public\images', $namaFile);

        // Membuat instance dari model ProductModel dan mengisi atribut gambar dengan nama file
        $product = new ProductModel([
            'nama_produk' => $request->input("nama-produk"),
            'harga_produk' => $request->input("harga-produk"),
            'berat_produk' => $request->input("berat-produk"),
            'foto_produk' => $namaFile, // Menggunakan nama file yang sudah dibuat
            'deskripsi_produk' => $request->input("deskripsi_produk"),
        ]);

        // Menyimpan data ke dalam database
        $product->save();

        // Redirect ke halaman yang sesuai atau berikan respons sesuai kebutuhan
        return redirect('/kelola_produk')->with('status', 'Data berhasil ditambahkan');
    }

    public function ubahValidation(Request $request)
    {

        $validated = $request->validate([
            'nama-produk' => 'required',
            'harga-produk' => 'required',
            'berat-produk' => 'required',
            'foto_produk' => 'image|max:5000', // Maksimum 1000KB (1MB)
            'deskripsi_produk' => 'required',
        ], [
            'nama-produk.required' => 'Kolom nama produk harus diisi.',
            'harga-produk.required' => 'Kolom harga produk harus diisi.',
            'berat-produk.required' => 'Kolom berat produk harus diisi.',
            'foto_produk.image' => 'Harus mengunggah file gambar.',
            'foto_produk.mimes' => 'File gambar hanya dapat dalam format JPG, JPEG, atau PNG.',
            'foto_produk.max' => 'Ukuran file gambar tidak boleh lebih dari 5000KB (1MB).',
            'deskripsi_produk.required' => 'Kolom deskripsi produk harus diisi dan memiliki minimal 20 kata.',
        ]);

        // Ambil data yang akan diperbarui dari database

        $produk = ProductModel::find($request->input('id-produk'));

        // Update data dengan data baru
        $produk->nama_produk = $request->input('nama-produk');
        $produk->harga_produk = $request->input('harga-produk');
        $produk->berat_produk = $request->input('berat-produk');
        $produk->deskripsi_produk = $request->input('deskripsi_produk');

        // Jika ada gambar yang diunggah, simpan gambar baru
        if ($request->hasFile('foto-produk')) {
            $foto = $request->file('foto-produk');
            $nama_foto = time() . '.' . $foto->getClientOriginalExtension();
            $foto->storeAs('public/images', $nama_foto);
            $produk->foto_produk = $nama_foto;
        }

        // Simpan perubahan ke dalam database
        $produk->save();

        // Redirect ke halaman yang sesuai
        return redirect('/kelola_produk')->with('status', 'Produk berhasil diperbarui.');
    }

    public function deleteProduk(Request $request)
    {
        $id = $request->input("id-produk");
        $productModel = ProductModel::find($id);
        $productModel->delete();

        return redirect('/kelola_produk')->with('status', 'Produk berhasil dihapus.');
    }

    public function detail(Request $request)
    {
        $id = $request->input('id');

        $data = [
            "nama" => "Detail Produk",
            "data" => $productModel = ProductModel::find($id),
        ];
        return view("Admin.produk.detail_produk", $data);
    }
}
