<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\MerekBarangController;
use App\Http\Controllers\AkunController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\KategoriController;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Admin Route
Route::get('admin/home', [AdminController::class, 'index'])
    ->name('admin.home')
    ->middleware('is_admin');


//Route Book
Route::get('admin/books', [BookController::class, 'index'])
    ->name('admin.books')
    ->middleware('is_admin');

Route::post('admin/books', [BookController::class, 'store'])
    ->name('admin.book.submit')
    ->middleware('is_admin');
Route::patch('admin/books/update', [BookController::class, 'update'])
    ->name('admin.book.update')
    ->middleware('is_admin');

Route::get('admin/ajaxadmin/dataBuku/{id}', [BookController::class, 'getDataBuku']);
Route::delete('admin/books/delete', [BookController::class, 'destroy'])
    ->name('admin.book.delete')
    ->middleware('is_admin');


//Route PRINT PDF
Route::get('admin/print_books', [BookController::class, 'print_books'])
    ->name('admin.print.books')
    ->middleware('is_admin');


//Route PRINT EXCEL
Route::get('admin/books/export', [BookController::class, 'export'])
    ->name('admin.book.export')
    ->middleware('is_admin');



//Route IMPORT EXCEL
Route::post('admin/books/import', [BookController::class, 'import'])
    ->name('admin.book.import')
    ->middleware('is_admin');


//Route User
Route::get('admin/akun_user_admin', [AkunController::class, 'index'])
    ->name('admin.user')
    ->Middleware('is_admin');

//route tambah
Route::post('admin/akun_user_admin', [AkunController::class, 'add_user'])
    ->name('admin.user.submit')
    ->middleware('is_admin');

//route edit
Route::patch('admin/akun_user_admin/update', [AkunController::class, 'update_user'])
    ->name('admin.user.update')
    ->middleware('is_admin');
Route::get('admin/ajaxadmin/dataUser/{id}', [AkunController::class, 'getDataUser']);

//route delete
Route::delete('admin/akun_user_admin/delete', [AkunController::class, 'destroy'])
    ->name('admin.user.delete')
    ->middleware('is_admin');





//Route Kategori
Route::get('admin/kategori_produk', [KategoriController::class, 'index'])
    ->name('admin.kategori')
    ->middleware('is_admin');
Route::post('admin/kategori_produk', [KategoriController::class, 'add_categories'])
    ->name('admin.kategori.submit')
    ->middleware('is_admin');
//route edit Kategori
Route::patch('admin/kategori_produk/update', [KategoriController::class, 'update_categories'])
    ->name('admin.kategori.update')
    ->middleware('is_admin');
Route::get('admin/ajaxadmin/dataCategories/{id}', [KategoriController::class, 'getDataCategories']);

//route delete Kategori
Route::delete('admin/kategori_produk/delete', [KategoriController::class, 'delete_categories'])
    ->name('admin.kategori.delete')
    ->middleware('is_admin');


//ROUTE UTAMA Merek Produk
Route::get('admin/merek_produk', [MerekBarangController::class, 'index'])
    ->name('admin.merek')
    ->middleware('is_admin');

//route tambah Merek Produk
Route::post('admin/merek_produk', [MerekBarangController::class, 'add_brand'])
    ->name('admin.brand.submit')
    ->middleware('is_admin');

//route edit Merek Produk
Route::patch('admin/merek_produk/update', [MerekBarangController::class, 'update_brands'])
    ->name('admin.brand.update')
    ->middleware('is_admin');
Route::get('admin/ajaxadmin/dataBrands/{id}', [MerekBarangController::class, 'getDataBrands']);

//route delete Merek Produk
Route::delete('admin/merek_produk/delete', [MerekBarangController::class, 'delete_brands'])
    ->name('admin.brand.delete')
    ->middleware('is_admin');


//Route Pengelolaan Produk
Route::get('admin/pengelolaan_produk', [App\Http\Controllers\ProdukController::class, 'index'])
    ->name('admin.product')
    ->middleware('is_admin');

//Route Tambah Pengelolaan Produk
Route::post('admin/pengelolaan_produk', [ProdukController::class, 'add_product'])
    ->name('admin.product.submit')
    ->middleware('is_admin');

Route::patch('admin/pengelolaan_produk/update', [ProdukController::class, 'edit_product'])
    ->name('admin.product.update')
    ->middleware('is_admin');
Route::get('admin/ajaxadmin/dataProduct/{id}', [ProdukController::class, 'getDataProduct']);

//delete data
Route::delete('admin/pengelolaan_produk/delete',[ProdukController::class, 'destroy'])
->name('admin.product.delete')
->middleware('is_admin');



