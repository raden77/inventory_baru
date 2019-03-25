<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Yajra\Auditable\AuditableTrait;
use App\Models\Produk;
use App\Models\Permintaan;
use App\Models\Pemakaian;
use App\Models\Pembelian;
use App\Models\Penerimaan;
use App\Models\Memo;
use App\User;

class Company extends Model
{
    //
    use AuditableTrait;

    protected $table = 'company';

	protected $primaryKey = 'kode_company';

	public $incrementing = false;

	protected $fillable = [
    	'kode_company',
        'nama_company',
        'alamat',
        'telp',
        'npwp',
        'status',
    ];

   

    public function Produk()
    {
    return $this->hasMany(Produk::class,'kode_company');
    }

    public function Permintaan()
    {
    return $this->hasMany(Permintaan::class,'kode_company');
    }

    public function Pemakaian()
    {
        return $this->hasMany(Pemakaian::class,'kode_company');
    }

    public function Pembelian()
    {
        return $this->hasMany(Pembelian::class,'kode_company');
    }
    public function Penerimaan()
    {
        return $this->hasMany(Penerimaan::class,'kode_company');
    }
    public function Memo()
    {
        return $this->hasMany(Memo::class,'kode_company');
    }
    public function User()
    {
        return $this->hasOne(User::class,'kode_company');
    }

     public function getDestroyUrlAttribute()
    {
        return route('company.destroy', $this->kode_company);
    }

    public function getEditUrlAttribute()
    {
        return route('company.edit',$this->kode_company);
    }

    public function getUpdateUrlAttribute()
    {
        return route('company.update',$this->kode_company);
    }

}
