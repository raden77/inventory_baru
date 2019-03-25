<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Models\satuan;


class SatuanController extends Controller
{
    //

    public function index()
    {
        
        $create_url = route('satuan.create');

        return view('admin.satuan.index',compact('create_url'));

    }

    public function anyData()
    {
        return Datatables::of(satuan::query())
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
         $list_url= route('satuan.index');
         $info['title'] = 'Create Satuan';

        return view('admin.satuan.create', compact('list_url','info'));
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
            'kode_satuan'=>'required',
            'nama_satuan'=> 'required',
            'status' => 'required'
          ]);
          
        try {
            satuan::create($request->all());
            $message = [
            'success' => true,
            'title' => 'Simpan',
            'message' => 'Selamat! Data berhasil di Disimpan.'
            ];
            return response()->json($message);
        }catch (\Exception $exception){

            return response()->json(['errors' => $validator->errors()]);
        }
        //  satuan::create($request->all());
        //  return redirect()->route('satuan.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $Customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $Customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $Customer
     * @return \Illuminate\Http\Response
     */
    // public function edit(satuan $satuan)
    // {
    //     //
    //     $list_url= route('satuan.index');
    //     $info['title'] = 'Edit Satuan';
       
    //     return view('admin.satuan.edit', compact('satuan','list_url','info'));
    // }

    public function edit(satuan $satuan)
    {
        $kode_satuan = $satuan->kode_satuan;
        $data = satuan::find($kode_satuan);
        $output = array(
            'kode_satuan'=>$data->kode_satuan,
            'nama_satuan'=>$data->nama_satuan,
            'status'=>$data->status,
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
    // public function update(Request $request, satuan $satuan)
    // {
    //     //
    //   $request->validate([
    //     'kode_satuan'=>'required',
    //     'nama_satuan'=> 'required',
    //     'status' => 'required'
    //   ]);
    
    //  $satuan->update($request->all());	

    //   return redirect()->route('satuan.index');
    // }

    public function updateAjax(Request $request)
    {
        //
      $request->validate([
        'kode_satuan'=>'required',
        'nama_satuan'=> 'required',
        'status' => 'required'
      ]);

      satuan::find($request->kode_satuan)->update($request->all());
   
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
    public function destroy(satuan $satuan)
    {
           try {
            $satuan->delete();

            $message = [
                'success' => true,
                'title' => 'Update',
                'message' => 'Selamat! Data ['.$satuan->nama_satuan.'] berhasil dihapus.'
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
