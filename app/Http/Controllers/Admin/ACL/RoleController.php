<?php

namespace App\Http\Controllers\Admin\ACL;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateRole;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    protected $repository;
    public function __construct( Role $role)
    {
        $this->repository = $role;
        $this->middleware(['can:roles']);
    }
    public function index()
    {
        $roles = $this->repository->paginate();
        return view('admin.pages.roles.index', compact('roles'));
    }

    public function create()
    {
        return view('admin.pages.roles.create');
    }
    public function store(StoreUpdateRole $request)
    {
        $this->repository->create($request->all());

        return redirect()->route('roles_index');
    }

    public function edit($idRole)
    {
        $role = $this->repository->find($idRole);

        return view('admin.pages.roles.edit', compact('role'));
    }
    
    public function update(StoreUpdateRole $request ,$idRole)
    {
        $role = $this->repository->find($idRole);

        if(!$role)
            return redirect()-back();

        $role->update($request->all());

        return redirect()->route('roles_index');
    }
    public function show($idrole)
    {
        $role = $this->repository->find($idrole);
        if(!$role)
            return redirect()-back();

        return view('admin.pages.roles.show', compact('role'));
    }
    public function destroy($idrole)
    {
        $role = $this->repository->find($idrole);
        if(!$role)
            return redirect()-back();

        $role->delete();

        return redirect()->route('roles_index');
    }
    public function search(Request $request)
    {
        
        $roles = $this->repository->where( function ($query) use ($request) {
            if($request->filter){
                $query
                    ->where('name','LIKE', "%{$request->filter}%")
                    ->orWhere('description','LIKE', "%{$request->filter}%" );
            }
        })->paginate();

        $filters = $request->only('filter');

        return view('admin.pages.roles.index', [
            'roles' => $roles,
            'filters' => $filters
        ]);
    }
}
