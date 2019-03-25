<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Models\KategoriProduk;

class KategoriProdukController extends Controller
{
    //

    public function index()
    {
        
        $create_url = route('kategoriproduk.create');

        return view('admin.kategoriproduk.index',compact('create_url'));

    }

    public function anyData()
    {
        return Datatables::of(KategoriProduk::query())
           ->addColumn('action', function ($query){
                return '<a href="javascript:;" onclick="edit(\''.$query->id.'\',\''.$query->edit_url.'\')" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> Edit</a>'.'&nbsp'.
                    '<a href="javascript:;" onclick="del(\''.$query->id.'\',\''.$query->destroy_url.'\')" id="hapus" class="btn btn-danger btn-sm"> <i class="fa fa-times-circle"></i> Hapus</a>'.'&nbsp';
                           })
            ->make(true);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $list_url= route('kategoriproduk.index');
         $info['title'] = 'Create KategoriProduk';

        return view('admin.kategoriproduk.create', compact('list_url','info'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = $request->validate([
            'kode_kategori'=>'required',
            'nama_kategori'=> 'required',
            'status'=> 'required',
          ]);

        try {
            KategoriProduk::create($request->all());
            $message = [
            'success' => true,
            'title' => 'Simpan',
            'message' => 'Selamat! Data berhasil di Disimpan.'
            ];
            return response()->json($message);
        }catch (\Exception $exception){
            
            return response()->json(['errors' => $validator->errors()]);
        }
        // KategoriProduk::create($request->all());
        // return redirect()->route('kategoriproduk.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $Customer
     * @return \Illuminate\Http\Response
     */
    public function show(KategoriProduk $KategoriProduk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $Customer
     * @return \Illuminate\Http\Response
     */
    // public function edit(KategoriProduk $kategoriproduk)
    // {
    //     //
    //     $list_url= route('kategoriproduk.index');
    //     $info['title'] = 'Edit KategoriProduk';
    //     // dd($KategoriProduk);
    //     return view('admin.kategoriproduk.edit', compact('kategoriproduk','list_url','info'));
    // }

    public function edit(KategoriProduk $kategoriproduk)
    {
        $kode_kategori = $kategoriproduk->kode_kategori;
        $data = KategoriProduk::find($kode_kategori);
        $output = array(
            'kode_kategori'=>$data->kode_kategori,
            'nama_kategori'=>$data->nama_kategori,
            'status'=>$data->status,
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
    // public function update(Request $request, KategoriProduk $kategoriproduk)
    // {
    //     //
    //   $request->validate([
    //     'kode_kategori'=>'required',
    //     'nama_kategori'=> 'required',
    //     'status'=> 'required',
    //   ]);
    
    //  $kategoriproduk->update($request->all());	

    //   return redirect()->route('kategoriproduk.index');
    // }

    public function updateAjax(Request $request)
    {
        //
      $request->validate([
        'kode_kategori'=>'required',
        'nama_kategori'=> 'required',
        'status'=> 'required',
      ]);

      $kategori = KategoriProduk::find($request->kode_kategori)->update($request->all());
   
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
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $Customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(KategoriProduk $kategoriproduk)
    {
           try {
            $kategoriproduk->delete();

            $message = [
                'success' => true,
                'title' => 'Update',
                'message' => 'Selamat! Data ['.$kategoriproduk->nama_kategori.'] berhasil dihapus.'
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
