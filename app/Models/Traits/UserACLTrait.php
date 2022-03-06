<?php

namespace App\Models\Traits;

use App\Models\Tenant;

trait UserACLTrait
{
    public function permissions()
    {
        
        $permissionsPlan = $this->permissionsPlan();
        $permissionsRole = $this->permissionsRole();
        

        $permissions = [];
        foreach ($permissionsRole as $permissionRole){
            if(in_array($permissionRole, $permissionsPlan)){
                array_push($permissions, $permissionRole);
            }
        }

        return $permissions;
    }

    public function permissionsPlan():array
    {
       // $tenant = $this->tenant;
       // $plan = $tenant->plan;

       $tenant = Tenant::with('plan.profiles.permissions')->where('id', $this->tenant_id)->first();
       $plan = $tenant->plan;

        $permissionsArray = [];
        foreach($plan->profiles as $profile){
            
            foreach($profile->permissions as $permission){
                array_push($permissionsArray, $permission->name);
            }
        }

        
        return $permissionsArray;
    }

    public function permissionsRole():array
    {

        $roles = $this->roles()->with('permissions')->get();
        $permissions = [];

        
        foreach($roles as $role){
            foreach($role->permissions as $permission){
                array_push($permissions, $permission->name);
            }
        }
   
        return $permissions;
    }

    public function hasPermission(String $permissionName): bool
    {
        return in_array($permissionName, $this->permissions());
    }

    public function isAdmin():bool
    {
        return in_array($this->email, config('acl.admin'));
    }
    
    public function isTenant():bool
    {
        return !in_array($this->email, config('acl.admin'));
    }
}