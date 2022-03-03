<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryProductController extends Controller
{
    protected $category, $product;
    public function __construct(Category $category, Product $product)
    {
        $this->category = $category;
        $this->product = $product;
        $this->middleware(['can:products']);
    }
    public function categories($idProduct)
    {
        $product = $this->product->find($idProduct);
        if(!$product)
            return redirect()->back()->withErrors('Produto não encontrado');
        
        $categories = $product->categories()->paginate();

        return view('admin.pages.products.category.category', compact('categories', 'product'));
    }

    public function categoryAvailable(Request $request ,$idproduct)
    {
        $product = $this->product->find($idproduct);
        
        $filters = $request->except('_token');

        $categories = $product->categoriesAvailable($request->filter);

        return view('admin.pages.products.category.available', compact('categories', 'product', 'filters'));
    }

    public function attach(Request $request, $idproduct)
    {
        if(!$product = $this->product->find($idproduct)) return redirect()->back();
        
        if(!$request->categories || count($request->categories) == 0) return redirect()->back()->with('info', 'Precisa escolher pelo menos um categoryo');

        $product->categories()->attach($request->categories);

        return redirect()->route('category_product', $product->id);
    }

    public function detach($idproduct, $idcategory)
    {
        $product = $this->product->find($idproduct);
        $category = $this->category->find($idcategory);

        $product->categories()->detach($category);

        return redirect()->back();
    }

    public function products($idcategory)
    {
        $category = $this->category->find($idcategory);

        $products = $category->products()->paginate();

        return view('admin.pages.categories.product',compact('category', 'products'));
    }

    public function searchCategoryProduct(Request $request, $idproduct)
    {
        $product = $this->product->find($idproduct);
        $filters = $request->except('_token');

        $categories = $product->search($request->filter);

        return view('admin.pages.products.category.category', compact('product', 'categories', 'filters'));
    }
}
