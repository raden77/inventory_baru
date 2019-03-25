<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Models\PembelianDetail;
use App\Models\Pembelian;
use App\Models\Produk;
use App\Models\satuan;
use DB;

class PembeliandetailController extends Controller
{
    //
    public function index()
    {
        
        $create_url = route('pembeliandetail.create');

        return view('admin.pembeliandetail.index',compact('create_url'));

    }

    public function stockProduk()
    {
         //
         $produk = Produk::find(request()->id);
         // dd($produk);
     
         $output = array(
            'stock'=>$produk->stok,
            'harga_beli'=>$produk->harga_beli,
        );
        return response()->json($output);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $list_url= route('pembeliandetail.index');
         $info['title'] = 'Create Pembelian Detail';
        
        return view('admin.pembeliandetail.create', compact('list_url','info'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        pembeliandetail::create($request->all());
        //return view('admin.pembeliandetail.index', compact('pembeliandetail','permintaan','list_url'));
        //return redirect()->route('pembeliandetail.index', [$permintaan,$pembeliandetail,$list_url]);
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $Customer
     * @return \Illuminate\Http\Response
     */
    public function show(Pembeliandetail $pembeliandetail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $Customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Pembeliandetail $pembeliandetail)
    {
        $id = $pembeliandetail->id;
        $data = Pembeliandetail::find($id);
        $output = array(
            'no_pembelian'=>$data->no_pembelian,
            'kode_produk'=>$data->kode_produk,
            'kode_satuan'=>$data->kode_satuan,
            'qty'=>$data->qty,
            'harga'=>$data->harga,
            'id'=>$data->id,
        );
        return response()->json($output);
        //
        // $list_url= route('pembeliandetail.index');
        // $info['title'] = 'Edit pembeliandetail';
        
        // // dd($pembeliandetail);
        // return view('admin.pembeliandetail.edit', compact('pembeliandetail','list_url','info'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $Customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pembeliandetail $pembeliandetail)
    {
        //
      $request->validate([
        'no_pembelian'=> 'required',
        'kode_produk'=> 'required',
        'kode_satuan'=> 'required',
        'qty'=> 'required',
        'harga'=> 'required',
      ]);
    
     $pembeliandetail->update($request->all());	
      
      return redirect()->back();
    
    //   return redirect()->route('pembeliandetail.index');
    }

    public function updateAjax(Request $request)
    {
        //
      $request->validate([
        'no_pembelian'=> 'required',
        'kode_produk'=> 'required',
        'kode_satuan'=> 'required',
        'qty'=> 'required',
        'harga'=> 'required',
      ]);

      $satuan = PembelianDetail::find($request->id)->update($request->all());
   
    //   $message = [
    //     'success' => true,
    //     'title' => 'Update',
    //     'message' => 'Selamat! Data berhasil di Update.'
    //     ];
    //     return response()->json($message);
     return redirect()->back();
        // return redirect()->route('satuan.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $Customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pembeliandetail $pembeliandetail)
    {
           try {
            $pembeliandetail->delete();

            $message = [
                'success' => true,
                'title' => 'Update',
                'message' => 'Selamat! Data ['.$pembeliandetail->id.'] berhasil dihapus.'
            ];
            return response()->json($message);

        }catch (\Exception $exception){
            $message = [
                'success' => false,
                'title' => 'Update',
                'message' => 'Maaf! Data gagal dihapus.'
            ];
            return response()->json($message);
        }
    
    }

}
