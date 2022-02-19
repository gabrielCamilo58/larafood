<?php

namespace App\Http\Controllers\Admin\ACL;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Profile;
use Illuminate\Http\Request;

class PermissionProfileController extends Controller
{
    protected $profile, $permission;

    public function __construct(Profile $profile, Permission $permission)
    {
        $this->profile = $profile;
        $this->permission = $permission;
    }
    public function permissions($idProfile)
    {
        $profile = $this->profile->find($idProfile);
        if(!$profile)
            return redirect()->back();
        
        $permissions = $profile->permissions()->paginate();

        return view('admin.pages.profiles.permissions.permissions', compact('profile', 'permissions'));
    }

    public function permissionsAvailable(Request $request, $idProfile)
    {
        if(!$profile = $this->profile->find($idProfile)) return redirect()->back();

        $filters = $request->except('_token');

        $permissions = $profile->permissionsAvailable($request->filter);

        if(!count($permissions)) $request->session()->flash('info', "Não existem mais permissões disponiveis para {$profile->name}");

        return view('admin.pages.profiles.permissions.available', compact('profile', 'permissions', 'filters'));
    }
    public function attach(Request $request, $idProfile)
    {
        if(!$profile = $this->profile->find($idProfile))
            return redirect()->back();
        
        if(!$request->permissions || count($request->permissions) == 0)
            return redirect()->back()->with('info', 'Precisa escolher pelo menos uma permissão');


        $profile->permissions()->attach($request->permissions); //$request permission é um array
        //attach faz a vinculação 
       
        return redirect()->route('profiles_permissons', $profile->id);
    }
    public function detach($idProfile, $idPermission)
    {
        $profile = $this->profile->find($idProfile);
        $permission = $this->permission->find($idPermission);

        if(!$profile || !$permission)
            return redirect()->back();

        $profile->permissions()->detach($permission);

        return redirect()->back(); //->route('profiles_permissons', $profile->id);
    }
    public function profiles($idPermission)
    {
        $permission = $this->permission->find($idPermission);

        if(!$permission) return redirect()->back;

        $profiles = $permission->profiles()->paginate();

        return view('admin.pages.permission.profile', compact('permission', 'profiles'));
    }
}
