<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Models\Company;

class CompanyController extends Controller
{
    //
    public function index()
    {
        
        $create_url = route('company.create');

        return view('admin.company.index',compact('create_url'));

    }

    public function anyData()
    {
        return Datatables::of(Company::query())
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
         $list_url= route('company.index');
         $info['title'] = 'Create Company';

        return view('admin.company.create', compact('list_url','info'));
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
            'kode_company'=>'required',
            'nama_company'=> 'required',
            'alamat'=> 'required',
            'telp'=> 'required',
            'npwp'=> 'required',
            'status'=> 'required',
          ]);

        try {
            Company::create($request->all());
            $message = [
            'success' => true,
            'title' => 'Simpan',
            'message' => 'Selamat! Data berhasil di Disimpan.'
            ];
            return response()->json($message);
        }catch (\Exception $exception){
            
            return response()->json(['errors' => $validator->errors()]);
        }
        // Company::create($request->all());
        // return redirect()->route('company.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $Customer
     * @return \Illuminate\Http\Response
     */
    public function show(Company $Company)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $Customer
     * @return \Illuminate\Http\Response
     */
    // public function edit(Company $company)
    // {
    //     //
    //     $list_url= route('company.index');
    //     $info['title'] = 'Edit Company';
    //     // dd($Company);
    //     return view('admin.company.edit', compact('company','list_url','info'));
    // }

    public function edit(Company $company)
    {
        $kode_company = $company->kode_company;
        $data = Company::find($kode_company);
        $output = array(
            'kode_company'=>$data->kode_company,
            'nama_company'=>$data->nama_company,
            'alamat'=>$data->alamat,
            'telp'=>$data->telp,
            'npwp'=>$data->npwp,
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
    // public function update(Request $request, Company $company)
    // {
    //     //
    //   $request->validate([
    //     'kode_company'=>'required',
    //     'nama_company'=> 'required',
    //     'alamat'=> 'required',
    //     'telp'=> 'required',
    //     'npwp'=> 'required',
    //     'status'=> 'required',
    //   ]);
    
    //  $company->update($request->all());	

    //   return redirect()->route('company.index');
    // }

    public function updateAjax(Request $request)
    {
        //
      $request->validate([
        'kode_company'=>'required',
        'nama_company'=> 'required',
        'alamat'=> 'required',
        'telp'=> 'required',
        'npwp'=> 'required',
        'status'=> 'required',
      ]);

      Company::find($request->kode_company)->update($request->all());
   
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
    public function destroy(Company $company)
    {
           try {
            $company->delete();

            $message = [
                'success' => true,
                'title' => 'Update',
                'message' => 'Selamat! Data ['.$company->nama_company.'] berhasil dihapus.'
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
