<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Yajra\Auditable\AuditableTrait;
use App\Models\Penerimaan;
use App\Models\Penerimaandetail;
use App\Models\Pemakaian;
use App\Models\Pemakaiandetail;


class Itembulanan extends Model
{
    //

    use AuditableTrait;

    protected $table = 'tb_item_bulanan';

	protected $primaryKey = 'kode_produk';

	public $incrementing = false;

	protected $fillable = [
    	'kode_company',
        'periode',
        'kode_produk',
        'satuan',
        'begin_stock',
        'begin_amount',
        'in_stock',
        'in_amount',
        'out_stock',
        'out_amount',
        'adjustment_stock',
        'adjustment_amount',
        'stock_opname',
        'amount_opname',
        'ending_stock',
        'ending_amount',
    ];

    public function Company()
    {
    return $this->belongsTo(Produk::class,'kode_company');
    }

    public function Produk()
    {
    return $this->belongsTo(Produk::class,'kode_produk');
    }

     public function getDestroyUrlAttribute()
    {
        return route('kategoriproduk.destroy', $this->kode_kategori);
    }

    public function getEditUrlAttribute()
    {
        return route('kategoriproduk.edit',$this->kode_kategori);
    }

    public function getUpdateUrlAttribute()
    {
        return route('kategoriproduk.update',$this->kode_kategori);
    }
}
