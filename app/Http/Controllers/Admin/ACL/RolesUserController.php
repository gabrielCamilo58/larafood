<?php

namespace App\Http\Controllers\Admin\ACL;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class RolesUserController extends Controller
{
    protected $roles, $user;
    public function __construct(Role $role, User $user)
    {
        $this->roles = $role;
        $this->user = $user;

        $this->middleware(['can:users']);
    }

    public function users($idRole)
    {
        if(!$role = $this->roles->find($idRole))return redirect()->back();

        $users = $role->users()->paginate();

        return view('admin.pages.roles.users.users', compact('role', 'users'));

    }
    public function roles($idUser)
    {
        if(!$user = $this->user->find($idUser)) return redirect()->back();

        $roles = $user->roles()->paginate();

        return view('admin.pages.roles.user', compact('user', 'roles'));
    }
    public function usersAvailable(Request $request, $idRole)
    {
        if(!$role = $this->roles->find($idRole))return redirect()->back();

        $filters = $request->only('filter');
        $users = $role->usersAvailable($request->filter);

        
        return view('admin.pages.roles.users.available', compact('role', 'users', 'filters'));

    }
    public function attach(Request $request, $idRole)
    {
        if(!$role = $this->roles->find($idRole)) return redirect()->back();

        if(!$request->users || count($request->users) == 0) 
            return redirect()->back()->with('info', 'Precisa escolher pelo menos um usuario');

        $role->users()->attach($request->users);

        return redirect()->route('roles_users', $role->id);
    }
    public function detach($idRole, $idUser)
    {
        if(!$role = $this->roles->find($idRole)) return redirect()->back();
        if(!$user = $this->user->find($idUser)) return redirect()->back();

        $role->users()->detach($user);
        return redirect()->back();

    }
    public function searchRoleUser(Request $request, $idrole)
    {
        if(!$role = $this->roles->find($idrole)) return redirect()->back();
        $filters = $request->only('filter');

        $users = $role->users()->where( function ($query) use($request){
            $query->where('users.name', 'LIKE', "%{$request->filter}%");
        })->paginate();

        return view('admin.pages.roles.users.users', compact('role', 'users', 'filters'));
    }

}
