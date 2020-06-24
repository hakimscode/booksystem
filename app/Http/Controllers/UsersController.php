<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserCollection;
use App\Http\Resources\UserItem;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('super_admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = User::join('roles', 'roles.id', '=', 'users.role_id')
            ->select('users.*', 'roles.id as roleid', 'roles.role')
            ->where('roles.id', '!=', 1)->get();

        $result = new UserCollection($data);

        return view('super_admin.users', ['users' => $result]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::where('id', '!=', 1)->get();
        return view('super_admin.user-insert', ['roles' => $roles]);
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:8'],
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validator($request->all())->validate();

        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->role_id = $request->input('role_id');
        $user->password = Hash::make($request->input('password'));

        if ($user->save()) {
            return redirect(route('users'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $user = User::join('roles', 'roles.id', '=', 'users.role_id')
            ->select('users.*', 'roles.id as roleid', 'roles.role')
            ->where('users.id', $id)->first();
            
        if($user->role_id == 1){
            return redirect(route('users'));
        }
        
        $roles = Role::where('id', '!=', 1)->get();
        return view('super_admin.user-edit', ['user' => $user, 'roles' => $roles]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $user = User::findOrFail($request->input('id'));

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->role_id = $request->input('role_id');

        if ($user->save()) {
            return redirect(route('users'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        if($user->delete()){
            return redirect(route('users'));
        }
    }
}
