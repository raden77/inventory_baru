<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Yajra\Auditable\AuditableTrait;
use App\Models\Produk;
use App\Models\satuan;
use App\Models\Pembelian;

class PembelianDetail extends Model
{
    //
    use AuditableTrait;

    protected $table = 'pembelian_detail';

	// protected $primaryKey = 'no_permintaan';

	public $incrementing = true;

	protected $fillable = [
    	'no_pembelian',
        'kode_produk',
        'kode_satuan',
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

    public function pembelian()
    {
        return $this->belongsTo(Pembelian::class,'no_pembelian');
    }  

     public function getDestroyUrlAttribute()
    {
        return route('pembeliandetail.destroy', $this->id);
    }

    public function getEditUrlAttribute()
    {
        return route('pembeliandetail.edit',$this->id);
    }

    public function getUpdateUrlAttribute()
    {
        return route('pembeliandetail.update',$this->id);
    }
}
