<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Yajra\Auditable\AuditableTrait;
use App\Mddels\Permintaan;
use APP\Models\Pembelian;

class Memo extends Model
{
    //
    use AuditableTrait;

    protected $table = 'memo';

	protected $primaryKey = 'no_memo';

	public $incrementing = false;

	protected $fillable = [
    	'no_memo',
        'no_permintaan',
        'tanggal_memo',
        'status',
        'kode_company',
    ];

    public function Company()
    {
        return $this->belongsTo(Company::class,'kode_company');
    }

    public function Permintaan()
    {
        return $this->belongsTo(Permintaan::class,'no_permintaan');
    }

    public function Pembelian()
    {
    return $this->hasMany(Pembelian::class,'no_memo');
    }


     public function getDestroyUrlAttribute()
    {
        return route('memo.destroy', $this->no_memo);
    }

    public function getEditUrlAttribute()
    {
        return route('memo.edit',$this->no_memo);
    }

    public function getUpdateUrlAttribute()
    {
        return route('memo.update',$this->no_memo);
    }

    public function getDetailUrlAttribute()
    {
        return route('memo.detail',$this->no_memo);
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($query){
           $query->status = 'OPEN';
           $query->kode_company = Auth()->user()->kode_company;
           $query->no_memo = static::generateKode(request());
        });
    }

    public static function generateKode($data,$source_text = 'NMM')
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
