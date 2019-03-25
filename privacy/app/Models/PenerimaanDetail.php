<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Yajra\Auditable\AuditableTrait;
use App\Models\Produk;
use App\Models\satuan;
use App\Models\Itembulanan;
use App\Mdoels\Penerimaan;

class PenerimaanDetail extends Model
{
    //
    use AuditableTrait;

    protected $table = 'penerimaan_detail';

	// protected $primaryKey = 'no_permintaan';

	public $incrementing = false;

	protected $fillable = [
    	'no_penerimaan',
        'kode_produk',
        'qty',
        'harga',
    ];

    protected $appends = ['destroy_url','edit_url'];

    public function Produk()
    {
        return $this->belongsTo(Produk::class,'kode_produk');
    }

    public function satuan()
    {
        return $this->belongsTo(satuan::class,'kode_satuan');
    }

    public function penerimaan()
    {
        return $this->belongsTo(Penerimaan::class,'no_penerimaan');
    }

    public function getDestroyUrlAttribute()
    {
        return route('penerimaandetail.destroy', $this->id);
    }

    public function getEditUrlAttribute()
    {
        return route('penerimaandetail.edit',$this->id);
    }

    public function getUpdateUrlAttribute()
    {
        return route('penerimaandetail.update',$this->id);
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($query){
            // $query->status = 'OPEN';
            // $query->kode_company = Auth()->user()->kode_company;
            // $query->no_penerimaan = static::generateKode(request());

            $produk = Produk::find($query->kode_produk);
            $qty_tersedia = $produk->stok;
            $qty_penerimaan = $query->qty;

            $instock = $qty_tersedia + $qty_penerimaan;

            $itembulanan = new Itembulanan;
            $itembulanan->kode_company = $produk->kode_company;
            $itembulanan->periode = \Carbon\Carbon::now();
            $itembulanan->kode_produk = $produk->kode_produk;
            $itembulanan->satuan = $produk->kode_satuan;
            $itembulanan->begin_stock = $produk->stok;
            $itembulanan->begin_amount = $produk->harga_beli;
            $itembulanan->increment('in_stock',$qty_penerimaan);
            $itembulanan->increment('in_amount',$qty_penerimaan);
            // $itembulanan->in_amount = 0;
            $itembulanan->out_stock = 0;
            $itembulanan->out_amount = 0;
            $itembulanan->adjustment_stock = 0;
            $itembulanan->adjustment_amount = 0;
            $itembulanan->stock_opname = 0;
            $itembulanan->amount_opname = 0;
            $itembulanan->increment('ending_stock',$qty_penerimaan);
            $itembulanan->ending_amount = 0;
            $itembulanan->save();
            
        });
    }
}
