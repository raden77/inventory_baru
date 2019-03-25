<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Models\MasterLokasi;

class MasterLokasiController extends Controller
{
    //
    public function index()
    {
        
        $create_url = route('masterlokasi.create');

        return view('admin.masterlokasi.index',compact('create_url'));

    }

    public function anyData()
    {
        return Datatables::of(MasterLokasi::query())
            ->editColumn('alamat', function ($query)
            {
                return str_limit($query->alamat,20,'...');
            })
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
         $list_url= route('masterlokasi.index');
         $info['title'] = 'Create Master Lokasi';

        return view('admin.masterlokasi.create', compact('list_url','info'));
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
            'nama_lokasi'=> 'required',
            'nickname'=> 'required',
            'alamat'=> 'required',
            'status'=> 'required',
        ]);

        try {
            MasterLokasi::create($request->all());
            $message = [
            'success' => true,
            'title' => 'Simpan',
            'message' => 'Selamat! Data berhasil di Disimpan.'
            ];
            return response()->json($message);
        }catch (\Exception $exception){

            return response()->json(['errors' => $validator->errors()]);
        }
        
        // return response()->json(['errors' => $validator->errors()]);

        // return redirect()->route('masterlokasi.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $Customer
     * @return \Illuminate\Http\Response
     */
    public function show(MasterLokasi $masterlokasi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $Customer
     * @return \Illuminate\Http\Response
     */
    // public function edit(masterlokasi $masterlokasi)
    // {
    //     //
    //     $list_url= route('masterlokasi.index');
    //     $info['title'] = 'Edit masterlokasi';
    //     // dd($masterlokasi);
    //     return view('admin.masterlokasi.edit', compact('masterlokasi','list_url','info'));
    // }

    public function edit(MasterLokasi $masterlokasi)
    {
        $id_lokasi = $masterlokasi->id_lokasi;
        $data = MasterLokasi::find($id_lokasi);
        $output = array(
            'id'=>$data->id_lokasi,
            'nama_lokasi'=>$data->nama_lokasi,
            'nickname'=>$data->nickname,
            'alamat'=>$data->alamat,
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
    // public function update(Request $request, Masterlokasi $masterlokasi)
    // {
    //     //
    //   $request->validate([
    //     'id_lokasi'=>'required',
    //     'nama_lokasi'=> 'required',
    //     'nickname'=> 'required',
    //     'alamat'=> 'required',
    //     'status'=> 'required',
    //   ]);
    
    //   $masterlokasi->update($request->all());	

    //   return redirect()->route('masterlokasi.index');
    // }

    public function updateAjax(Request $request)
    {
        //
      $request->validate([
        'id_lokasi'=>'required',
        'nama_lokasi'=> 'required',
        'nickname'=> 'required',
        'alamat'=> 'required',
        'status'=> 'required',
      ]);

      MasterLokasi::find($request->id_lokasi)->update($request->all());
   
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
    public function destroy(MasterLokasi $masterlokasi)
    {
        try {
            $masterlokasi->delete();

            $message = [
                'success' => true,
                'title' => 'Update',
                'message' => 'Selamat! Data ['.$masterlokasi->nama_lokasi.'] berhasil dihapus.'
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
