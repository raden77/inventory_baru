<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Models\PenerimaanDetail;
use App\Models\Penerimaan;
use App\Models\Produk;
use App\Models\satuan;
use DB;

class PenerimaandetailController extends Controller
{
    //
    public function index()
    {
        
        $create_url = route('permintaandetail.create');

        return view('admin.penerimaandetail.index',compact('create_url'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $list_url= route('permintaandetail.index');
         $info['title'] = 'Create PermintaanDetail';
        
        return view('admin.penerimaandetail.create', compact('list_url','info'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $penerimaan = $request;
        // $penerimaandetail = PenerimaanDetail::where('no_penerimaan', $request->no_penerimaan)->get();
        // $list_url= route('penerimaan.index');

        $penerimaandetail = PenerimaanDetail::create($request->all());

        if($penerimaandetail){
            $produk = Produk::find($penerimaandetail->kode_produk);

            $produk->stok = $produk->stok + $penerimaandetail->qty;
            $produk->save();
        }
        //return view('admin.permintaandetail.index', compact('permintaandetail','permintaan','list_url'));
        //return redirect()->route('permintaandetail.index', [$permintaan,$permintaandetail,$list_url]);
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $Customer
     * @return \Illuminate\Http\Response
     */
    public function show(PenerimaanDetail $penerimaandetail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $Customer
     * @return \Illuminate\Http\Response
     */
    public function edit(PenerimaanDetail $penerimaandetail)
    {
        $id = $penerimaandetail->id;
        $data = PenerimaanDetail::find($id);
        $output = array(
            'no_penerimaan'=>$data->no_penerimaan,
            'kode_produk'=>$data->kode_produk,
            'qty'=>$data->qty,
            'harga'=>$data->harga,
            'id'=>$data->id,
        );
        return response()->json($output);
        //
        // $list_url= route('permintaandetail.index');
        // $info['title'] = 'Edit PermintaanDetail';
        
        // // dd($PermintaanDetail);
        // return view('admin.permintaandetail.edit', compact('permintaandetail','list_url','info'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $Customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PenerimaanDetail $penerimaandetail)
    {
        //
      $request->validate([
        'no_penerimaan'=> 'required',
        'kode_produk'=> 'required',
        'qty'=> 'required',
        'harga'=> 'required',
      ]);
    
     $penerimaandetail->update($request->all());	
      
      return redirect()->back();
    
    //   return redirect()->route('penerimaandetail.index');
    }

    public function updateAjax(Request $request)
    {
        //
      $request->validate([
        'no_penerimaan'=> 'required',
        'kode_produk'=> 'required',
        'qty'=> 'required',
        'harga'=> 'required',
      ]);

      $penerimaandetail = PenerimaanDetail::find($request->id)->update($request->all());
   
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
    public function destroy(PenerimaanDetail $penerimaandetail)
    {
           try {
            $penerimaandetail->delete();

            if($penerimaandetail){
                $produk = Produk::find($penerimaandetail->kode_produk);
    
                $produk->stok = $produk->stok - $penerimaandetail->qty ;
                $produk->save();
            }

            $message = [
                'success' => true,
                'title' => 'Update',
                'message' => 'Selamat! Data ['.$penerimaandetail->no_penerimaan.'] berhasil dihapus.'
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
