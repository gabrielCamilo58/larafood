<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateProduct;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    protected $product;
    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function index()
    {
        $products = $this->product->paginate();
        return view('admin.pages.products.index', compact('products'));
    }

    public function create()
    {
        return view('admin.pages.products.create');
    }

    public function store(StoreUpdateProduct $request)
    {
        $data = $request->all();
        $tenant = auth()->user()->tenant;
        if ($request->hasFile('image') && $request->image->isValid()){
            $data['image'] = $request->image->store("tenants/{$tenant->uuid}/products");
        }

        $this->product->create($data);

        return redirect()->route('products_index');
    }

    public function show($id)
    {
        if(!$product = $this->product->find($id))
            return redirect()->back();

        return view('admin.pages.products.show', compact('product'));
    }

    public function destroy($id)
    {
        if(!$product = $this->product->find($id))
            return redirect()->back();

        if(Storage::exists($product->image))
            Storage::delete($product->image);
            
        $product->delete();

        $products = $this->product->paginate();
        return view('admin.pages.products.index', compact('products'));
    }

    public function edit($id){

        if(!$product = $this->product->find($id))
            return redirect()->back();
        
        return view('admin.pages.products.edit', compact('product'));
        
    }
    public function update(StoreUpdateProduct $request, $id)
    {
        if(!$product = $this->product->find($id))
            return redirect()->back();
        
        $data = $request->all();

        $tenant = auth()->user()->tenant;

        if ($request->hasFile('image') && $request->image->isValid()){
            $data['image'] = $request->image->store("tenants/{$tenant->uuid}/products");
        }
        
        if(Storage::exists($product->image))
            Storage::delete($product->image);

        $product->update($data);

        $products = $this->product->paginate();
        return view('admin.pages.products.index', compact('products'));
    }

    public function search(Request $request)
    {
        $products = $this->product->where( function ($query) use ($request) {
            if($request->filter){
                $query
                    ->where('name','LIKE', "%{$request->filter}%")
                    ->orWhere('description','LIKE', "%{$request->filter}%");
            }
        })->latest()->paginate();

        $filters = $request->only('filter');

        return view('admin.pages.products.index', ['products' => $products,'filters' => $filters]);
    }
}
