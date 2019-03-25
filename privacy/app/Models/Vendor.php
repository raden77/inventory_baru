<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Yajra\Auditable\AuditableTrait;
use APP\Models\Pembelian;

class Vendor extends Model
{
    //
    use AuditableTrait;

    protected $table = 'vendor';

	protected $primaryKey = 'kode_vendor';

	public $incrementing = false;

	protected $fillable = [
    	'kode_vendor',
        'nama_vendor',
        'alamat',
        'telp',
        'hp',
        'npwp',
        'termin_pembayaran',
        'status',
    ];

    public function Pembelian()
    {
    return $this->hasMany(Pembelian::class,'kode_vendor');
    }

     public function getDestroyUrlAttribute()
    {
        return route('vendor.destroy', $this->kode_vendor);
    }

    public function getEditUrlAttribute()
    {
        return route('vendor.edit',$this->kode_vendor);
    }

    public function getUpdateUrlAttribute()
    {
        return route('vendor.update',$this->kode_vendor);
    }
}
