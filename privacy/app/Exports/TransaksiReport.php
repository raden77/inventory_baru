<?php
namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use App\transaksi; 


class TransaksiReport implements FromCollection
{
    public function collection()
    {
        return transaksi::all();
    }
}
