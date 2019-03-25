<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Yajra\Auditable\AuditableTrait;
use App\Models\Produk;
use App\Models\PermintaanDetail;

class satuan extends Model
{
    use AuditableTrait;
    
    protected $table = 'satuan';

	protected $primaryKey = 'kode_satuan';

	public $incrementing = false;

	protected $fillable = [
    	'kode_satuan',
    	'nama_satuan',
        'status',
        'created_at',
        'updated_at',
        'create_by',
        'updated_by',
    ];

    public function Produk()
    {
    return $this->hasMany(Produk::class,'kode_satuan');
    }

    public function PermintaanDetail()
    {
    return $this->hasMany(PermintaanDetail::class,'kode_satuan');
    }

    public function PemakaianDetail()
    {
    return $this->hasMany(PemakaianDetail::class,'kode_satuan');
    }

     public function getDestroyUrlAttribute()
    {
        return route('satuan.destroy', $this->kode_satuan);
    }

    public function getEditUrlAttribute()
    {
        return route('satuan.edit',$this->kode_satuan);
    }

    public function getUpdateUrlAttribute()
    {
        return route('satuan.update',$this->kode_satuan);
    }











}
