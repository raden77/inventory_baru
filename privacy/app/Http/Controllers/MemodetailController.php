<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Models\Memo;
use App\Models\MemoDetail;
use App\Models\Produk;
use App\Models\satuan;
use DB;

class MemodetailController extends Controller
{
    //
    public function index()
    {
        
        $create_url = route('memodetail.create');

        return view('admin.memodetail.index',compact('create_url'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $list_url= route('memodetail.index');
         $info['title'] = 'Create Pemakaian Detail';
        
        return view('admin.memodetail.create', compact('list_url','info'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
        Memodetail::create($request->all());
     
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $Customer
     * @return \Illuminate\Http\Response
     */
    public function show(Memodetail $memodetail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $Customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Memodetail $memodetail)
    {
        $id = $memodetail->id;
        $data = Memodetail::find($id);
        $output = array(
            'no_memo'=>$data->no_memo,
            'kode_produk'=>$data->kode_produk,
            'kode_satuan'=>$data->kode_satuan,
            'qty'=>$data->qty,
            'id'=>$data->id,
        );
        return response()->json($output);
        //
        // $list_url= route('memodetail.index');
        // $info['title'] = 'Edit memodetail';
        
        // // dd($permintaandetail);
        // return view('admin.memodetail.edit', compact('memodetail','list_url','info'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $Customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Memodetail $memodetail)
    {
        //
      $request->validate([
        'no_memo'=> 'required',
        'kode_produk'=> 'required',
        'kode_satuan'=> 'required',
        'qty'=> 'required',
      ]);
    
     $memodetail->update($request->all());	

      return redirect()->route('memodetail.index');
    }

    public function updateAjax(Request $request)
    {
        //
      $request->validate([
        'no_memo'=> 'required',
        'kode_produk'=> 'required',
        'kode_satuan'=> 'required',
        'qty'=> 'required',
      ]);

      $memodetail = MemoDetail::find($request->id)->update($request->all());
   
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
    public function destroy(Memodetail $memodetail)
    {
           try {
            $memodetail->delete();

            $message = [
                'success' => true,
                'title' => 'Update',
                'message' => 'Selamat! Data ['.$memodetail->id.'] berhasil dihapus.'
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
