<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Yajra\Auditable\AuditableTrait;
use App\Models\Memo;
use App\Models\Vendor;
use App\Models\PembelianDetail;

class Pembelian extends Model
{
    //
    use AuditableTrait;

    protected $table = 'pembelian';

	protected $primaryKey = 'no_pembelian';

	public $incrementing = false;

	protected $fillable = [
    	'no_pembelian',
        'no_memo',
        'kode_vendor',
        'tanggal_pembelian',
        'status',
        'kode_company',
        'jenis_po',
    ];

    public function Company()
    {
        return $this->belongsTo(Company::class,'kode_company');
    }
    public function Memo()
    {
        return $this->belongsTo(Memo::class,'no_memo');
    }

    public function Vendor()
    {
        return $this->belongsTo(Vendor::class,'kode_vendor');
    }

    public function PembelianDetail()
    {
        return $this->hasMany(PembelianDetail::class,'no_pembelian');
    }

     public function getDestroyUrlAttribute()
    {
        return route('pembelian.destroy', $this->no_pembelian);
    }

    public function getEditUrlAttribute()
    {
        return route('pembelian.edit',$this->no_pembelian);
    }

    public function getUpdateUrlAttribute()
    {
        return route('pembelian.update',$this->no_pembelian);
    }

    public function getDetailUrlAttribute()
    {
        return route('pembelian.detail',$this->no_pembelian);
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($query){
            $query->status = 'OPEN';
            $query->kode_company = Auth()->user()->kode_company;
            $query->no_pembelian = static::generateKode(request());
        });
    }

    public static function generateKode($data,$source_text = 'NPB')
    {
        
        $primary_key = (new self)->getKeyName();
        $get_prefix_1 = Auth()->user()->kode_company;
        $get_prefix_2 = strtoupper($source_text);
        $get_prefix_3 = date('my');
        $prefix_result = $get_prefix_1.$get_prefix_2.$get_prefix_3;
        $prefix_result_length = strlen($get_prefix_1.$get_prefix_2.$get_prefix_3);

        $lastRecort = self::where($primary_key,'like',$prefix_result.'%')->orderBy('created_at', 'desc')->first();

        if ( ! $lastRecort )
            $number = 0;
        else {
            $get_record_prefix = strtoupper(substr($lastRecort->{$primary_key}, 0,$prefix_result_length));
            if ($get_record_prefix == $prefix_result){
                $number = substr($lastRecort->{$primary_key},$prefix_result_length);
            }else {
                $number = 0;
            }

        }

        $result_number = $prefix_result . sprintf('%06d', intval($number) + 1);

        return $result_number ;
    }
}
