<?php

namespace App\Http\Controllers;

use App\DataTables\RolesDataTable;
use App\Role;
use Illuminate\Http\Request;
use App\Permission;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(RolesDataTable $dataTable)
    {
        $create_url = route('roles.create');

        return $dataTable->render('admin.roles.index',compact('create_url'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $info['list_url'] = route('roles.index');
        $info['title'] = 'Create new role';
        $permissions = Permission::all();

//        dd($permissions->groupBy('tab'));


        return view('admin.roles.create', compact('info','permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
           'name' => 'required',
           'display_name' => 'required'
        ]);

        $role = Role::create($request->all());
        if ($request->has('permission')){
            $role->syncPermissions($request->permission);
        }


        return redirect()->route('roles.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        $info['list_url'] = route('roles.index');
        $info['title'] = 'Edit role : '. $role->name;
        $permissions = Permission::all();
        $get_permission = $role->permissions()->pluck('name','name');

//        dd([array_has($get_permission->toArray(), 'create-users'), $get_permission->toArray()]);

        return view('admin.roles.edit', compact('role','info', 'permissions', 'get_permission'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {

        try {
            $role->update($request->all());

            if ($request->has('permission')){
                $role->syncPermissions($request->permission);
            }else{
                $role->permissions()->detach();
            }



            $message = [
                'success' => true,
                'title' => 'Hapus',
                'message' => 'Selamat! Data ['.$role->name.'] berhasil diupdate.'
            ];
            return response()->json($message);

        }catch (\Exception $exception){
            $message = [
                'success' => false,
                'title' => 'Hapus',
                'message' => 'Maaf! Data gagal diupdate.'. $exception
            ];

            \Log::error($exception);
            return response()->json($message,403);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        try {
            $role->delete();

            $message = [
                'success' => true,
                'title' => 'Update',
                'message' => 'Selamat! Data ['.$role->name.'] berhasil dihapus.'
            ];
            return response()->json($message);

        }catch (\Exception $exception){
            $message = [
                'success' => false,
                'title' => 'Update',
                'message' => 'Maaf! Data gagal dihapus.'
            ];
            return response()->json($message);
        }
    }
}
