<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Yajra\Auditable\AuditableTrait;
use APP\Models\Produk;


class MasterLokasi extends Model
{
    //
    use AuditableTrait;

    protected $table = 'master_lokasi';

    protected $primaryKey = 'id_lokasi';
    
    public $incrementing = false;

	protected $fillable = [
    	'id_lokasi',
        'nama_lokasi',
        'nickname',
        'alamat',
        'status',
    ];

   
    // public function Permintaan()
    // {
    //     return $this->belongsTo(Permintaan::class,'no_permintaan');
    // }

    public function Produk()
    {
    return $this->hasMany(Produk::class,'id_lokasi');
    }

    public function getDestroyUrlAttribute()
    {
        return route('masterlokasi.destroy', $this->id_lokasi);
    }

    public function getEditUrlAttribute()
    {
        return route('masterlokasi.edit',$this->id_lokasi);
    }

    public function getUpdateUrlAttribute()
    {
        return route('masterlokasi.update',$this->id_lokasi);
    }

    public function getDetailUrlAttribute()
    {
        return route('masterlokasi.detail',$this->id_lokasi);
    }
}
