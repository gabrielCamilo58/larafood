<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description'];

    /**
     *  Get Permissions
     */
    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

     /**
     * Get Users
     */
    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    /**
     * get Role filter
     */
    public function permissionsAvailable($filter = null)
    {
        $permissions = Permission::whereNotIn('permissions.id', function ($query){
            //!select a coluna permission_id da tabela permission_role onde esta role_id = ao id desta role;
                $query->select('permission_role.permission_id');
                $query->from('permission_role'); 
                $query->whereRaw("permission_role.role_id={$this->id}");
        })->where(function ($queryFilter) use($filter) {
            if($filter){
                $queryFilter->where('permissions.name', 'LIKE', "%{$filter}%")
                      ->orWhere('permissions.description', 'LIKE', "%{$filter}%");  
            }
        })->paginate();

        return $permissions;
    }
    
    /**
     * Get link Roles com Users
     */
    public function usersAvailable($filter = null)
    {
        
        $users = User::whereNotIN('users.id', function ($query){
            $query->select('role_user.user_id');
            $query->from('role_user');
            $query->whereRaw("role_user.role_id={$this->id}");
        })->where(function ($queryFilter) use($filter){
            if($filter){
                $queryFilter->where('users.name', 'LIKE', "%{$filter}%");
            }
        })->paginate();

        return $users;
    }
   
}

