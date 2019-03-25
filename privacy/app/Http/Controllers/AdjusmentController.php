<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Models\Adjustment;
use App\Models\Produk;
use PDF;
use Excel;
use DB;

class AdjusmentController extends Controller
{
    //
    public function index()
    {
        
        $create_url = route('pemakaian.create');
        $produk = Produk::pluck('nama_produk','kode_produk');

        return view('admin.adjustment.index',compact('create_url','produk'));

    }

    public function anyData()
    {
        return Datatables::of(Adjustment::with('produk'))
           ->addColumn('action', function ($query){
            return '<a href="javascript:;" onclick="edit(\''.$query->id.'\',\''.$query->edit_url.'\')" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> Edit</a>'
            .'&nbsp'.
            '<a href="javascript:;" onclick="del(\''.$query->id.'\',\''.$query->destroy_url.'\')" id="hapus" class="btn btn-danger btn-sm"> <i class="fa fa-times-circle"></i> Hapus</a>'
            .'&nbsp';
                           })
            ->make(true);

    }

    public function Post()
    {
        //
        $adjustment = Adjustment::find(request()->id);
        // dd($permintaan);
    
        $adjustment->status = "POSTED";
        $adjustment->save();
        $message = [
            'success' => true,
            'title' => 'Update',
            'message' => 'Selamat! Data berhasil di Update.'
            ];
        return response()->json($message);
    //  return redirect()->back();
        // return redirect()->route('satuan.index');
    }

    public function Unpost()
    {
        //
        $adjustment = Adjustment::find(request()->id);
        // dd($permintaan);
    
        $adjustment->status = "UNPOSTED";
        $adjustment->save();	
        $message = [
            'success' => true,
            'title' => 'Update',
            'message' => 'Selamat! Data berhasil di Update.'
            ];
        return response()->json($message);
    //  return redirect()->back();
        // return redirect()->route('satuan.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $list_url= route('adjustment.index');
         $produk = Produk::pluck('nama_produk','kode_produk');
         $info['title'] = 'Create Adjustment';
        
        return view('admin.adjustment.add', compact('list_url','info','produk'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
        $adjustment = Adjustment::create($request->all());
        
        return redirect()->route('adjustment.index');

    }

    public function addstore(Request $request)
    {
        
        try {
            $adjustment = Adjustment::create($request->all());
            $output = array(
                'no_penyesuaian'=> $adjustment->no_penyesuaian,
            );
            return response()->json($output);
        }catch (\Exception $exception){
            $message = [
                'success' => false,
                'title' => 'Simpan',
                'message' => 'Maaf! Data Gagal di Simpan',
                'error'=> $exception->getMessage()
                ];
            return response()->json($message);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $Customer
     * @return \Illuminate\Http\Response
     */
    public function show(Adjustment $adjusment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $Customer
     * @return \Illuminate\Http\Response
     */
    // public function edit(Adjustment $adjustment)
    // {
    //     //
    //     $list_url= route('adjustment.index');
    //     $info['title'] = 'Edit adjustment';
        
    //     // dd($Pemakaian);
    //     return view('admin.adjustment.edit', compact('adjustment','list_url','info'));
    // }

    public function edit(Adjustment $adjustment)
    {
        $no_penyesuaian = $adjustment->no_penyesuaian;
        $data = Adjustment::find($no_penyesuaian);
        $output = array(
            'no_penyesuaian'=> $data->no_penyesuaian,
            'tanggal'=> $data->tanggal,
            'kode_produk'=> $data->kode_produk,
            'nama_produk'=> $data->nama_produk,
            'jumlah'=> $data->jumlah,
            'keterangan'=> $data->keterangan,
        );
        return response()->json($output);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $Customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Adjustment $adjustment)
    {
        //
      $request->validate([
        'no_penyesuaian'=> 'required',
        'tanggal'=> 'required',
        'kode_produk'=> 'required',
        'nama_produk'=> 'required',
        'jumlah'=> 'required',
        'keterangan'=> 'required',
      ]);
    
     $adjustment->update($request->all());	

      return redirect()->route('adjustment.index');
    }

    public function updateAdjusment(Request $request)
    {
        //
      $request->validate([
        'no_penyesuaian'=> 'required',
        'tanggal'=> 'required',
        'kode_produk'=> 'required',
        'nama_produk'=> 'required',
        'jumlah'=> 'required',
        'keterangan'=> 'required',
      ]);

      $adjusment = Adjustment::find($request->no_penyesuaian)->update($request->all());
   
    //   $message = [
    //     'success' => true,
    //     'title' => 'Update',
    //     'message' => 'Selamat! Data berhasil di Update.'
    //     ];
    //     return response()->json($message);
    //  return redirect()->back();
     return redirect()->route('adjustment.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $Customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Adjustment $adjustment)
    {
           try {
            $adjustment->delete();

            $message = [
                'success' => true,
                'title' => 'Update',
                'message' => 'Selamat! Data ['.$adjustment->no_penyesuaian.'] berhasil dihapus.'
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
