<?php

namespace App\Models;

use App\Tenant\Traits\TenantTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use TenantTrait;
    use HasFactory;

    protected $fillable =['name', 'url','price','description', 'image'];

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
}
