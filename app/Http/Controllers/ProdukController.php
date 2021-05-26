<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Product;
use PDF;

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

    public function edit_product(Request $req){
       
        $barang = Product::find($req->get('id'));

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

            Storage::delete('public/photo_barang/' . $req->get('old_photo'));

            $barang->photo = $filename;
        }

        $barang->save();

        $notification = array(
            'message' => 'Edit data Produk Berhasil',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.product')->with($notification);
    }
    public function getDataProduct($id)
    {
        $barang = Product::find($id);

        return response()->json($barang);
    }

    public function destroy(Request $req){
        $barang = Product::find($req->id);

        Storage::delete('public/photo_barang/' . $req->get('old_photo'));
        $barang->delete();

        $notification = array(
            'message' => 'Delete Data Produk Berhasil',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.product')->with($notification);
        
    }
    
    public function print_laporan()
    {
        $laporan = Product::all();

        $pdf = PDF::loadview('print_laporan', ['laporan' => $laporan]);
        return $pdf->stream('data_laporan.pdf');
    }

    public function laporan_masuk()
    {
        $user = Auth::user();
        $barang = Product::all();
        return view('laporan_masuk_v', compact('user', 'barang'));
    }
}
