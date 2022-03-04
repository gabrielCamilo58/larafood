<?php

namespace App\Http\Controllers\Admin\ACL;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;

class PermissionRoleController extends Controller
{
    protected $roles, $permissions;

    public function __construct(Role $role, Permission $permission)
    {
        $this->roles = $role;
        $this->permissions = $permission;
        $this->middleware(['can:roles']);
    }
    
    public function permissions($idRole)
    {
        if(!$role = $this->roles->find($idRole))
            return redirect()->back();
        
        
        $permissions = $role->permissions()->paginate();

        return view('admin.pages.roles.permissions.permissions', compact('role', 'permissions'));
    }

    public function permissionsAvailable(Request $request, $idRole)
    {
        if(!$role = $this->roles->find($idRole)) return redirect()->back();

        $filters = $request->only('filter');

        $permissions = $role->permissionsAvailable($request->filter);

        return view('admin.pages.roles.permissions.available', compact('role','permissions','filters'));
    }
    public function attach(Request $request, $idRole)
    {
        if(!$role = $this->roles->find($idRole)) return redirect()->back();

        if(!$request->permissions || count($request->permissions) == 0)
            return redirect()->back()->with('info', 'Precisa escolher pelo menos uma permissão');

        $role->permissions()->attach($request->permissions);

        return redirect()->route('roles_permissons', $role->id);
    }
    public function detach($idRole, $idPermission)
    {
        if(!$role = $this->roles->find($idRole)) return redirect()->back();
        if(!$permission = $this->permissions->find($idPermission)) return redirect()->back();

        $role->permissions()->detach($permission);

        return redirect()->back();

    }

    public function roles($idPermission)
    {
        $permission = $this->permissions->find($idPermission);

        if(!$permission) return redirect()->back();

        $roles = $permission->roles()->paginate();

        return view('admin.pages.permission.roles', compact('roles', 'permission'));
    }

    public function searchRolePermission(Request $request, $idRole)
    {
        if(!$role = $this->roles->find($idRole)) return redirect()->back();

        $filter = $request->filter;
        $permissions = $role->permissions()->where(function ($query) use($filter){
            $query->where('permissions.name', 'LIKE', "%{$filter}%");
        })->paginate();

        return view('admin.pages.roles.permissions.permissions', compact('role', 'permissions'));
    }
   
}
