<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Models\Permintaan;
use App\Models\PermintaanDetail;
use App\Models\Memo;
use App\Models\MemoDetail;
use App\Models\Produk;
use App\Models\satuan;
use App\Models\Company;
use PDF;
use Excel;
use DB;


class MemoController extends Controller
{
    //
    public function index()
    {
        
        $create_url = route('memo.create');
        $Permintaan = Permintaan::where('status','POSTED')->pluck('no_permintaan','no_permintaan');
        // dd($Permintaan);
        $Company= Company::pluck('nama_company','kode_company');
        return view('admin.memo.index',compact('create_url','Permintaan','Company'));

    }

    public function anyData()
    {
        return Datatables::of(Memo::with('company'))
           ->addColumn('action', function ($query){
            return '<a href="javascript:;" onclick="edit(\''.$query->id.'\',\''.$query->edit_url.'\')" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> Edit</a>'
            .'&nbsp'.
            '<a href="javascript:;" onclick="del(\''.$query->id.'\',\''.$query->destroy_url.'\')" id="hapus" class="btn btn-danger btn-sm"> <i class="fa fa-times-circle"></i> Hapus</a>'
            .'&nbsp'.
            '<a href="'.$query->detail_url.'" class="btn btn-primary btn-sm"> <i class="fa fa-eye"></i> Detail</a>';
                           })
            ->make(true);

    }


    public function detail(Memo $memo)
    {
        //ok
        $memodetail = MemoDetail::with('produk','satuan')->where('no_memo', $memo->no_memo)
        ->orderBy('created_at','desc')->paginate(5);
        //dd($memodetail->toArray());
        $list_url= route('memo.index');
        $Produk = Produk::pluck('nama_produk','kode_produk');
        $Satuan = satuan::pluck('nama_satuan','kode_satuan');
        // $memos = DB::table('memo')->select('no_memo')->where('no_memo',$no_memo);
        // dd($memos);
        return view('admin.memodetail.index', compact('memo','memodetail','list_url','Produk','Satuan'));
    }

    public function cetakPDF(){ 

        $memo = Memo::find(request()->id);
        $memodetail= MemoDetail::with('produk','satuan')->where('no_memo',$memo->no_memo)->get();
    
        $jumlah=count($memodetail);
        $pdf = PDF::loadView('admin.pdf.memo', compact('memo','memodetail','jumlah'));
        $pdf->setPaper('a4', 'landscape');
        return $pdf->stream('Penerimaan-'.$memo->no_memo.'.pdf');
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
        $permintaan = Memo::find(request()->id);
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
        $permintaan = Memo::find(request()->id);
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
         $list_url= route('memo.index');
         $info['title'] = 'Create memo';
         $Permintaan= Permintaan::pluck('no_permintaan','no_permintaan');
        
        return view('admin.memo.create', compact('Permintaan','list_url','info'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $permintaandetail = PermintaanDetail::where('no_permintaan',$request->no_permintaan)->get();
        $memo = Memo::create($request->all());

        foreach($permintaandetail as $data){
            MemoDetail::create([
                'no_memo' => $memo->no_memo,
                'kode_produk' => $data->kode_produk, 
                'kode_satuan'=>$data->kode_satuan,
                'qty'=>$data->qty,]);
        }
        
        return redirect()->route('memo.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $Customer
     * @return \Illuminate\Http\Response
     */
    public function show(memo $memo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $Customer
     * @return \Illuminate\Http\Response
     */
    // public function edit(Memo $memo)
    // {
    //     //
    //     $list_url= route('memo.index');
    //     $info['title'] = 'Edit memo';
    //     $Permintaan= Permintaan::pluck('no_permintaan','no_permintaan');
    //     // dd($memo);
    //     return view('admin.memo.edit', compact('Permintaan','memo','list_url','info'));
    // }

    public function edit(Memo $memo)
    {
        $no_memo = $memo->no_memo;
        $data = Memo::find($no_memo);
        $output = array(
            'no_memo'=> $data->no_memo,
            'no_permintaan'=> $data->no_permintaan,
            'tanggal_memo'=> $data->tanggal_memo,
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
    // public function update(Request $request, Memo $memo)
    // {
    //     //
    //   $request->validate([
    //     'no_memo'=> 'required',
    //     'no_permintaan'=> 'required',
    //     'tanggal_memo'=> 'required',
    //     'status'=> 'required',
    //   ]);
    
    //  $memo->update($request->all());	

    //   return redirect()->route('memo.index');
    // }

    public function updateAjax(Request $request)
    {
        //
      $request->validate([
        'no_memo'=> 'required',
        'no_permintaan'=> 'required',
        'tanggal_memo'=> 'required',
        'status'=> 'required',
      ]);

      $Memo = Memo::find($request->no_memo)->update($request->all());
   
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
    public function destroy(Memo $memo)
    {
           try {
            $memo->delete();

            $message = [
                'success' => true,
                'title' => 'Update',
                'message' => 'Selamat! Data ['.$memo->no_memo.'] berhasil dihapus.'
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
