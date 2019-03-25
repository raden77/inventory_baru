<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Models\Vendor;

class VendorController extends Controller
{
    //
    public function index()
    {
        
        $create_url = route('vendor.create');

        return view('admin.vendor.index',compact('create_url'));

    }

    public function anyData()
    {
        return Datatables::of(Vendor::query())
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
         $list_url= route('vendor.index');
         $info['title'] = 'Create Vendor';

        return view('admin.vendor.create', compact('list_url','info'));
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
            'kode_vendor'=>'required',
            'nama_vendor'=> 'required',
            'alamat'=> 'required',
            'telp'=> 'required',
            'hp'=> 'required',
            'npwp'=> 'required',
            'termin_pembayaran'=> 'required',
            'status'=> 'required',
          ]);

        try {
            Vendor::create($request->all());
            $message = [
            'success' => true,
            'title' => 'Simpan',
            'message' => 'Selamat! Data berhasil di Disimpan.'
            ];
            return response()->json($message);
        }catch (\Exception $exception){
            
            return response()->json(['errors' => $validator->errors()]);
        }
        // Vendor::create($request->all());
        // return redirect()->route('vendor.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $Customer
     * @return \Illuminate\Http\Response
     */
    public function show(Vendor $Vendor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $Customer
     * @return \Illuminate\Http\Response
     */
    // public function edit(Vendor $vendor)
    // {
    //     //
    //     $list_url= route('vendor.index');
    //     $info['title'] = 'Edit Vendor';
    //     // dd($Vendor);
    //     return view('admin.vendor.edit', compact('vendor','list_url','info'));
    // }

    public function edit(Vendor $vendor)
    {
        $kode_vendor = $vendor->kode_vendor;
        $data = Vendor::find($kode_vendor);
        $output = array(
            'kode_vendor'=>$data->kode_vendor,
            'nama_vendor'=>$data->nama_vendor,
            'alamat'=>$data->alamat,
            'telp'=>$data->telp,
            'hp'=>$data->hp,
            'termin_pembayaran'=>$data->termin_pembayaran,
            'npwp'=>$data->npwp,
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
    // public function update(Request $request, Vendor $vendor)
    // {
    //     //
    //   $request->validate([
    //     'kode_vendor'=>'required',
    //     'nama_vendor'=> 'required',
    //     'status'=> 'required',
    //   ]);
    
    //  $vendor->update($request->all());	

    //   return redirect()->route('vendor.index');
    // }

    public function updateAjax(Request $request)
    {
        //
      $request->validate([
        'kode_vendor'=>'required',
        'nama_vendor'=> 'required',
        'alamat'=> 'required',
        'telp'=> 'required',
        'hp'=> 'required',
        'npwp'=> 'required',
        'termin_pembayaran'=> 'required',
        'status'=> 'required',
      ]);

      Vendor::find($request->kode_vendor)->update($request->all());
   
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
    public function destroy(Vendor $vendor)
    {
           try {
            $vendor->delete();

            $message = [
                'success' => true,
                'title' => 'Update',
                'message' => 'Selamat! Data ['.$vendor->nama_vendor.'] berhasil dihapus.'
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
