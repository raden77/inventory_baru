<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Models\Permintaan;
use App\Models\PermintaanDetail;
use App\Models\Pemakaian;
use App\Models\PemakaianDetail;
use App\Models\Produk;
use App\Models\satuan;
use App\Models\Company;
use PDF;
use Excel;
use DB;

class PemakaianController extends Controller
{
    //
    public function index()
    {
        
        $create_url = route('pemakaian.create');
        $Permintaan = Permintaan::where('status','POSTED')->pluck('no_permintaan', 'no_permintaan');
        
        $Company= Company::pluck('nama_company','kode_company');
        return view('admin.pemakaian.index',compact('create_url','Permintaan','Company'));

    }

    public function anyData()
    {
        return Datatables::of(Pemakaian::with('company')->withCount('pemakaiandetail'))
           ->addColumn('action', function ($query){
            return '<a href="javascript:;" onclick="edit(\''.$query->id.'\',\''.$query->edit_url.'\')" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> Edit</a>'
            .'&nbsp'.
            '<a href="javascript:;" onclick="del(\''.$query->id.'\',\''.$query->destroy_url.'\')" id="hapus" class="btn btn-danger btn-sm"> <i class="fa fa-times-circle"></i> Hapus</a>'
            .'&nbsp'.
            '<a href="'.$query->detail_url.'" class="btn btn-primary btn-sm"> <i class="fa fa-plus"></i> Add Detail</a>';
                           })
            ->make(true);

    }

    public function detail(Pemakaian $pemakaian)
    {
        $total_qty = 0;
        $total_harga = 0;
        $grand_total = 0;
     
        $Pemakaiandetail = PemakaianDetail::with('produk','satuan')->where('no_pemakaian', $pemakaian->no_pemakaian)
        ->orderBy('created_at','desc')->get();
        
        foreach ($Pemakaiandetail as $row){
            $total_qty += $row->qty;
            $subtotal = $row->harga * $row->qty;
            $total_harga += $subtotal;
            $grand_total = number_format($total_harga,0,",",".");
        }
        
        $list_url= route('pemakaian.index');
        $Produk = Produk::pluck('nama_produk', 'kode_produk');
        $Satuan = satuan::pluck('nama_satuan', 'kode_satuan');
        // $Pemakaians = DB::table('Pemakaian')->select('no_Pemakaian')->where('no_Pemakaian',$no_Pemakaian);
        // dd($Pemakaians);
        return view('admin.pemakaiandetail.index', compact('pemakaian','Pemakaiandetail','list_url','Produk','Satuan',
        'total_qty','grand_total'));
    }

    public function cetakPDF(){ 

        $total_qty = 0;
        $total_harga = 0;
        $grand_total = 0;

        $pemakaian = Pemakaian::find(request()->id);
        $pemakaiandetail= PemakaianDetail::with('produk','satuan')->where('no_pemakaian',$pemakaian->no_pemakaian)->get();

        foreach ($pemakaiandetail as $row){
            $total_qty += $row->qty;
            $subtotal = $row->harga * $row->qty;
            $total_harga += $subtotal;
            $grand_total = number_format($total_harga,2,",",".");
        }

        $jumlah=count($pemakaiandetail);
        $pdf = PDF::loadView('admin.pdf.pemakaian', compact('pemakaian','pemakaiandetail','jumlah','total_qty','grand_total'));
        $pdf->setPaper('a4', 'landscape');
        return $pdf->stream('Pemakaian-'.$pemakaian->no_pemakaian.'.pdf');
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
        $result = Permintaan::find(request()->id);
        return response()->json($result);
    }

