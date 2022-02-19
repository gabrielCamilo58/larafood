<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;
    
    protected $fillable = ['name', 'description'];

    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    public function permissionsAvailable($filter = null)
    {

        $permissions = Permission::whereNotIn('id', function($querry) //variavel recebe a permissão que nao está na consulta:
        {
            $querry->select('permission_profile.permission_id'); //select da tabela permission_profile a coluna permissison_id
            $querry->from('permission_profile'); //da tabela permission_profile
            $querry->whereRaw("permission_profile.profile_id={$this->id}"); //onde esta o profile_id igual ao id deste profile
        })->where(function ($querryFilter) use($filter) {
            if($filter)
                $querryFilter->where('permissions.name', 'LIKE', "%{$filter}%");
        })
        ->paginate();
        
        return $permissions;
    }
}
