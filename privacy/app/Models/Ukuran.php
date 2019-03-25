<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Yajra\Auditable\AuditableTrait;
use App\Models\Produk;

class Ukuran extends Model
{
    //
    use AuditableTrait;

    protected $table = 'ukuran';

	protected $primaryKey = 'kode_ukuran';

	public $incrementing = false;

	protected $fillable = [
    	'kode_ukuran',
    	'nama_ukuran',
    ];

    public function Produk()
    {
    return $this->hasMany(Produk::class,'kode_ukuran');
    }

     public function getDestroyUrlAttribute()
    {
        return route('ukuran.destroy', $this->kode_ukuran);
    }

    public function getEditUrlAttribute()
    {
        return route('ukuran.edit',$this->kode_ukuran);
    }

    public function getUpdateUrlAttribute()
    {
        return route('ukuran.update',$this->kode_ukuran);
    }

}
