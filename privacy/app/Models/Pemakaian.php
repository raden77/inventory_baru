<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Yajra\Auditable\AuditableTrait;
use App\Models\PemakaianDetail;
class Pemakaian extends Model
{
    //
    use AuditableTrait;

    protected $table = 'pemakaian';

	protected $primaryKey = 'no_pemakaian';

	public $incrementing = false;

	protected $fillable = [
    	'no_pemakaian',
        'tanggal_pemakaian',
        'status',
        'kode_company',
        'type',
        'deskripsi',
    ];
   
    public function Company()
    {
        return $this->belongsTo(Company::class,'kode_company');
    }

    public function PemakaianDetail()
    {
        return $this->hasMany(PemakaianDetail::class,'no_pemakaian');
    }

     public function getDestroyUrlAttribute()
    {
        return route('pemakaian.destroy', $this->no_pemakaian);
    }

    public function getEditUrlAttribute()
    {
        return route('pemakaian.edit',$this->no_pemakaian);
    }

    public function getUpdateUrlAttribute()
    {
        return route('pemakaian.update',$this->no_pemakaian);
    }

    public function getDetailUrlAttribute()
    {
        return route('pemakaian.detail',$this->no_pemakaian);
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($query){
            $query->status = 'OPEN';
            $query->kode_company = Auth()->user()->kode_company;
            $query->no_pemakaian = static::generateKode(request());
        });
    }

    public static function generateKode($data,$source_text = 'NPK')
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
