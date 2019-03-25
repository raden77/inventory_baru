<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Yajra\Auditable\AuditableTrait;
use App\Models\Produk;
use App\Models\PenerimaanDetail;

class Penerimaan extends Model
{
    //
    use AuditableTrait;

    protected $table = 'penerimaan';

	protected $primaryKey = 'no_penerimaan';

	public $incrementing = false;

	protected $fillable = [
    	'no_penerimaan',
        'no_pembelian',
        'tanggal_penerimaan',
        'status',
        'kode_company',
    ];

    public function Company()
    {
        return $this->belongsTo(Company::class,'kode_company');
    }

    public function Pembelian()
    {
        return $this->belongsTo(Pembelian::class,'no_pembelian');
    }

    public function PenerimaanDetail()
    {
        return $this->hasMany(PenerimaanDetail::class,'no_penerimaan');
    }

    

    public function getDestroyUrlAttribute()
    {
        return route('penerimaan.destroy', $this->no_penerimaan);
    }

    public function getEditUrlAttribute()
    {
        return route('penerimaan.edit',$this->no_penerimaan);
    }

    public function getUpdateUrlAttribute()
    {
        return route('penerimaan.update',$this->no_penerimaan);
    }

    public function getDetailUrlAttribute()
    {
        return route('penerimaan.detail',$this->no_penerimaan);
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($query){
            $query->status = 'OPEN';
            $query->kode_company = Auth()->user()->kode_company;
            $query->no_penerimaan = static::generateKode(request());
        });
    }

    public static function generateKode($data,$source_text = 'NPM')
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
