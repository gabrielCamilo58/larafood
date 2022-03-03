<?php

namespace App\Models;

use App\Tenant\Traits\TenantTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Table extends Model
{

    use TenantTrait;
    use HasFactory;

    protected $fillable = ['identify', 'description'];

    public function tenants()
    {
        return $this->belongsTo(Tenant::class);
    }
}
