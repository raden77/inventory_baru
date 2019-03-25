<?php

namespace App\Http\Controllers;

use App\DataTables\UsersDataTable;
use App\Permission;
use App\Role;
use App\User;
use App\Models\Company;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(UsersDataTable $dataTable)
    {
        $testing = User::with('roles')->take(2)->get();
//        dd($testing->toArray());
        $create_url = route('users.create');

        return $dataTable->render('admin.users.index',compact('create_url'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        $list_url = route('users.index');
        $Company= Company::pluck('nama_company','kode_company');
        return view('admin.users.create', compact('list_url','roles','Company'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = User::create($request->all());

        if ($request->has('roles')){
            $user->syncRoles($request->roles);
        }

        return redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $list_url = route('users.index');
        $roles = Role::pluck('display_name','id');
//        $permissions = Permission::all();
        $Company= Company::pluck('nama_company','kode_company');
        return view('admin.users.edit',compact('user','list_url','roles','Company'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
//            dd($request->has('password') && $request->password != null);
        if ($request->has('password') && $request->password != null){

            $req = $request->all();
            $req['password'] = bcrypt($request->password);
            $user->update($req);
        }else {
            $user->update($request->except('password'));
        }

        if ($request->has('roles')){
            $user->syncRoles($request->roles);
        }

        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        try {
            $user->delete();

            $message = [
                'success' => true,
                'title' => 'Hapus',
                'message' => 'Selamat! Data ['.$user->name.'] berhasil dihapus.'
            ];
            return response()->json($message);

        }catch (\Exception $exception){
            $message = [
                'success' => false,
                'title' => 'Hapus',
                'message' => 'Maaf! Data gagal dihapus.'
            ];
            return response()->json($message);
        }
    }
}
