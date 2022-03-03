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

     /**
      * Product category search
      */

      public function search($filter = null)
      {
        $category = $this->categories()->where('categories.name', 'LIKE', "%{$filter}%")->orWhere('categories.description', 'LIKE', "%{$filter}%")->paginate();

        return $category;
      }

      public function categoriesAvailable($filter = null)
     {
        $categories = Category::whereNotIn('id', function ($querry){
            $querry->select('category_product.category_id');
            $querry->from('category_product');
            $querry->whereRaw("category_product.product_id={$this->id}");
        })->where(function ($querryFilter) use($filter){
            if($filter)
            $querryFilter->where('categories.name', 'LIKE', "%{$filter}%");
        })->paginate();

        return $categories;
     }
}
