<?php

namespace App\Models\Traits;

trait UserACLTrait
{
    public function permissions()
    {
        $tenant = $this->tenant;
        $plan = $tenant->plan;

        $permissionsArray = [];

        foreach($plan->profiles as $profile){

            foreach($profile->permissions as $permission){
                array_push($permissionsArray, $permission->name);
            }
        }

        
        return $permissionsArray;
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