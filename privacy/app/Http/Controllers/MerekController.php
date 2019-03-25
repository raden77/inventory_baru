<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Models\Merek;

class MerekController extends Controller
{
    //

    public function index()
    {
        
        $create_url = route('merek.create');

        return view('admin.merek.index',compact('create_url'));

    }

    public function anyData()
    {
        return Datatables::of(Merek::query())
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
         $list_url= route('merek.index');
         $info['title'] = 'Create Merek';

        return view('admin.merek.create', compact('list_url','info'));
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
            'kode_merek'=>'required',
            'nama_merek'=> 'required',
          ]);

        try {
            Merek::create($request->all());
            $message = [
            'success' => true,
            'title' => 'Simpan',
            'message' => 'Selamat! Data berhasil di Disimpan.'
            ];
            return response()->json($message);
        }catch (\Exception $exception){
            
            return response()->json(['errors' => $validator->errors()]);
        }
        //  Merek::create($request->all());
        //  return redirect()->route('merek.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $Customer
     * @return \Illuminate\Http\Response
     */
    public function show(Merek $Merek)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $Customer
     * @return \Illuminate\Http\Response
     */
    // public function edit(Merek $Merek)
    // {
    //     //
    //     $list_url= route('merek.index');
    //     $info['title'] = 'Edit Merek';
       
    //     return view('admin.merek.edit', compact('Merek','list_url','info'));
    // }

    public function edit(Merek $merek)
    {
        $kode_merek = $merek->kode_merek;
        $data = Merek::find($kode_merek);
        $output = array(
            'kode_merek'=>$data->kode_merek,
            'nama_merek'=>$data->nama_merek,
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
    // public function update(Request $request, Merek $Merek)
    // {
    //     //
    //   $request->validate([
    //     'kode_merek'=>'required',
    //     'nama_merek'=> 'required',
    //   ]);
    
    //  $Merek->update($request->all());	

    //   return redirect()->route('merek.index');
    // }

    public function updateAjax(Request $request)
    {
        //
      $request->validate([
        'kode_merek'=>'required',
        'nama_merek'=> 'required',
      ]);

      Merek::find($request->kode_merek)->update($request->all());
   
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
    public function destroy(Merek $Merek)
    {
           try {
            $Merek->delete();

            $message = [
                'success' => true,
                'title' => 'Update',
                'message' => 'Selamat! Data ['.$Merek->nama_merek.'] berhasil dihapus.'
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
