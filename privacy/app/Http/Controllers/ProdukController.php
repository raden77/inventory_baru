<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Models\Produk;
use App\Models\KategoriProduk;
use App\Models\Merek;
use App\Models\Ukuran;
use App\Models\satuan;
use App\Models\Company;

class ProdukController extends Controller
{
    //
    public function index()
    {
        
        $create_url = route('produk.create');
        $Kategori = KategoriProduk::pluck('nama_kategori', 'kode_kategori');
        $Merek = Merek::pluck('nama_merek', 'kode_merek');
        $Ukuran= Ukuran::pluck('nama_ukuran', 'kode_ukuran');
        $Satuan= satuan::pluck('nama_satuan', 'kode_satuan');
        $Company= Company::pluck('nama_company', 'kode_company');
        return view('admin.produk.index',compact('create_url','Kategori','Merek','Ukuran'
        ,'Satuan','Company'));

    }

    public function anyData()
    {
        return Datatables::of(Produk::with('kategoriproduk','merek','ukuran','satuan','company'))
           ->addColumn('action', function ($query){

                $html_open = '<div class="dropdown">
                <button class="btn bg-purple dropdown-toggle" type="button" data-toggle="dropdown">Action
                <span class="caret"></span></button>
                <ul class="dropdown-menu">';

                $html_close = '</ul>
                </div>';

                $btn_edit = '<li><a href="javascript:;" onclick="edit(\''.$query->id.'\',\''.$query->edit_url.'\')" class=""><i class="fa fa-edit"></i> Edit</a></li>';
                $btn_destroy = '<li><a href="javascript:;" onclick="del(\''.$query->id.'\',\''.$query->destroy_url.'\')" id="hapus" class=""><i class="fa fa-times-circle"></i> Hapus</a></li>';
                $btn_show = '<li><a href="javascript:;" onclick="show(\''.$query->id.'\',\''.$query->show_url.'\')" class=""><i class="fa fa-eye"></i>Show</a></li>';

                $btn = $html_open;
                if (auth()->user()->can('update-produk')){
                    $btn .= $btn_edit;
                }
               
                $btn .= $btn_destroy;
                $btn .= $btn_show;
                $btn .= $html_close;

                return $btn
                // '<a href="javascript:;" onclick="edit(\''.$query->id.'\',\''.$query->edit_url.'\')" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> Edit</a>'.'&nbsp'.
                // '<a href="javascript:;" onclick="del(\''.$query->id.'\',\''.$query->destroy_url.'\')" id="hapus" class="btn btn-danger btn-sm"> <i class="fa fa-times-circle"></i> Hapus</a>'.'&nbsp'.
                // '<a href="javascript:;" onclick="show(\''.$query->id.'\',\''.$query->show_url.'\')" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i>Show</a>'.'&nbsp'.
                 
                ;
        
            })
            ->make(true);
    }

