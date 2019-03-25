<?php

namespace App\DataTables;

use App\Produk;
use Yajra\DataTables\Services\DataTable;

class ProdukDataTable extends DataTable
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
            ->escapeColumns('nama_gambar')
            ->editColumn('kode_produk', function ($query){
                return link_to($query->edit_url,$query->kode_produk);
            })
            ->editColumn('nama_gambar', function ($query){
                return $query->gambar;
            })

            ->addColumn('action', function ($query){
                $action =
                    '<a href="'.$query->edit_url.'" class="btn btn-info btn-sm"> <i class="fa fa-eye"></i> Lihat</a>'.'&nbsp'.
                    '<a href="'.$query->edit_url.'" class="btn btn-warning btn-sm"> <i class="fa fa-edit"></i> Edit</a>'.'&nbsp'.
                    '<a href="javascript:;" onclick="del(\''.$query->id.'\',\''.$query->destroy_url.'\')" 
                    id="hapus" class="btn btn-danger btn-sm"> <i class="fa fa-times-circle"></i> Hapus</a>'.'&nbsp';

                return $action;
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Produk $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Produk $model)
    {
        return $model->newQuery()->select('kode_produk', 'nama_produk', 'nama_gambar', 'created_at', 'updated_at');
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
            'kode_produk',
            'nama_produk',
            'created_at',
            ['name' => 'nama_gambar', 'data' => 'nama_gambar','title' => 'Gambar']
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Produk_' . date('YmdHis');
    }
}
