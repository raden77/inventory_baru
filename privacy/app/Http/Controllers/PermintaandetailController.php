<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Models\PermintaanDetail;
use App\Models\Permintaan;

class PermintaandetailController extends Controller
{
    //
    public function index()
    {
        
        $create_url = route('permintaandetail.create');

        return view('admin.permintaandetail.index',compact('create_url'));

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
        
        return view('admin.permintaandetail.create', compact('list_url','info'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $permintaan = $request;
        // $permintaandetail = PermintaanDetail::where('no_permintaan', $request->no_permintaan)->get();
        // $list_url= route('permintaan.index');
        // PermintaanDetail::create($request->all());
        try {
            $permintaandetail = PermintaanDetail::create($request->all());
            $message = [
            'success' => true,
            'title' => 'Simpan',
            'message' => 'Item Berhasil Ditambahkan'
            ];
            return response()->json($message);
        }catch (\Exception $exception){
            $message = [
                'success' => false,
                'title' => 'Gagal',
                'message' => 'Maaf! Item Gagal di Ditambah',
                'error'=> $exception->getMessage()
                ];
            return response()->json($message);
        }
        //return view('admin.permintaandetail.index', compact('permintaandetail','permintaan','list_url'));
        //return redirect()->route('permintaandetail.index', [$permintaan,$permintaandetail,$list_url]);
        // return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $Customer
     * @return \Illuminate\Http\Response
     */
    public function show(PermintaanDetail $permintaandetail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $Customer
     * @return \Illuminate\Http\Response
     */
    public function edit(PermintaanDetail $permintaandetail)
    {
        $id = $permintaandetail->id;
        $data = PermintaanDetail::find($id);
        $output = array(
            'id'=>$data->id,
            'no_permintaan'=>$data->no_permintaan,
            'kode_produk'=>$data->kode_produk,
            'kode_satuan'=>$data->kode_satuan,
            'qty'=>$data->qty,
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
    public function update(Request $request, PermintaanDetail $permintaandetail)
    {
        //
      $request->validate([
        'no_permintaan'=> 'required',
        'kode_produk'=> 'required',
        'kode_satuan'=> 'required',
        'qty'=> 'required',
      ]);
    
     $permintaandetail->update($request->all());	
     return redirect()->back();
     //return redirect()->route('permintaandetail.index');
    }

    public function updateAjax(Request $request)
    {
        //
      $request->validate([
        'no_permintaan'=> 'required',
        'kode_produk'=> 'required',
        'kode_satuan'=> 'required',
        'qty'=> 'required',
      ]);

      $permintaandetail = PermintaanDetail::find($request->id)->update($request->all());
   
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
    public function destroy(PermintaanDetail $permintaandetail)
    {
           try {
            $permintaandetail->delete();

            $message = [
                'success' => true,
                'title' => 'Update',
                'message' => 'Selamat! Data ['.$permintaandetail->no_permintaan.'] berhasil dihapus.'
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
