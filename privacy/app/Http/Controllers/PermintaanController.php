<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Models\Permintaan;
use App\Models\PermintaanDetail;
use App\Models\Produk;
use App\Models\satuan;
use App\Models\Company;
use Carbon\Carbon;
use PDF;
use Excel;
use DB;

class PermintaanController extends Controller
{
    //
    public function index()
    {
        // dd(Auth::id());
        
        $create_url = route('permintaan.create');
        $Company= Company::pluck('nama_company','kode_company');
        return view('admin.permintaan.index',compact('create_url','Company'));

    }

    public function anyData()
    {
        return Datatables::of(Permintaan::with('company'))
           ->addColumn('action', function ($query){
            return '<a href="javascript:;" onclick="edit(\''.$query->id.'\',\''.$query->edit_url.'\')" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> Edit</a>'
            .'&nbsp'.
            '<a href="javascript:;" onclick="del(\''.$query->id.'\',\''.$query->destroy_url.'\')" id="hapus" class="btn btn-danger btn-sm"> <i class="fa fa-times-circle"></i> Hapus</a>'
            .'&nbsp'.
            '<a href="'.$query->detail_url.'" class="btn btn-primary btn-sm"> <i class="fa fa-eye"></i> Detail</a>';
                           })
            ->make(true);
    }


    public function detail(Permintaan $permintaan)
    {

        $permintaandetail = PermintaanDetail::with('produk','satuan')->where('no_permintaan', $permintaan->no_permintaan)
        ->orderBy('created_at','desc')->paginate(10);
        //dd($permintaandetail->toArray());
        $list_url= route('permintaan.index');
        $Produk = Produk::pluck('nama_produk', 'kode_produk');
        $Satuan = satuan::pluck('nama_satuan', 'kode_satuan');
        // $permintaans = DB::table('permintaan')->select('no_permintaan')->where('no_permintaan',$no_permintaan);
        // dd($permintaans);
        return view('admin.permintaandetail.index', compact('permintaan','permintaandetail','list_url','Produk','Satuan'));
    }

    public function makePDF(Permintaan $permintaan){ 

        $berat1= $transaksi->berat1;
        $berat2= $transaksi->berat2;
  
        $total= $berat1 - $berat2; 
  
        $pdf = PDF::loadView('admin.pdf.pdf', compact('transaksi','total'));
        //$pdf->setPaper('a4', 'landscape');
        $pdf->setPaper([0, 0,  283.465,396.85 ], 'portrait');
        return $pdf->stream('transaksi('.$transaksi->no_transaksi.')-'.date('d:m:Y').'.pdf');
  
    }
  
    public function cetakPDF(){ 

        $permintaan = Permintaan::find(request()->id);
        $permintaandetail= PermintaanDetail::with('produk','satuan')->where('no_permintaan',$permintaan->no_permintaan)->get();
    
        $jumlah=count($permintaandetail);
        $pdf = PDF::loadView('admin.pdf.permintaan', compact('permintaan','permintaandetail','jumlah'));
        $pdf->setPaper('a4', 'landscape');
        return $pdf->stream('Permintaan-'.$permintaan->no_permintaan.'.pdf');
        // $pdf_file = 'Permintaan-'.$permintaan->no_permintaan.'.pdf';
        // $pdf_path = 'file_pdf/'.$pdf_file;
        // $pdf->save($pdf_path);
        // // return asset($pdf_path);
        // $url  = '<a href="file_pdf/.$pdf_file" download class="btn btn-warning">Klik Here</a>';
        // $output = array(
        // 'url'=>$url,
        // 'success' => true,
        // 'title' => 'PDF',
        // 'message' => 'Berhasil Generate PDF',);
       
        // return response()->json($output);
    }
      
      public function laporanExcel()
      {
          return Excel::download(new TransaksiReport, 'DataTransaksis-'.date('d:m:Y').'.xlsx');
      }

    public function Post()
    {
        //
        $permintaan = Permintaan::find(request()->id);
        // dd($permintaan);
    
        $permintaan->status = "POSTED";
        $permintaan->save();
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
        $permintaan = Permintaan::find(request()->id);
        // dd($permintaan);
    
        $permintaan->status = "UNPOSTED";
        $permintaan->save();	
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
         $list_url= route('permintaan.index');
         $info['title'] = 'Create Permintaan';
         $Company= Company::pluck('nama_company','kode_company');
        
        return view('admin.permintaan.create', compact('Company','list_url','info'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd(Auth()->user()->kode_company);
        Permintaan::create($request->all());

        return redirect()->route('permintaan.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $Customer
     * @return \Illuminate\Http\Response
     */
    public function show(Permintaan $permintaan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $Customer
     * @return \Illuminate\Http\Response
     */
    // public function edit(Permintaan $permintaan)
    // {
    //     //
    //     $list_url= route('permintaan.index');
    //     $info['title'] = 'Edit Permintaan';
    //     $Company= Company::pluck('nama_company','kode_company');
    //     // dd($Permintaan);
    //     return view('admin.permintaan.edit', compact('Company','permintaan','list_url','info'));
    // }

    public function edit(Permintaan $permintaan)
    {
        $no_permintaan = $permintaan->no_permintaan;
        $data = Permintaan::find($no_permintaan);
        $output = array(
            'no_permintaan'=> $data->no_permintaan,
            'deskripsi'=> $data->deskripsi,
            'tanggal_permintaan'=> $data->tanggal_permintaan,
            'type'=> $data->type,
            // 'status'=> $data->status,
            'kode_company'=>$data->kode_company,
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
    // public function update(Request $request, Permintaan $permintaan)
    // {
    //     //
    //   $request->validate([
    //     'no_permintaan'=> 'required',
    //     'deskripsi'=> 'required',
    //     'tanggal_permintaan'=> 'required',
    //     'type'=> 'required',
    //     'status'=> 'required',
    //     'kode_company'=>'required',
    //   ]);
    
    //  $permintaan->update($request->all());	

    //   return redirect()->route('permintaan.index');
    // }

    public function updateAjax(Request $request)
    {
        //
      $request->validate([
        'no_permintaan'=> 'required',
        'deskripsi'=> 'required',
        'tanggal_permintaan'=> 'required',
        'type'=> 'required',
      ]);

      $Permintaan = Permintaan::find($request->no_permintaan)->update($request->all());
   
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
    public function destroy(Permintaan $permintaan)
    {
           try {
            $permintaan->delete();

            $message = [
                'success' => true,
                'title' => 'Update',
                'message' => 'Selamat! Data ['.$permintaan->no_permintaan.'] berhasil dihapus.'
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
