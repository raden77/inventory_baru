<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Models\Pembelian;
use App\Models\PembelianDetail;
use App\Models\Memo;
use App\Models\MemoDetail;
use App\Models\Vendor;
use App\Models\Produk;
use App\Models\satuan;
use App\Models\Company;
use PDF;
use Excel;
use DB;


class PembelianController extends Controller
{
    //
    public function index()
    {
        
        $create_url = route('pembelian.create');
        $Vendor= Vendor::pluck('nama_vendor','kode_vendor');
        
        $Memo = Memo::where('status','POSTED')->pluck('no_memo','no_memo');
        $Company= Company::pluck('nama_company','kode_company');
        return view('admin.pembelian.index',compact('create_url','Vendor','Memo','Company'));

    }

    public function anyData()
    {
        return Datatables::of(Pembelian::with('vendor','memo','company')->withCount('pembeliandetail'))
           ->addColumn('action', function ($query){
            return '<a href="javascript:;" onclick="edit(\''.$query->id.'\',\''.$query->edit_url.'\')" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> Edit</a>'
            .'&nbsp'.
            '<a href="javascript:;" onclick="del(\''.$query->id.'\',\''.$query->destroy_url.'\')" id="hapus" class="btn btn-danger btn-sm"> <i class="fa fa-times-circle"></i> Hapus</a>'
            .'&nbsp'.
            '<a href="'.$query->detail_url.'" class="btn btn-primary btn-sm"> <i class="fa fa-plus"></i> Add Detail</a>'
            .'&nbsp'
            ;
                           })
            ->make(true);

    }

    public function detail(Pembelian $pembelian)
    {
        $total_qty = 0;
        $total_harga = 0;
        $grand_total = 0;

        $pembeliandetail = PembelianDetail::with('produk','satuan')->where('no_pembelian', $pembelian->no_pembelian)
        ->orderBy('created_at','desc')->get();

        foreach ($pembeliandetail as $row){
            $total_qty += $row->qty;
            $subtotal = $row->harga * $row->qty;
            $total_harga += $subtotal;
            $grand_total = number_format($total_harga,2,",",".");
        }

        $list_url= route('pembelian.index');
        $Produk = Produk::pluck('nama_produk','kode_produk');
        $Satuan = satuan::pluck('nama_satuan','kode_satuan');
        // $pembelians = DB::table('pembelian')->select('no_pembelian')->where('no_pembelian',$no_pembelian);
        // dd($pembelians);
        return view('admin.pembeliandetail.index', compact('pembelian','pembeliandetail','list_url','Produk','Satuan',
        'total_qty','grand_total'));
    }

    public function cetakPDF(){ 

        $total_qty = 0;
        $total_harga = 0;
        $grand_total = 0;

        $pembelian = Pembelian::find(request()->id);
        $pembeliandetail= PembelianDetail::with('produk','satuan')->where('no_pembelian',$pembelian->no_pembelian)->get();
    
        foreach ($pembeliandetail as $row){
            $total_qty += $row->qty;
            $subtotal = $row->harga * $row->qty;
            $total_harga += $subtotal;
            $grand_total = number_format($total_harga,2,",",".");
        }

        $jumlah=count($pembeliandetail);
        $pdf = PDF::loadView('admin.pdf.pembelian', compact('pembelian','pembeliandetail','jumlah','total_qty','grand_total'));
        $pdf->setPaper('a4', 'landscape');
        return $pdf->stream('Pembelian-'.$pembelian->no_pembelian.'.pdf');
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
        $result = Memo::find(request()->id);
        return response()->json($result);
    }

    public function Post()
    {
        //
        $permintaan = Pembelian::find(request()->id);
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
        $permintaan = Pembelian::find(request()->id);
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
         $list_url= route('pembelian.index');
         $info['title'] = 'Create pembelian';
         $Memo= Memo::pluck('no_memo','no_memo');
         $Vendor= Vendor::pluck('nama_vendor','kode_vendor');
        
        return view('admin.pembelian.create', compact('Memo','Vendor','list_url','info'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $memodetail = MemoDetail::where('no_memo',$request->no_memo)->get();

        $pembelian = Pembelian::create($request->all());
        // foreach($memodetail as $data){
        //     PembelianDetail::create([
        //         'no_pembelian' => $pembelian->no_pembelian,
        //         'kode_produk' => $data->kode_produk, 
        //         'kode_satuan'=>$data->kode_satuan,
        //         'qty'=>$data->qty,]);

        //     // DB::table('pemakaian_detail')->insert([
        //     // 'no_pemakaian' => $pemakaian->no_pemakaian,
        //     // 'kode_produk' => $data->kode_produk, 
        //     // 'kode_satuan'=>$data->kode_satuan,
        //     // 'qty'=>$data->qty,]);
        // }
        
        return redirect()->route('pembelian.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $Customer
     * @return \Illuminate\Http\Response
     */
    public function show(Pembelian $pembelian)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $Customer
     * @return \Illuminate\Http\Response
     */
    // public function edit(Pembelian $pembelian)
    // {
    //     //
    //     $list_url= route('pembelian.index');
    //     $info['title'] = 'Edit pembelian';
    //     $Memo= Memo::pluck('no_memo','no_memo');
    //     $Vendor= Vendor::pluck('nama_vendor','kode_vendor');
    //     // dd($pembelian);
    //     return view('admin.pembelian.edit', compact('Memo','Vendor','pembelian','list_url','info'));
    // }

    public function edit(Pembelian $pembelian)
    {
        $no_pembelian = $pembelian->no_pembelian;
        $data = Pembelian::find($no_pembelian);
        $output = array(
            'no_pembelian'=> $data->no_pembelian,
            // 'no_memo'=> $data->no_memo,
            'kode_vendor'=>$data->kode_vendor,
            'tanggal_pembelian'=> $data->tanggal_pembelian,
            'status'=> $data->status,
            'jenis_po'=> $data->jenis_po,
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
    // public function update(Request $request, Pembelian $pembelian)
    // {
    //     //
    //   $request->validate([
    //     'no_pembelian'=> 'required',
    //     'no_memo'=> 'required',
    //     'kode_vendor'=> 'required',
    //     'tanggal_pembelian'=> 'required',
    //     'status'=> 'required',
    //   ]);
    
    //  $pembelian->update($request->all());	

    //   return redirect()->route('pembelian.index');
    // }

    public function updateAjax(Request $request)
    {
        //
      $request->validate([
        'no_pembelian'=> 'required',
        'no_memo'=> 'required',
        'kode_vendor'=> 'required',
        'tanggal_pembelian'=> 'required',
        'status'=> 'required',
      ]);

      $Pembelian = Pembelian::find($request->no_pembelian)->update($request->all());
   
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
    public function destroy(Pembelian $pembelian)
    {
           try {
            $pembelian->delete();

            $message = [
                'success' => true,
                'title' => 'Update',
                'message' => 'Selamat! Data ['.$pembelian->no_pembelian.'] berhasil dihapus.'
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
