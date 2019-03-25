<?php

namespace App\DataTables;

use App\Peminjaman;
use Yajra\DataTables\Services\DataTable;

class PeminjamanDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables($query)
            ->editColumn('no_pinjaman', function ($query){
                return link_to($query->edit_url,$query->no_pinjaman);
            })
            ->editColumn('jumlah_pinjaman', function ($query){
                return number_format($query->jumlah_pinjaman,'0', ',', '.');
            })
            ->editColumn('total_pinjaman', function ($query){
                return number_format($query->total_pinjaman,'0', ',', '.');
            })
            ->addColumn('action', function ($query){
                $action =
                    '<a href="'.$query->show_url.'" class="btn btn-info btn-sm"> <i class="fa fa-eye"></i> Lihat</a>'.'&nbsp'.
                    '<a href="'.$query->edit_url.'" class="btn btn-warning btn-sm"> <i class="fa fa-edit"></i> Edit</a>'.'&nbsp'.
                    '<a href="javascript:;" onclick="del(\''.$query->id.'\',\''.$query->destroy_url.'\')" 
                    id="hapus" class="btn btn-danger btn-sm"> <i class="fa fa-times-circle"></i> Hapus</a>'.'&nbsp';

                return $action;
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Peminjaman $model)
    {
        return $model->newQuery()->select('id', 'no_pinjaman', 'jumlah_pinjaman' ,'bunga',
            'total_pinjaman', 'total_pembayaran','tanggal_pinjaman');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->parameters([
                        'searchDelay' => 1400,
                        'autoWidth' => false,
                        'columnDefs' => '[ className: "text-right", "targets": [3] ]',
                    ])
                    ->addAction(['width' => '200px']);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            ['data' => 'id', 'title' => 'Id', 'visible' => false],
            'no_pinjaman',
            'jumlah_pinjaman' ,
            ['data' => 'bunga', 'title' => 'Bunga'],
            'total_pinjaman',
            'total_pembayaran',
            'tanggal_pinjaman'
        
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Peminjaman_' . date('YmdHis');
    }
}
