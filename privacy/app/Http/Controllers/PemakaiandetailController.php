<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Models\Pemakaian;
use App\Models\PemakaianDetail;
use App\Models\Produk;
use App\Models\satuan;
use DB;

class PemakaiandetailController extends Controller
{
    //
    public function index()
    {
        
        $create_url = route('pemakaiandetail.create');

        return view('admin.pemakaiandetail.index',compact('create_url'));

    }

    public function stockProduk()
    {
         //
         $produk = Produk::find(request()->id);
         // dd($produk);
     
         $output = array(
            'stock'=>$produk->stok,
            'hpp'=>$produk->hpp,
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
         $list_url= route('pemakaiandetail.index');
         $info['title'] = 'Create Pemakaian Detail';
        
        return view('admin.pemakaiandetail.create', compact('list_url','info'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $pemakaian = $request;
        // $pemakaiandetail = PemakaianDetail::where('no_pemakaian', $request->no_pemakaian)->get();
        // $list_url= route('pemakaian.index');
        $pemakaiandetail = PemakaianDetail::create($request->all());
        // dd($pemakaiandetail->kode_produk);
        if($pemakaiandetail){
            $produk = Produk::find($pemakaiandetail->kode_produk);

            $produk->stok = $produk->stok - $pemakaiandetail->qty ;
            $produk->save();
        }
        //return view('admin.PemakaianDetail.index', compact('PemakaianDetail','permintaan','list_url'));
        //return redirect()->route('PemakaianDetail.index', [$permintaan,$permintaandetail,$list_url]);
        return redirect()->back();
    }

    public function multistore(Request $request)
    {
        
         $no_pemakaian = $request->no_pemakaian[0];
         $produk = $request->kode_produk;
         $satuan = $request->kode_satuan;
         $qty = $request->qty;
         $harga = $request->harga;
        //  dd($no_pemakaian);
         $data = array();
         $kode_produk = array();
         $index = 0; // Set index array awal dengan 0
         foreach($produk as $rowdata){ 

           $data[] = array(
             'no_pemakaian'=>$no_pemakaian,
             'kode_produk'=>$produk[$index],
             'kode_satuan'=>$satuan[$index],
             'qty'=>$qty[$index],
             'harga'=>$harga[$index],
             'created_at'=>date('Y-m-d H:i:s'),
             'updated_at'=>date('Y-m-d H:i:s'),
             'created_by'=>Auth()->user()->id,
             'updated_by'=>Auth()->user()->id,
            );

            $kode_produk[]= array(
                'kode_produk'=>$produk[$index],
            );
           
           $index++;
         }
        // dd($kode_produk);
        // dd($data[0]['kode_produk']);
        
        if($kode_produk){
            // dd($data);
            $leng = count($kode_produk);
            $i = 0;
            $produk= Produk::whereIn('kode_produk',$kode_produk)->get();
            $produkO = (object) $produk;
            // dd($produkO[0]->stok);

            for($i = 0; $i < $leng; $i++){
                
                $produk = $produkO[$i]->stok - $data[$i]['qty'];
                $i++;

            }
            dd($produk);
            $produk->save();
        }

        $pemakaiandetail = PemakaianDetail::insert($data);
        // dd($pemakaiandetail->no_pemakaian);
        
        
        return redirect()->route('pemakaian.index');
        // return redirect()->back();
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $Customer
     * @return \Illuminate\Http\Response
     */
    public function show(PemakaianDetail $permintaandetail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $Customer
     * @return \Illuminate\Http\Response
     */
    public function edit(PemakaianDetail $pemakaiandetail)
    {
        $id = $pemakaiandetail->id;
        $data = PemakaianDetail::find($id);
        $output = array(
            'no_pemakaian'=>$data->no_pemakaian,
            'kode_produk'=>$data->kode_produk,
            'kode_satuan'=>$data->kode_satuan,
            'qty'=>$data->qty,
            'harga'=>$data->harga,
            'id'=>$data->id,
        );
        return response()->json($output);
        //
        // $list_url= route('PemakaianDetail.index');
        // $info['title'] = 'Edit PemakaianDetail';
        
        // // dd($permintaandetail);
        // return view('admin.PemakaianDetail.edit', compact('PemakaianDetail','list_url','info'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $Customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PemakaianDetail $pemakaiandetail)
    {
        //
      $request->validate([
        'no_pemakaian'=> 'required',
        'kode_produk'=> 'required',
        'kode_satuan'=> 'required',
        'qty'=> 'required',
        'harga'=>'required',
      ]);
    
     $pemakaiandetail->update($request->all());	

      return redirect()->route('pemakaiandetail.index');
    }

    public function updateAjax(Request $request)
    {
        //
      $request->validate([
        'no_pemakaian'=> 'required',
        'kode_produk'=> 'required',
        'kode_satuan'=> 'required',
        'qty'=> 'required',
        'harga'=>'required',
      ]);

      $pemakaiandetail = PemakaianDetail::find($request->id)->update($request->all());
   
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
    public function destroy(PemakaianDetail $pemakaiandetail)
    {
        try {
            $pemakaiandetail->delete();

            if($pemakaiandetail){
                $produk = Produk::find($pemakaiandetail->kode_produk);
    
                $produk->stok = $produk->stok + $pemakaiandetail->qty ;
                $produk->save();
            }

            $message = [
                'success' => true,
                'title' => 'Update',
                'message' => 'Selamat! Data ['.$pemakaiandetail->no_pemakaian.'] berhasil dihapus.'
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
