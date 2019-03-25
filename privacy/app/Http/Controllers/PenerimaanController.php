<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Models\Penerimaan;
use App\Models\PenerimaanDetail;
use App\Models\Pembelian;
use App\Models\Permintaan;
use App\Models\Produk;
use App\Models\satuan;
use App\Models\Company;
use PDF;
use Excel;
use DB;

class PenerimaanController extends Controller
{
    //
    public function index()
    {
        
        $create_url = route('penerimaan.create');
        $Pembelian = Pembelian::where('status','POSTED')->pluck('no_pembelian','no_pembelian');
        $Company= Company::pluck('nama_company','kode_company');
        return view('admin.penerimaan.index',compact('create_url','Pembelian','Company'));

    }

    public function anyData()
    {
        return Datatables::of(Penerimaan::with('company')->withCount('penerimaandetail'))
           ->addColumn('action', function ($query){
            return '<a href="javascript:;" onclick="edit(\''.$query->id.'\',\''.$query->edit_url.'\')" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> Edit</a>'
            .'&nbsp'.
            '<a href="javascript:;" onclick="del(\''.$query->id.'\',\''.$query->destroy_url.'\')" id="hapus" class="btn btn-danger btn-sm"> <i class="fa fa-times-circle"></i> Hapus</a>'
            .'&nbsp'.
            '<a href="'.$query->detail_url.'" class="btn btn-primary btn-sm"> <i class="fa fa-plus"></i> Add Detail</a>';
                           })
            ->make(true);

    }

    public function detail(Penerimaan $penerimaan)
    {
        $total_qty = 0;
        $total_harga = 0;
        $grand_total = 0;

        $penerimaandetail = PenerimaanDetail::with('produk')->where('no_penerimaan', $penerimaan->no_penerimaan)
        ->orderBy('created_at','desc')->get();

        foreach ($penerimaandetail as $row){
            $total_qty += $row->qty;
            $subtotal = $row->harga * $row->qty;
            $total_harga += $subtotal;
            $grand_total = number_format($total_harga,2,",",".");
        }

        $list_url= route('penerimaan.index');
        $Produk = Produk::pluck('nama_produk', 'kode_produk');
        // $penerimaans = DB::table('penerimaan')->select('no_penerimaan')->where('no_penerimaan',$no_penerimaan);
        // dd($penerimaans);
        return view('admin.penerimaandetail.index', compact('penerimaan','penerimaandetail','list_url','Produk',
        'total_qty','grand_total'));
    }

    public function cetakPDF(){ 

        $total_qty = 0;
        $total_harga = 0;
        $grand_total = 0;

        $penerimaan = Penerimaan::find(request()->id);
        $penerimaandetail= PenerimaanDetail::with('produk','satuan')->where('no_penerimaan',$penerimaan->no_penerimaan)->get();
        
        foreach ($penerimaandetail as $row){
            $total_qty += $row->qty;
            $subtotal = $row->harga * $row->qty;
            $total_harga += $subtotal;
            $grand_total = number_format($total_harga,2,",",".");
        }

        $jumlah=count($penerimaandetail);
        $pdf = PDF::loadView('admin.pdf.penerimaan', compact('penerimaan','penerimaandetail','jumlah','total_qty','grand_total'));
        $pdf->setPaper('a4', 'landscape');
        return $pdf->stream('Penerimaan-'.$penerimaan->no_penerimaan.'.pdf');
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

    public function loadData(Request $request)
    {
        // dd('dd');
        // $result = Permintaan::find(request()->id)->pluck('no_permintaan','no_permintaan');
        $result = Pembelian::find(request()->id);
        return response()->json($result);
    }

    public function Post()
    {
        //
        $permintaan = Penerimaan::find(request()->id);
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
        $permintaan = Penerimaan::find(request()->id);
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
         $list_url= route('penerimaan.index');
         $info['title'] = 'Create penerimaan';
         
        
        return view('admin.penerimaan.create', compact('list_url','info'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
        Penerimaan::create($request->all());
        return redirect()->route('penerimaan.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $Customer
     * @return \Illuminate\Http\Response
     */
    public function show(Penerimaan $penerimaan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $Customer
     * @return \Illuminate\Http\Response
     */
    // public function edit(Penerimaan $penerimaan)
    // {
    //     //
    //     $list_url= route('penerimaan.index');
    //     $info['title'] = 'Edit penerimaan';
        
    //     // dd($penerimaan);
    //     return view('admin.penerimaan.edit', compact('penerimaan','list_url','info'));
    // }

    public function edit(Penerimaan $penerimaan)
    {
        $no_penerimaan = $penerimaan->no_penerimaan;
        $data = Penerimaan::find($no_penerimaan);
        $output = array(
            'no_penerimaan'=> $data->no_penerimaan,
            'no_pembelian'=> $data->no_pembelian,
            'tanggal_penerimaan'=> $data->tanggal_penerimaan,
            'status'=> $data->status,
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
    public function update(Request $request, Penerimaan $penerimaan)
    {
        //
      $request->validate([
        'no_penerimaan'=> 'required',
        'no_pembelian'=> 'required',
        'tanggal_penerimaan'=> 'required',
        'status'=> 'required',
      ]);
    
     $penerimaan->update($request->all());	

      return redirect()->route('penerimaan.index');
    }

    public function updateAjax(Request $request)
    {
        //
      $request->validate([
        'no_penerimaan'=> 'required',
        'no_pembelian'=> 'required',
        'tanggal_penerimaan'=> 'required',
        'status'=> 'required',
      ]);

      $Penerimaan = Penerimaan::find($request->no_penerimaan)->update($request->all());
   
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
    public function destroy(Penerimaan $penerimaan)
    {
           try {
            $penerimaan->delete();

            $message = [
                'success' => true,
                'title' => 'Update',
                'message' => 'Selamat! Data ['.$penerimaan->no_penerimaan.'] berhasil dihapus.'
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
