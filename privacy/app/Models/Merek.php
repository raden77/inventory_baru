<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Yajra\Auditable\AuditableTrait;
use App\Models\Produk;

class Merek extends Model
{
    //
    use AuditableTrait;

    protected $table = 'merek';

	protected $primaryKey = 'kode_merek';

	public $incrementing = false;

	protected $fillable = [
    	'kode_merek',
    	'nama_merek',
    ];

    public function Produk()
    {
    return $this->hasMany(Produk::class,'kode_merek');
    }

     public function getDestroyUrlAttribute()
    {
        return route('merek.destroy', $this->kode_merek);
    }

    public function getEditUrlAttribute()
    {
        return route('merek.edit',$this->kode_merek);
    }

    public function getUpdateUrlAttribute()
    {
        return route('merek.update',$this->kode_merek);
    }

}
