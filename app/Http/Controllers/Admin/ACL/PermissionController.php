<?php

namespace App\Http\Controllers\Admin\ACL;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdatePermissionRequest;
use App\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    protected $repository;
    public function __construct( Permission $permission)
    {
        $this->repository = $permission;
    }
    public function index()
    {
        $permissions = $this->repository->paginate();
        return view('admin.pages.permission.index', compact('permissions'));
    }

    public function create()
    {
        return view('admin.pages.permission.create');
    }
    public function store(StoreUpdatePermissionRequest $request)
    {
        $this->repository->create($request->all());

        return redirect()->route('permission_index');
    }

    public function edit($idPermission)
    {
        $permission = $this->repository->find($idPermission);

        return view('admin.pages.permission.edit', compact('permission'));
    }
    
    public function update(storeUpdatePermissionRequest $request ,$idPermission)
    {
        $permission = $this->repository->find($idPermission);

        if(!$permission)
            return redirect()-back();

        $permission->update($request->all());

        return redirect()->route('permission_index');
    }
    public function show($idPermission)
    {
        $permission = $this->repository->find($idPermission);
        if(!$permission)
            return redirect()-back();

        return view('admin.pages.permission.show', compact('permission'));
    }
    public function destroy($idPermission)
    {
        $permission = $this->repository->find($idPermission);
        if(!$permission)
            return redirect()-back();

        $permission->delete();

        return redirect()->route('permission_index');
    }
    public function search(Request $request)
    {
        
        $permissions = $this->repository->where( function ($query) use ($request) {
            if($request->filter){
                $query
                    ->where('name','LIKE', "%{$request->filter}%")
                    ->orWhere('description','LIKE', "%{$request->filter}%" );
            }
        })->paginate();

        $filters = $request->only('filter');

        return view('admin.pages.permission.index', [
            'permissions' => $permissions,
            'filters' => $filters
        ]);
    }
}
