<?php

namespace App\Http\Controllers;

use App\Permission;
use Illuminate\Http\Request;

class PermissionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $create_url = route('permissions.create');
        $permissions = Permission::all();

        return view('admin.permissions.index',compact('create_url'))->withPermissions($permissions);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $info['list_url'] = route('permissions.index');
        $info['title'] = 'Create New Permission';

        return view('admin.permissions.create', compact('info','permissions'));
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
           'parameter' => 'required',
           'name' => 'required',
        ]);
        foreach ($request->parameter as $key => $value){
            $permission = new Permission();
            $permission->name = strtolower($value.'-'.$request->name);
            $permission->display_name = ucfirst($value).' '. ucwords($request->name);
            $permission->description = ucfirst($value).' '. ucwords($request->name);
            $permission->tab = ucwords($request->name);
            $permission->save();
        }

        return redirect()->route('permissions.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function show(Permission $permission)
    {
        $info['list_url'] = route('permissions.index');
        $info['title'] = 'Show Data : [' .$permission->name.']';

        return view('admin.permissions.show', compact('info'))
            ->withPermission($permission);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function edit(Permission $permission)
    {
        $info['list_url'] = route('permissions.index');
        $info['title'] = 'Update Data: [' .$permission->name.']';

        return view('admin.permissions.edit', compact('info'))
            ->withPermission($permission);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Permission $permission)
    {
        $this->validate($request,[
            'display_name' => 'required',
        ]);

        $permission->update($request->only('display_name','description'));

        return redirect()->route('permissions.show',$permission->id)->withPermission($permission);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permission $permission)
    {
        //
    }
}
