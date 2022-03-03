<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateCategory;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $category;
    public function __construct(Category $category)
    {
        $this->category = $category;
        $this->middleware(['can:categories']);
    }

    public function index()
    {
        $categories = $this->category->paginate();
        return view('admin.pages.categories.index', compact('categories'));
    }

    public function create()
    { 
        return view('admin.pages.categories.create');
    }

    public function store(StoreUpdateCategory $request)
    {
        $this->category->create($request->all());

        return redirect()->route('categories_index');
    }

    public function show($id)
    {
        if(!$category = $this->category->find($id))
            return redirect()->back();

        return view('admin.pages.categories.show', compact('category'));
    }

    public function destroy($id)
    {
        if(!$category = $this->category->find($id))
            return redirect()->back();

        $category->delete();

        $categories = $this->category->paginate();
        return view('admin.pages.categories.index', compact('categories'));
    }

    public function edit($id){

        if(!$category = $this->category->find($id))
            return redirect()->back();
        
        return view('admin.pages.categories.edit', compact('category'));
        
    }
    public function update(StoreUpdateCategory $request, $id)
    {
        if(!$category = $this->category->find($id))
            return redirect()->back();
        
        $category->update($request->all());

        $categories = $this->category->paginate();
        return view('admin.pages.categories.index', compact('categories'));
    }

    public function search(Request $request)
    {
        $categories = $this->category->where( function ($query) use ($request) {
            if($request->filter){
                $query
                    ->where('name','LIKE', "%{$request->filter}%")
                    ->orWhere('description','LIKE', "%{$request->filter}%");
            }
        })->latest()->paginate();

        $filters = $request->only('filter');

        return view('admin.pages.categories.index', ['categories' => $categories,'filters' => $filters]);
    }
}
