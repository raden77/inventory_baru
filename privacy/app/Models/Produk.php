<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Yajra\Auditable\AuditableTrait;
use App\Models\KategoriProduk;
use App\Models\Merek;
use App\Models\Ukuran;
use App\Models\satuan;
use App\Models\Company;
use App\Models\PermintaanDetail;
use App\Models\MasterLokasi;

class Produk extends Model
{
    //
    use AuditableTrait;

    protected $table = 'produk';

	protected $primaryKey = 'kode_produk';

	public $incrementing = false;

	protected $fillable = [
    	'kode_produk',
        'nama_produk',
        'kode_kategori',
        'kode_merek',
        'kode_ukuran',
        'kode_satuan',
        'type',
        'harga_beli',
        'harga_jual',
        'hpp',
        'stok',
        'aktif',
        'kode_company',
        'id_lokasi',
    ];

    public function PermintaanDetail()
    {
    return $this->hasMany(PermintaanDetail::class,'kode_satuan');
    }

    public function PemakaianDetail()
    {
    return $this->hasMany(PemakaianDetail::class,'kode_satuan');
    }
    
    public function KategoriProduk()
    {
        return $this->belongsTo(KategoriProduk::class,'kode_kategori');
    }

    public function Merek()
    {
        return $this->belongsTo(Merek::class,'kode_merek');
    }

    public function Ukuran()
    {
        return $this->belongsTo(Ukuran::class,'kode_ukuran');
    }

    public function satuan()
    {
        return $this->belongsTo(satuan::class,'kode_satuan');
    }

    public function company()
    {
        return $this->belongsTo(Company::class,'kode_company');
    }

    public function MasterLokasi()
    {
        return $this->belongsTo(MasterLokasi::class,'id_lokasi');
    }

     public function getDestroyUrlAttribute()
    {
        return route('produk.destroy', $this->kode_produk);
    }

    public function getEditUrlAttribute()
    {
        return route('produk.edit',$this->kode_produk);
    }

    public function getShowUrlAttribute()
    {
        return route('produk.show',$this->kode_produk);
    }

    public function getUpdateUrlAttribute()
    {
        return route('produk.update',$this->kode_produk);
    }

    // public static function boot()
    // {
    //     parent::boot();

    //     static::creating(function ($query){
    //        $query->id_lokasi = 5;
    //     });
    // }

    public static function boot()
    {
        parent::boot();
       
        static::creating(function ($query){
           $query->kode_company = Auth()->user()->kode_company;
           $query->kode_produk = static::generateKode(Auth()->user()->kode_company);
           $query->id_lokasi = 1;
        });
    }

    public static function generateNumber($sumber_text)
    {

        $lastRecort = self::orderBy('created_at', 'desc')->first();
        $prefix = strtoupper($sumber_text) ;
        $primary_key = (new self)->getKeyName();

        // dd($primary_key);

        if ( ! $lastRecort )
            $number = 0;
        else {
            $field = $lastRecort->{$primary_key} ;
            if ($prefix[0] == $lastRecort->{$primary_key}[0]){
                $number = substr($field, 2);
            }else {
                $number = 0;
            }
        }

        return  $prefix . sprintf('%04d', intval($number) + 1);
    }

    public static function generateKode($sumber_text)
    {
        
        $primary_key = (new self)->getKeyName();
        // $get_prefix_1 = $data->kode_company;
        $get_prefix_2 = strtoupper($sumber_text);
        $get_prefix_3 = date('my');
        $prefix_result = $get_prefix_2.$get_prefix_3;
        $prefix_result_length = strlen($prefix_result);

        $lastRecort = Produk::where($primary_key,'like',$prefix_result.'%')->orderBy('created_at', 'desc')->first();

        // dd($lastRecort->toArray());

        if ( ! $lastRecort )
            $number = 0;
        else {
            $get_record_prefix = strtoupper(substr($lastRecort->{$primary_key}, 0,$prefix_result_length));
            // dd($get_record_prefix, $prefix_result);
            if ($get_record_prefix === $prefix_result){
                $number = substr($lastRecort->{$primary_key},$prefix_result_length);
            }else {
                $number = 0;
            }

        }

        $result_number = $prefix_result . sprintf('%03d', intval($number) + 1);

        return $result_number ;
    }
}
