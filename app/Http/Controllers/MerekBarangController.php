<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\Brands;
class MerekBarangController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $merek = Brands::all();
        return view('merekBarang_v', compact('user', 'merek'));
    }

    public function add_brand(Request $req)
    {
        $merek = new Brands;

        $merek->name = $req->get('name');
        $merek->description = $req->get('description');

        $merek->save();

        $notification = array(
            'message' => 'Data Merek Barang Berhasil Ditambah',
            'alert-type' => 'success'
        );


        return redirect()->route('admin.merek')->with($notification);
    }
    //Ajax Processes
    public function getDataBrands($id)
    {
        $merek = Brands::find($id);

        return response()->json($merek);
    }

    public function update_brands(Request $req)
    {
        $merek = Brands::find($req->get('id'));

        $merek->name = $req->get('name');
        $merek->description = $req->get('description');

        $merek->save();

        $notification = array(
            'message' => 'Edit Merek Barang Berhahsil',
            'alert-type' => 'success'
        );


        return redirect()->route('admin.merek')->with($notification);
    }
    public function delete_brands(Request $req)
    {
        $merek = Brands::find($req->get('id'));

        $merek->delete();
        $notification = array(
            'message' => 'Data Merek Barang Berhasil di Hapus',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.merek')->with($notification);
    }
}
