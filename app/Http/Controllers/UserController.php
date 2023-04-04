<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use App\Models\User;
use DB;
use Hash;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Arr;
use Active;
session_start();

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */



    public function index(Request $request)
    {
        $role = strval($_SESSION["role"]);
        if($role === "Admin"){
        $data = User::orderBy('id','DESC')->paginate(5);
        $users = Active::users()->get();
        $guests = Active::guests()->get();
        return view('users.index',compact('data'), ["users" => $users, "guests" => $guests] )
            ->with('i', ($request->input('page', 1) - 1) * 5);
        }else{
            return view('noAccess');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $role = strval($_SESSION["role"]);
        if($role === "Admin"){
            $roles = Role::pluck('name','name')->all();
            return view('users.create',compact('roles'));
        }else{
            return view('underconstruction');
        }
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
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'roles'

        ]);

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);

        $user = User::create($input);
        $user->assignRole($request->input('roles'));

        return redirect()->route('users.index')
                        ->with('success','User created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $auth = strval($_SESSION["auth"]);
        $role = strval($_SESSION["role"]);
        if($auth === "2" || $auth === "3"){
            return view('congrats');
        
        }else if($auth===strval($id) || $role === "Admin"){
            $user = User::find($id);
            return view('users.show',compact('user'));
        }else{
            return view('underconstruction');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $auth = strval($_SESSION["auth"]);
        $role = strval($_SESSION["role"]);
        if($auth === "2" || $auth === "3"){
            return view('congrats');
        }else if($auth===strval($id) || $role === "Admin"){
            $user = User::find($id);
            $roles = Role::pluck('name','name')->all();
            $userRole = $user->roles->pluck('name','name')->all();

            return view('users.edit',compact('user','roles','userRole'));
        }else{
            return view('underconstruction');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'same:confirm-password',
            'roles'
        ]);

        $input = $request->all();
        if(!empty($input['password'])){
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = Arr::except($input,array('password'));
        }

        $user = User::find($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id',$id)->delete();

        $user->assignRole($request->input('roles'));

        return redirect()->route('users.index')
                        ->with('success','User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->route('users.index')
                        ->with('success','User deleted successfully');
    }

    public function block($id){

        $role = strval($_SESSION["role"]);
        if($role === "Admin"){
            User::where('id',$id)->update(['isBlocked' => true]);
            return redirect()->route('users.index')
                ->with('success','User blocked successfully');
        }
        return redirect()->route('users.index');
    }

    public function unblock($id){
        $role = strval($_SESSION["role"]);
        if($role === "Admin") {
            User::where('id',$id)->update(['isBlocked' => false]);
            return redirect()->route('users.index')
                ->with('success','User unblocked successfully');
        }
        return redirect()->route('users.index');
    }


}
