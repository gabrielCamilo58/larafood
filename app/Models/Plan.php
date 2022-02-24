<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Plan extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'url', 'price', 'description'];

    /**
     * Get Details
     */
    public function details()
    {
        return $this->hasMany(DetailPlan::class);
    }

    /**
     * Get Profiles
     */
    
    public function profiles()
    {
        return $this->belongsToMany(Profile::class);
    }

    public function tenants()
    {
        return $this->hasMany(Tenant::class);
    }

    public function search($filter = null)
    {
        $result = $this->where('name', 'LIKE', "%{$filter}%")
                        ->orWhere('description', 'LIKE', "%{$filter}%")
                        ->paginate();

        return $result;
    }

}