    public function anyData_backup()
    {
        return Datatables::of(Produk::with('kategoriproduk','merek','ukuran','satuan','company'))
           ->addColumn('action', function ($query){
                return 
                // '<a href="javascript:;" onclick="edit(\''.$query->id.'\',\''.$query->edit_url.'\')" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> Edit</a>'.'&nbsp'.
                // '<a href="javascript:;" onclick="del(\''.$query->id.'\',\''.$query->destroy_url.'\')" id="hapus" class="btn btn-danger btn-sm"> <i class="fa fa-times-circle"></i> Hapus</a>'.'&nbsp'.
                // '<a href="javascript:;" onclick="show(\''.$query->id.'\',\''.$query->show_url.'\')" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i>Show</a>'.'&nbsp'.
                '<div class="dropdown">
                    <button class="btn bg-purple dropdown-toggle" type="button" data-toggle="dropdown">Action
                    <span class="caret"></span></button>
                    <ul class="dropdown-menu">
                        <li><a href="javascript:;" onclick="edit(\''.$query->id.'\',\''.$query->edit_url.'\')" class=""><i class="fa fa-edit"></i> Edit</a></li>
                        <li><a href="javascript:;" onclick="del(\''.$query->id.'\',\''.$query->destroy_url.'\')" id="hapus" class=""><i class="fa fa-times-circle"></i> Hapus</a></li>
                        <li><a href="javascript:;" onclick="show(\''.$query->id.'\',\''.$query->show_url.'\')" class=""><i class="fa fa-eye"></i>Show</a></li>
                    </ul>
                </div>'
                ;
        
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
         $list_url= route('produk.index');
         $info['title'] = 'Create Produk';
         $Kategori = KategoriProduk::pluck('nama_kategori', 'kode_kategori');
         $Merek = Merek::pluck('nama_merek', 'kode_merek');
         $Ukuran= Ukuran::pluck('nama_ukuran', 'kode_ukuran');
         $Satuan= satuan::pluck('nama_satuan', 'kode_satuan');
         $Company= Company::pluck('nama_company', 'kode_company');
         return view('admin.produk.create', compact('list_url','info',
        'Kategori','Merek','Ukuran','Satuan','Company'));
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
                'nama_produk'=> 'required',
                'kode_kategori'=> 'required',
                'kode_merek'=> 'required',
                'kode_ukuran'=> 'required',
                'kode_satuan'=> 'required',
                // 'kode_company'=> 'required',
                'type'=> 'required',
                'harga_beli'=> 'required',
                'harga_jual'=> 'required',
                'hpp'=> 'required',
                'stok'=> 'required',
                'aktif'=> 'required',
        ]);

        try {
            $Produk = Produk::create($request->all());
            $message = [
            'success' => true,
            'title' => 'Simpan',
            'message' => 'Selamat! Data Berhasil di Disimpan.'
            ];
            return response()->json($message);
        }catch (\Exception $exception){
            $message = [
                'success' => false,
                'title' => 'Simpan',
                'message' => 'Maaf! Data Gagal di Simpan',
                'error'=> $exception->getMessage()
                ];
            return response()->json($message);
        }
        // Produk::create($request->all());
        // return redirect()->route('produk.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $Customer
     * @return \Illuminate\Http\Response
     */
    public function show(Produk $produk)
    {
        //
        $kode_produk = $produk->kode_produk;
        $data = Produk::with('kategoriproduk','merek','ukuran','satuan','company')->find($kode_produk);
        $url = '<a href="javascript:;" onclick="edit(\''.$data->kode_produk.'\',\''.$data->edit_url.'\')" class="btn btn-warning">
        <i class="fa fa-edit"></i> Edit</a>';
        $output = array(
            'kode_produk'=> $data->kode_produk,
            'nama_produk'=> $data->nama_produk,
            'kode_kategori'=> $data->kategoriproduk->nama_kategori,
            'kode_merek'=> $data->merek->nama_merek,
            'kode_ukuran'=> $data->ukuran->nama_ukuran,
            'kode_satuan'=> $data->satuan->nama_satuan,
            'kode_company'=> $data->company->nama_company,
            'type'=> $data->type,
            'harga_beli'=> $data->harga_beli,
            'harga_jual'=> $data->harga_jual,
            'hpp'=> $data->hpp,
            'stok'=> $data->stok,
            'aktif'=> $data->aktif,
            'url'=>$url,
        );
        return response()->json($output);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $Customer
     * @return \Illuminate\Http\Response
     */
    // public function edit(Produk $produk)
    // {
    //     //
    //     $list_url= route('produk.index');
    //     $info['title'] = 'Edit Produk';
    //     $Kategori = KategoriProduk::pluck('nama_kategori', 'kode_kategori');
    //     $Merek = Merek::pluck('nama_merek', 'kode_merek');
    //     $Ukuran= Ukuran::pluck('nama_ukuran', 'kode_ukuran');
    //     $Satuan= satuan::pluck('nama_satuan', 'kode_satuan');
    //     // dd($Produk);
    //     return view('admin.produk.edit', compact('produk','list_url','info','Kategori','Merek','Ukuran'
    //     ,'Satuan'));
    // }

    public function edit(Produk $produk)
    {
        $kode_produk = $produk->kode_produk;
        $data = Produk::find($kode_produk);
        $output = array(
            'kode_produk'=> $data->kode_produk,
            'nama_produk'=> $data->nama_produk,
            'kode_kategori'=> $data->kode_kategori,
            'kode_merek'=> $data->kode_merek,
            'kode_ukuran'=> $data->kode_ukuran,
            'kode_satuan'=> $data->kode_satuan,
            // 'kode_company'=> $data->kode_company,
            'type'=> $data->type,
            'harga_beli'=> $data->harga_beli,
            'harga_jual'=> $data->harga_jual,
            'hpp'=> $data->hpp,
            'stok'=> $data->stok,
            'aktif'=> $data->aktif,
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
    // public function update(Request $request, Produk $produk)
    // {
    //     //
    //   $request->validate([
    //     'kode_produk'=> 'required',
    //     'nama_produk'=> 'required',
    //     'kode_kategori'=> 'required',
    //     'kode_merek'=> 'required',
    //     'kode_ukuran'=> 'required',
    //     'kode_satuan'=> 'required',
    //     'kode_company'=> 'required',
    //     'type'=> 'required',
    //     'harga_beli'=> 'required',
    //     'harga_jual'=> 'required',
    //     'hpp'=> 'required',
    //     'stok'=> 'required',
    //     'aktif'=> 'required',
    //   ]);
    
    //  $produk->update($request->all());	

    //   return redirect()->route('produk.index');
    // }

    public function updateAjax(Request $request)
    {
        //
      $request->validate([
        'kode_produk'=> 'required',
        'nama_produk'=> 'required',
        'kode_kategori'=> 'required',
        'kode_merek'=> 'required',
        'kode_ukuran'=> 'required',
        'kode_satuan'=> 'required',
        // 'kode_company'=> 'required',
        'type'=> 'required',
        'harga_beli'=> 'required',
        'harga_jual'=> 'required',
        'hpp'=> 'required',
        'stok'=> 'required',
        'aktif'=> 'required',
      ]);

      Produk::find($request->kode_produk)->update($request->all());
   
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
    public function destroy(Produk $produk)
    {
           try {
            $produk->delete();

            $message = [
                'success' => true,
                'title' => 'Update',
                'message' => 'Selamat! Data ['.$produk->nama_produk.'] berhasil dihapus.'
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
