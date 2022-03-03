<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateUser;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $user;
    public function __construct(User $user)
    {
        $this->user = $user;
        $this->middleware(['can:users']);
    }

    public function index()
    {
        $users = $this->user->tenantFilter()->paginate();
        return view('admin.pages.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.pages.users.create');
    }
    public function store(StoreUpdateUser $request)
    {
        
        $tenant = auth()->user()->tenant;
        $data = $request->all();
        $data['tenant_id'] = $tenant->id;
        $data['password'] = bcrypt($data['password']); //encriptografar a senha

        

        $this->user->create($data);

        return redirect()->route('users_index');
    }

    public function edit($iduser)
    {
        $user = $this->user->tenantFilter()->find($iduser);

        return view('admin.pages.users.edit', compact('user'));
    }
    
    public function update(StoreUpdateUser $request ,$iduser)
    {
        $user = $this->user->tenantFilter()->find($iduser);

        if(!$user)
            return redirect()-back();

        $data = $request->only(['name', 'email']);

        if($request->password)
            $data['password'] = bcrypt($request->password);
            
        $user->update($data);
        return redirect()->route('users_index');
    }
    public function show($iduser)
    {
        $user = $this->user->tenantFilter()->find($iduser);
        if(!$user)
            return redirect()-back();

        return view('admin.pages.users.show', compact('user'));
    }
    public function destroy($iduser)
    {
        $user = $this->user->tenantFilter()->find($iduser);
        if(!$user)
            return redirect()-back();

        $user->delete();

        return redirect()->route('users_index');
    }
    public function search(Request $request)
    {
        
        $users = $this->user->where( function ($query) use ($request) {
            if($request->filter){
                $query
                    ->where('name','LIKE', "%{$request->filter}%")
                    ->orWhere('email', $request->filter);
            }
        })->latest()->tenantFilter()->paginate();

        $filters = $request->only('filter');

        return view('admin.pages.users.index', ['users' => $users,'filters' => $filters]);
    }

}
