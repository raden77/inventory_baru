<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Yajra\Auditable\AuditableTrait;
use App\Models\Produk;
use App\Models\satuan;

class MemoDetail extends Model
{
    //
    use AuditableTrait;

    protected $table = 'memo_detail';

	protected $primaryKey = 'id';

	public $incrementing = true;

	protected $fillable = [
        'no_memo',
        'no_permintaan',
        'kode_produk',
        'kode_satuan',
        'qty',
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

     public function getDestroyUrlAttribute()
    {
        return route('memodetail.destroy', $this->id);
    }

    public function getEditUrlAttribute()
    {
        return route('memodetail.edit',$this->id);
    }

    public function getUpdateUrlAttribute()
    {
        return route('memodetail.update',$this->id);
    }
}
