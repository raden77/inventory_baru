<?php

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

//Route::get('/', function () {
//    return view('welcome');
//});

Auth::routes();

Route::redirect('/','home');

Route::get('/home', 'HomeController@index')->name('home');

// Auth()->loginUsingId(1);
// dd(Auth()->user()->kode_company);
// Route::get('testing', function ()
// {
//     dd(Auth()->user()->kode_company);
// });


Route::middleware(['auth'])->prefix('admin')->group(function () {

     /**
     * Satuan
     */
    Route::get('satuan/anydata', 'SatuanController@anyData')->name('satuan.data');
    Route::post('satuan/updateAjax', 'SatuanController@updateAjax')->name('satuan.ajaxupdate');
    Route::resource('satuan', 'SatuanController');

    /**
     * Merek
     */
    Route::get('merek/anydata', 'MerekController@anyData')->name('merek.data');
    Route::post('merek/updateAjax', 'MerekController@updateAjax')->name('merek.ajaxupdate');
    Route::resource('merek', 'MerekController');

     /**
     * Ukuran
     */
    Route::get('ukuran/anydata', 'UkuranController@anyData')->name('ukuran.data');
    Route::post('ukuran/updateAjax', 'UkuranController@updateAjax')->name('ukuran.ajaxupdate');
    Route::resource('ukuran', 'UkuranController');

     /**
     * Kategori Produk
     */
    Route::get('kategoriproduk/anydata', 'KategoriProdukController@anyData')->name('kategoriproduk.data');
    Route::post('kategoriproduk/updateAjax', 'KategoriProdukController@updateAjax')->name('kategoriproduk.ajaxupdate');
    Route::resource('kategoriproduk', 'KategoriProdukController');

    /**
     * Vendor
     */
    Route::get('vendor/anydata', 'VendorController@anyData')->name('vendor.data');
    Route::post('vendor/updateAjax', 'VendorController@updateAjax')->name('vendor.ajaxupdate');
    Route::resource('vendor', 'VendorController');

    /**
     * Company
     */
    Route::get('company/anydata', 'CompanyController@anyData')->name('company.data');
    Route::post('company/updateAjax', 'CompanyController@updateAjax')->name('company.ajaxupdate');
    Route::resource('company', 'CompanyController');

    /**
     * Produk
     */
    
    Route::get('produk/anydata', 'ProdukController@anyData')->name('produk.data');
    Route::post('produk/updateAjax', 'ProdukController@updateAjax')->name('produk.ajaxupdate');
    Route::resource('produk', 'ProdukController');

    /**
     * Permintaan
     */
    Route::get('permintaan/cetakPDF', 'PermintaanController@cetakPDF')->name('permintaan.cetak');
    Route::get('permintaan/anydata', 'PermintaanController@anyData')->name('permintaan.data');
    Route::post('permintaan/updateAjax', 'PermintaanController@updateAjax')->name('permintaan.updateajax');
    Route::get('permintaan/{permintaan}/detail', 'PermintaanController@detail')->name('permintaan.detail');
    Route::post('permintaan/Post', 'PermintaanController@Post')->name('permintaan.post');
    Route::post('permintaan/Unpost', 'PermintaanController@Unpost')->name('permintaan.unpost');
    
    Route::resource('permintaan', 'PermintaanController');

    // /**
    //  * Permintaan Detail
    //  */
    
    Route::get('permintaandetail/anydata', 'PermintaanController@anyData')->name('permintaan.data');
    Route::get('permintaandetail/detaildata', 'PermintaandetailController@detailData')->name('detail.data');
    Route::post('permintaandetail/updateAjax', 'PermintaandetailController@updateAjax')->name('permintaandetail.updateajax');
    // Route::get('permintaandetail/{permintaan}/detail', 'PermintaandetailController@detail')->name('permintaandetail.detail');
    Route::resource('permintaandetail', 'PermintaandetailController');

    /**
     * Pemakaian
     */
    Route::get('pemakaian/cetakPDF', 'PemakaianController@cetakPDF')->name('pemakaian.cetak');
    Route::get('pemakaian/anydata', 'PemakaianController@anyData')->name('pemakaian.data');
    Route::post('pemakaian/updateAjax', 'PemakaianController@updateAjax')->name('pemakaian.updateajax');
    Route::get('pemakaian/{pemakaian}/detail', 'PemakaianController@detail')->name('pemakaian.detail');
    Route::get('pemakaian/cari', 'PemakaianController@loadData')->name('pemakaian.cari');
    Route::post('pemakaian/Post', 'PemakaianController@Post')->name('pemakaian.post');
    Route::post('pemakaian/Unpost', 'PemakaianController@Unpost')->name('pemakaian.unpost');
    Route::post('pemakaian/showdetail', 'PemakaianController@Showdetail')->name('pemakaian.showdetail');
    Route::post('pemakaian/addstore', 'PemakaianController@addstore')->name('pemakaian.addstore');
    Route::resource('pemakaian', 'PemakaianController');

    // /**
    //  * Pemakaian Detail
    //  */
    Route::post('pemakaiandetail/stockproduk', 'PemakaiandetailController@stockProduk')->name('pemakaiandetail.stockproduk');
    Route::get('pemakaiandetail/anydata', 'PermintaanController@anyData')->name('permintaan.data');
    Route::post('pemakaiandetail/updateAjax', 'PemakaiandetailController@updateAjax')->name('pemakaiandetail.updateajax');
    Route::post('pemakaiandetail/multistore', 'PemakaiandetailController@multistore')->name('pemakaiandetail.multistore');
    Route::resource('pemakaiandetail', 'PemakaiandetailController');

     /**
     * Penerimaan
     */
    Route::get('penerimaan/cetakPDF', 'PenerimaanController@cetakPDF')->name('penerimaan.cetak');
    Route::get('penerimaan/anydata', 'PenerimaanController@anyData')->name('penerimaan.data');
    Route::post('penerimaan/updateAjax', 'PenerimaanController@updateAjax')->name('penerimaan.updateajax');
    Route::get('penerimaan/{penerimaan}/detail', 'PenerimaanController@detail')->name('penerimaan.detail');
    Route::get('penerimaan/cari', 'PenerimaanController@loadData')->name('penerimaan.cari');
    Route::post('penerimaan/Post', 'PenerimaanController@Post')->name('penerimaan.post');
    Route::post('penerimaan/Unpost', 'PenerimaanController@Unpost')->name('penerimaan.unpost');
    Route::resource('penerimaan', 'PenerimaanController');

     // /**
    //  * Penerimaan Detail
    //  */
    Route::get('penerimaandetail/databaru', 'PenerimaandetailController@databaru')->name('penerimaandetail.baru');
    Route::get('penerimaandetail/anydata', 'PenerimaandetailController@anyData')->name('penerimaandetail.data');
    Route::post('penerimaandetail/updateAjax', 'PenerimaandetailController@updateAjax')->name('penerimaandetail.updateajax');
    Route::get('penerimaandetail/detaildata', 'PenerimaandetailController@detailData')->name('detail.data');
    // Route::get('permintaandetail/{permintaan}/detail', 'PermintaandetailController@detail')->name('permintaandetail.detail');
    Route::resource('penerimaandetail', 'PenerimaandetailController');

     /**
     * Memo
     */
    Route::get('memo/cetakPDF', 'MemoController@cetakPDF')->name('memo.cetak');
    Route::get('memo/anydata', 'MemoController@anyData')->name('memo.data');
    Route::post('memo/updateAjax', 'MemoController@updateAjax')->name('memo.updateajax');
    Route::get('memo/{memo}/detail', 'MemoController@detail')->name('memo.detail');
    Route::get('memo/cari', 'MemoController@loadData')->name('memo.cari');
    Route::post('memo/Post', 'MemoController@Post')->name('memo.post');
    Route::post('memo/Unpost', 'MemoController@Unpost')->name('memo.unpost');
    Route::resource('memo','MemoController');

     // /**
    //  * Memo Detail
    //  */
    Route::get('memodetail/anydata', 'MemodetailController@anyData')->name('memodetail.data');
    Route::post('memodetail/updateAjax', 'MemodetailController@updateAjax')->name('memodetail.updateajax');
    Route::get('memodetail/detaildata', 'MemodetailController@detailData')->name('memodetail.data');
    Route::resource('memodetail', 'MemodetailController');

    // /**
    //  * Pembelian
    //  */
    Route::get('pembelian/cetakPDF', 'PembelianController@cetakPDF')->name('pembelian.cetak');
    Route::get('pembelian/anydata', 'PembelianController@anyData')->name('pembelian.data');
    Route::post('pembelian/updateAjax', 'PembelianController@updateAjax')->name('pembelian.updateajax');
    Route::get('pembelian/{pembelian}/detail', 'PembelianController@detail')->name('pembelian.detail');
    Route::get('pembelian/cari', 'PembelianController@loadData')->name('pembelian.cari');
    Route::post('pembelian/Post', 'PembelianController@Post')->name('pembelian.post');
    Route::post('pembelian/Unpost', 'PembelianController@Unpost')->name('pembelian.unpost');
    Route::resource('pembelian','PembelianController');

     // /**
    //  * Pembelian Detail
    //  */
    Route::post('pembeliandetail/stockproduk', 'PembeliandetailController@stockProduk')->name('pembeliandetail.stockproduk');
    Route::post('pembeliandetail/updateAjax', 'PembeliandetailController@updateAjax')->name('pembeliandetail.updateajax');
    Route::get('pembeliandetail/anydata', 'PembeliandetailController@anyData')->name('pembeliandetail.data');
    Route::resource('pembeliandetail', 'PembeliandetailController');

    // /**
    //  * Master Lokasi
    //  */
    Route::get('masterlokasi/anydata', 'MasterLokasiController@anyData')->name('masterlokasi.data');
    Route::post('masterlokasi/updateAjax', 'MasterLokasiController@updateAjax')->name('masterlokasi.updateajax');
    Route::get('masterlokasi/{pembelian}/detail', 'MasterLokasiController@detail')->name('masterlokasi.detail');
    Route::resource('masterlokasi','MasterLokasiController');

     /**
     * Item bulanan
     */
    Route::get('itembulanan/index','ItembulananController@index');
    Route::get('itembulanan/add','ItembulananController@create');
    Route::post('itembulanan/store','ItembulananController@store');
    Route::post('itembulanan/show','ItembulananController@show')->name('itembulanan.show');
    Route::get('itembulanan/edit','ItembulananController@edit');

    // /**
    //  * Adjusment
    //  */
    Route::get('adjustment/anydata', 'AdjusmentController@anyData')->name('adjustment.data');
    Route::post('adjustment/updateAdjusment', 'AdjusmentController@updateAdjusment')->name('adjustment.updateAdjusment');
    Route::post('adjustment/Post', 'AdjusmentController@Post')->name('adjustment.post');
    Route::post('adjustment/Unpost', 'AdjusmentController@Unpost')->name('adjustment.unpost');
    Route::resource('adjustment','AdjusmentController');

     /**
     * Stock
     */
    Route::get('stock/index','StockController@index');
    Route::get('stock/add','StockController@create');
    Route::post('stock/store','StockController@store');
    Route::get('stock/chart','StockController@chart');
    

     /**
     * Users
     */
    Route::resource('users', 'UsersController');

    /*
     * Roles
     */
    Route::resource('roles', 'RolesController');

    /*
    * Permissions
    */
    Route::resource('permissions', 'PermissionsController');

});