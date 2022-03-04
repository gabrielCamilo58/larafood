<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateTenant;
use App\Models\Tenant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TenantsController extends Controller
{ 
    protected $repository;
    public function __construct(Tenant $tenant)
    {
        $this->repository = $tenant;
        $this->middleware(['can:tenants']);
    }
    public function index()
    {
        $tenants = $this->repository->paginate();
        return view ('admin.pages.tenants.index', compact('tenants'));
    }
    public function create() 
    {
        return view('admin.pages.tenants.create');
    }
    public function store(StoreUpdateTenant $request)
    {
    
        $data = $request->all();
        $tenant = auth()->user()->tenant;

        if($request->hasFile('image') && $request->image->isValid()){
            $data['logo'] = $request->image->store("tenants/{$tenant->uuid}");
        }
        
        $this->repository->create($data);

        return redirect()->route('tenants_index');
    }
    public function destroy($idTenant)
    {

        if(!$tenant = $this->repository->find($idTenant))
            return redirect()->back();

        if(Storage::exists($tenant->logo))
            Storage::delete($tenant->logo);

        $tenant->delete();

        return redirect()->route('tenants_index');
    }
    public function update(StoreUpdateTenant $request ,$idTenant)
    {
        if(!$tenant = $this->repository->find($idTenant))
            return redirect()->back();

        $data = $request->all();
        $userTenant = auth()->user()->tenant;

        if($request->hasFile('image') && $request->image->isValid())
            $data['logo'] = $request->image->store("tenants/{$userTenant->uuid}");
        

        if(Storage::exists($tenant->logo))
            Storage::delete($tenant->logo);

        $tenant->update($data);
        return redirect()->route('tenants_index');
       
    }
    public function edit($idTenant)
    {
        
        if(!$tenant = $this->repository->find($idTenant))
            return redirect()->back();

        return view('admin.pages.tenants.edit', compact('tenant'));
    }
    public function show($idTenant)
    {

        if(!$tenant = $this->repository->with('plan')->find($idTenant))
            return redirect()->back();

        return view('admin.pages.tenants.show', compact('tenant'));

    }
    public function search(Request $request)
    {
        $filters = $request->only('filter');
        $tenants = $this->repository->where( function ($query) use($request){
            if($request->filter){
                $query->where('name', $request->filter);
            }
        })->latest()->paginate();
    
        return view('admin.pages.tenants.index', compact('tenants', 'filters'));
    }

}
