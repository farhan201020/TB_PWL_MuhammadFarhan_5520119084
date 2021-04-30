<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class KategoriController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $kategori = Categories::all();
        return view('kategori_v', compact('user', 'kategori'));
    }

    public function add_categories(Request $req)
    {
        $kategori = new Categories;

        $kategori->name = $req->get('name');
        $kategori->description = $req->get('description');

        $kategori->save();

        $notification = array(
            'message' => 'Menambah Data Kategori Sukses',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.kategori')->with($notification);
    }
    //proses ajax
    public function getDataCategories($id)
    {
        $kategori = Categories::find($id);

        return response()->jsonp($kategori);
    }

    public function update_categories(Request $req)
    {

        $kategori = Categories::find($req->get('id'));

        $kategori->name = $req->get('name');
        $kategori->description = $req->get('description');

        $kategori->save();

        $notification = array(
            'message' => 'Edit Data Kategori Sukses',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.kategori')->with($notification);
    }

    public function delete_categories(Request $req)
    {
        $kategori = Categories::find($req->get('id'));

        $kategori->delete();

        $notification = array(
            'message' => 'Hapus Data Kategori Sukses',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.kategori')->with($notification);
    }
}
