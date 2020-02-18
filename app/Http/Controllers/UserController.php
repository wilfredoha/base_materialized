<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;
use DB;

class UserController extends Controller
{
    /**
     * Display a listing of the users
     *
     * @param  \App\User  $model
     * @return \Illuminate\View\View
     */
    public function index(User $model)
    {
        $roles = DB::table('roles')->get();

        return view('users.index', ['users' => $model->paginate(15)], ['roles']);
    }

    /**
     * Show the form for creating a new user
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $roles = DB::table('roles')->get();
        return view('users.create', compact('roles'));
    }

    /**
     * Store a newly created user in storage
     *
     * @param  \App\Http\Requests\UserRequest  $request
     * @param  \App\User  $model
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(UserRequest $request, User $model)
    {
        $model->create($request->merge(['password' => Hash::make($request->get('password'))])->all());

        return redirect()->route('user.index')->withStatus(__('User successfully created.'));
    }

    /**
     * Show the form for editing the specified user
     *
     * @param  \App\User  $user
     * @return \Illuminate\View\View
     */
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified user in storage
     *
     * @param  \App\Http\Requests\UserRequest  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UserRequest $request, User  $user)
    {
        $hasPassword = $request->get('password');
        $user->update(
            $request->merge(['password' => Hash::make($request->get('password'))])
                ->except([$hasPassword ? '' : 'password']
        ));

        return redirect()->route('user.index')->withStatus(__('User successfully updated.'));
    }

    /**
     * Remove the specified user from storage
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(User  $user)
    {
        $user->delete();

        return redirect()->route('user.index')->withStatus(__('User successfully deleted.'));
    }

    public function indexUsers()
    {
        $roles = DB::table('roles')->get();
        $users = DB::table('users')->get();

        return view('users.indexUsers', compact('users', 'roles'));
    }

    public function guardarUsuario()
    {
        $usu_nom = $_POST['usu_nom'];
        $usu_ema = $_POST['usu_ema'];
        $usu_pas = $_POST['usu_pas'];
        $usu_rol = $_POST['usu_rol'];

        $id = DB::table('users')->insertGetId([
                                                'name' => $usu_nom, 
                                                'email' => $usu_ema,
                                                'password' => Hash::make($usu_pas),
                                                'limite' => 2000
                                              ]);
        DB::table('role_user')->insert(['user_id' => $id, 'role_id' => $usu_rol]);
    }

    public function editarUsuario()
    {
        $ide_usr = $_POST['ide_usr'];
        $user    = DB::table('users')->join('role_user', 'users.id', '=', 'role_user.user_id')->where('id', $ide_usr)->first();
        $roles   = DB::table('roles')->get();

        return view('users.ajax.editarUsuario', compact('user', 'roles', 'ide_usr'));
    }

    public function editarUsuarioFinal()
    {
        $usu_nomE = $_POST['usu_nomE'];
        $usu_emaE = $_POST['usu_emaE'];
        $usu_limE = $_POST['usu_limE'];
        $usu_rolE = $_POST['usu_rolE'];
        $ide_usrE = $_POST['ide_usrE'];

        DB::table('users')->where('id', $ide_usrE)->update(['name' => $usu_nomE, 'email' => $usu_emaE, 'limite' => $usu_limE]);

        // DB::table('role_user')->where('user_id', $ide_usrE)->update(['role_id', $usu_rolE]);
    }
}
