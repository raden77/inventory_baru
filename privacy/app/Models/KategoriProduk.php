<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Yajra\Auditable\AuditableTrait;
use App\Models\Produk;

class KategoriProduk extends Model
{
    //

    use AuditableTrait;

    protected $table = 'kategori_produk';

	protected $primaryKey = 'kode_kategori';

	public $incrementing = false;

	protected $fillable = [
    	'kode_kategori',
        'nama_kategori',
        'status',
    ];

    public function Produk()
    {
    return $this->hasMany(Produk::class,'kode_kategori');
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
