<?php

namespace App\DataTables;

use App\User;
use App\Models\Company;
use Yajra\DataTables\Services\DataTable;

class UsersDataTable extends DataTable
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
            ->escapeColumns(['action'])
            ->addColumn('action', function($query) {
                $action = '<a href="'.$query->edit_url.'" class="btn btn-warning btn-sm"> <i class="fa fa-edit"></i> Edit</a>'.'&nbsp'.
                    '<a href="javascript:;" onclick="del(\''.$query->id.'\',\''.$query->destroy_url.'\')" 
                    id="hapus" class="btn btn-danger btn-sm"> <i class="fa fa-times-circle"></i> Hapus</a>'.'&nbsp';
                $admin_exist = collect($query->roles)->firstWhere('name','superadministrator');
                if (count($admin_exist) > 0){
                    return '<a href="'.$query->edit_url.'" class="btn btn-warning btn-sm"> <i class="fa fa-edit"></i> Edit</a>'.'&nbsp'.
                        '<a href="javascript:;" onclick="del(\''.$query->id.'\',\''.$query->destroy_url.'\')" ';
                }
                return $action;
            })
            ->addColumn('roles', function (User $user) {
                return $user->roles->map(function($role) {
                    return '<span class="label label-primary">'.$role->name.'</span>';
                })->implode('&nbsp');
            })
            ->addColumn('company', function ($query) {
                
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $model)
    {
        return $model->newQuery()->with('roles','company')->select('id', 'name', 'email');
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
                    ->addAction(['width' => '150px']);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            'id',
            'name',
            'email',
            'roles',
            'company'
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Users_' . date('YmdHis');
    }
}