    public function Post()
    {
        //
        $permintaan = Pemakaian::find(request()->id);
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
        $permintaan = Pemakaian::find(request()->id);
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
         $list_url= route('pemakaian.index');
         $info['title'] = 'Create Pemakaian';
         $permintaan = Permintaan::pluck('no_permintaan','no_permintaan');
         $produk = Produk::pluck('nama_produk', 'kode_produk');
         $satuan = satuan::pluck('nama_satuan', 'kode_satuan');
        
        return view('admin.pemakaian.add', compact('list_url','info','permintaan','produk','satuan'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $permintaandetail = PermintaanDetail::where('no_permintaan',$request->no_permintaan)->get();
        $pemakaian = Pemakaian::create($request->all());

        // foreach($permintaandetail as $data){
        //     PemakaianDetail::create([
        //         'no_pemakaian' => $pemakaian->no_pemakaian,
        //         'kode_produk' => $data->kode_produk, 
        //         'kode_satuan'=>$data->kode_satuan,
        //         'qty'=>$data->qty,]);

        //     // DB::table('pemakaian_detail')->insert([
        //     // 'no_pemakaian' => $pemakaian->no_pemakaian,
        //     // 'kode_produk' => $data->kode_produk, 
        //     // 'kode_satuan'=>$data->kode_satuan,
        //     // 'qty'=>$data->qty,]);
        // }
        
       
        return redirect()->route('pemakaian.index');

    }

    public function addstore(Request $request)
    {
        
        try {
            $pemakaian = Pemakaian::create($request->all());
            $output = array(
                'no_pemakaian'=> $pemakaian->no_pemakaian,
            );
            return response()->json($output);
        }catch (\Exception $exception){
            $message = [
                'success' => false,
                'title' => 'Simpan',
                'message' => 'Maaf! Data Gagal di Simpan',
                'error'=> $exception->getMessage()
                ];
            return response()->json($message);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $Customer
     * @return \Illuminate\Http\Response
     */
    // public function show(Pemakaian $pemakaian)
    // {
    //     //
    // }

    public function Showdetail()
    {

        $total_qty = 0;
        $total_harga = 0;
        $grand_total = 0;
        // $pemakaiandetail = Pemekaiandetail::find();
        $pemakaiandetail= PemakaianDetail::with('produk','satuan')->where('no_pemakaian',request()->id)
        ->orderBy('created_at', 'desc')->get();
        // dd($pemakaiandetail);
        // foreach ($pemakaiandetail as $row){
        //     $total_qty += $row->qty;
        //     $subtotal = $row->harga * $row->qty;
        //     $total_harga += $subtotal;
        //     $grand_total = number_format($total_harga,2,",",".");
        // }

            // $results = array();
            // foreach($result as $row)
            // {
            //     $user_id = $row[''];
            //     $username = $row['username'];
            //     $comment = $row['comment'];
            //     $dateAdded = $row['date_added'];

            //     $results[] = array("user_id" => $user_id, "username" => $username, "comment" => $comment, "date_added" => $dateAdded);
            // }

            // $i = 0;
            // foreach($pemakaiandetail as $row)
            // {
            //     $arr[$i] = $row->produk;
            //     $i++;
            // }

        $output = array();

        foreach ($pemakaiandetail as $row){
            $total_qty += $row->qty;
            $subtotal = $row->harga * $row->qty;
            $total_harga += $subtotal;
            $grand_total = number_format($total_harga,0,",",".");
        }

        if($pemakaiandetail){

            foreach($pemakaiandetail as $row)
            {

                $no_pemakaian = $row->no_pemakaian;
                $produk = $row->produk->nama_produk;
                $satuan = $row->satuan->nama_satuan;
                $qty = $row->qty;
                $harga = $row->harga;
                // $harga = number_format($row->harga,2,",",".");
                $subtotal =  number_format($row->harga * $row->qty,0,",",".");
                $output[] = array(

                    'no_pemakaian'=>$no_pemakaian,
                    'produk'=>$produk,
                    'satuan'=>$satuan,
                    'qty'=>$qty,
                    'harga'=>$harga,
                    'subtotal'=>$subtotal,
                );
            }

            
        }else{
            $output = array(
                'success' => false,
                'title' => 'Gagal',
                'message' => 'Maaf Data Terkait Tidak Ada'
            );
        }
        
        return response()->json($output);
        // return response()->json(array(['output'=>$output,'total_qty'=>$total_qty,'grand_total'=>$grand_total]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $Customer
     * @return \Illuminate\Http\Response
     */
    // public function edit(Pemakaian $pemakaian)
    // {
    //     //
    //     $list_url= route('pemakaian.index');
    //     $info['title'] = 'Edit Pemakaian';
        
    //     // dd($Pemakaian);
    //     return view('admin.pemakaian.edit', compact('pemakaian','list_url','info'));
    // }

    public function edit(Pemakaian $pemakaian)
    {
        $no_pemakaian = $pemakaian->no_pemakaian;
        $data = Pemakaian::find($no_pemakaian);
        $output = array(
            'no_pemakaian'=> $data->no_pemakaian,
            // 'no_permintaan'=> $data->no_permintaan,
            'tanggal_pemakaian'=> $data->tanggal_pemakaian,
            'status'=> $data->status,
            'type'=> $data->type,
            'deskripsi'=> $data->deskripsi,
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
    // public function update(Request $request, Pemakaian $pemakaian)
    // {
    //     //
    //   $request->validate([
    //     'no_pemakaian'=> 'required',
    //     'no_permintaan'=> 'required',
    //     'tanggal_pemakaian'=> 'required',
    //     'status'=> 'required',
    //   ]);
    
    //  $Pemakaian->update($request->all());	

    //   return redirect()->route('pemakaian.index');
    // }

    public function updateAjax(Request $request)
    {
        //
      $request->validate([
        'no_pemakaian'=> 'required',
        'no_permintaan'=> 'required',
        'tanggal_pemakaian'=> 'required',
        'status'=> 'required',
      ]);

      $Pemakaian = Pemakaian::find($request->no_pemakaian)->update($request->all());
   
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
    public function destroy(Pemakaian $pemakaian)
    {
           try {
            $pemakaian->delete();

            $message = [
                'success' => true,
                'title' => 'Update',
                'message' => 'Selamat! Data ['.$pemakaian->no_pemakaian.'] berhasil dihapus.'
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
