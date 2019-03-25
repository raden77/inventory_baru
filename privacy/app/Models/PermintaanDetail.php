<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Yajra\Auditable\AuditableTrait;
use App\Models\Produk;
use App\Models\satuan;

class PermintaanDetail extends Model
{
    //
    use AuditableTrait;

    protected $table = 'permintaan_detail';

	// protected $primaryKey = 'no_permintaan';

	public $incrementing = false;

	protected $fillable = [
    	'no_permintaan',
        'kode_produk',
        'kode_satuan',
        'qty',
        'status',
    ];

    protected $appends = ['destroy_url','edit_url','update_url'];

    public function Produk()
    {
        return $this->belongsTo(Produk::class,'kode_produk');
    }

    public function satuan()
    {
        return $this->belongsTo(satuan::class,'kode_satuan');
    }

     public function getDestroyUrlAttribute()
    {
        return route('permintaandetail.destroy', $this->id);
    }

    public function getEditUrlAttribute()
    {
        return route('permintaandetail.edit',$this->id);
    }

    public function getUpdateUrlAttribute()
    {
        return route('permintaandetail.update',$this->no_permintaan);
    }

    
}
