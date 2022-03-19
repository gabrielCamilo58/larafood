<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateTable;
use App\Models\Table;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class TableController extends Controller
{
    protected $repository;
    public function __construct(Table $table)
    {
        $this->repository = $table;
        $this->middleware(['can:tables']);
    }

    public function index()
    {
        $tables = $this->repository->paginate();
        return view('admin.pages.table.index', compact('tables'));
    }
    public function create()
    {
        return view('admin.pages.table.create');
    }
    public function store(StoreUpdateTable $request)
    {
        $this->repository->create($request->all());
        return redirect()->route('tables_index');
    }
    public function edit($id)
    {
        if(!$table = $this->repository->find($id))
            return redirect()->back();

        return view('admin.pages.table.edit', compact('table'));
    }
    public function update(StoreUpdateTable $request ,$id)
    {
        if(!$table = $this->repository->find($id))
            return redirect()->back();

        $table->update($request->all());
        $tables = $this->repository->paginate();

        return view('admin.pages.table.index', compact('tables'));
    }
    public function search(Request $request)
    {
        $tables = $this->repository->where(function ($querry) use($request)
        {
            if($request->filter){
                $querry->where('identify', 'LIKE', "%{$request->filter}%")
                        ->orWhere('description', 'LIKE', "%{$request->filter}%");
            }
        })->paginate();

        $filters = $request->only('filter');
        return view('admin.pages.table.index', compact('tables', 'filters'));
    }
    public function destroy($id)
    {
        if(!$table = $this->repository->find($id))
            return redirect()->back();
        
        $table->delete();

        return redirect()->route('tables_index');
    }
    public function show($id)
    {
        if(!$table = $this->repository->find($id))
            return redirect()->back();
        
        return view('admin.pages.table.show', compact('table'));
    }

    public function qrcode($identify)
    {
        if(!$table = $this->repository->where('identify', $identify)->first())
            return redirect()->back();
        
        $tenant = auth()->user()->tenant;

        $uri = env('URI_CLIENT') . "/{$tenant->uuid}/{$table->uuid}";
        
      
        return view('admin.pages.table.qrcode', compact('uri'));
    }
}
