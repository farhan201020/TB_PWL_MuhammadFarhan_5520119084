<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Product;

class ProdukController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $barang = Product::all();
        return view('produk_v', compact('user', 'barang'));
    }

    public function add_product(Request $req)
    {

        $barang = new Product;

        $barang->name = $req->get('name');
        $barang->brands_id = $req->get('brands_id');
        $barang->categories_id = $req->get('categories_id');
        $barang->harga = $req->get('harga');
        $barang->stok = $req->get('stok');

        if ($req->hasFile('photo')) {
            $extension = $req->file('photo')->extension();

            $filename = 'photo_barang_' . time() . '.' . $extension;

            $req->file('photo')->storeAs(
                'public/photo_barang',
                $filename
            );

            $barang->photo = $filename;
            $barang->save();

            $notification = array(
                'message' => 'Data Produk Berhasil Ditambahkan',
                'alert-type' => 'success'
            );
            return redirect()->route('admin.product')->with($notification);
        }
    }
}
