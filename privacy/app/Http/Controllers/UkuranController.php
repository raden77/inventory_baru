<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Models\Ukuran;


class UkuranController extends Controller
{
    //

    public function index()
    {
        
        $create_url = route('ukuran.create');

        return view('admin.ukuran.index',compact('create_url'));

    }

    public function anyData()
    {
        return Datatables::of(Ukuran::query())
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
         $list_url= route('ukuran.index');
         $info['title'] = 'Create Ukuran';

        return view('admin.ukuran.create', compact('list_url','info'));
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
            'kode_ukuran'=>'required',
            'nama_ukuran'=> 'required',
          ]);

        try {
            Ukuran::create($request->all());
            $message = [
            'success' => true,
            'title' => 'Simpan',
            'message' => 'Selamat! Data berhasil di Disimpan.'
            ];
            return response()->json($message);
        }catch (\Exception $exception){
            
            return response()->json(['errors' => $validator->errors()]);
        }
        //  Ukuran::create($request->all());
        //  return redirect()->route('ukuran.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $Customer
     * @return \Illuminate\Http\Response
     */
    public function show(Ukuran $Ukuran)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $Customer
     * @return \Illuminate\Http\Response
     */
    // public function edit(Ukuran $Ukuran)
    // {
    //     //
    //     $list_url= route('ukuran.index');
    //     $info['title'] = 'Edit Ukuran';
       
    //     return view('admin.ukuran.edit', compact('Ukuran','list_url','info'));
    // }

    public function edit(Ukuran $ukuran)
    {
        $kode_ukuran = $ukuran->kode_ukuran;
        $data = Ukuran::find($kode_ukuran);
        $output = array(
            'kode_ukuran'=>$data->kode_ukuran,
            'nama_ukuran'=>$data->nama_ukuran,
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
    // public function update(Request $request, Ukuran $Ukuran)
    // {
    //     //
    //   $request->validate([
    //     'kode_ukuran'=>'required',
    //     'nama_ukuran'=> 'required',
    //   ]);
    
    //  $Ukuran->update($request->all());	

    //   return redirect()->route('ukuran.index');
    // }

    public function updateAjax(Request $request)
    {
        //
      $request->validate([
        'kode_ukuran'=>'required',
        'nama_ukuran'=> 'required',
      ]);

      Ukuran::find($request->kode_ukuran)->update($request->all());
   
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
    public function destroy(Ukuran $Ukuran)
    {
           try {
            $Ukuran->delete();

            $message = [
                'success' => true,
                'title' => 'Update',
                'message' => 'Selamat! Data ['.$Ukuran->nama_ukuran.'] berhasil dihapus.'
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
