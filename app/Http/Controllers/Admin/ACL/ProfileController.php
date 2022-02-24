<?php

namespace App\Http\Controllers\Admin\ACL;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateProfileRequest;
use App\Models\Profile; 
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    protected $repository;
    public function __construct( Profile $profile)
    {
        $this->repository = $profile;
    }
    public function index()
    {
        $profiles = $this->repository->paginate();
        return view('admin.pages.profiles.index', compact('profiles'));
    }

    public function create()
    {
        return view('admin.pages.profiles.create');
    }
    public function store(StoreUpdateProfileRequest $request)
    {
        $this->repository->create($request->all());

        return redirect()->route('profiles_index');
    }

    public function edit($idProfile)
    {
        $profile = $this->repository->find($idProfile);

        return view('admin.pages.profiles.edit', compact('profile'));
    }
    
    public function update(StoreUpdateProfileRequest $request ,$idProfile)
    {
        $profile = $this->repository->find($idProfile);

        if(!$profile)
            return redirect()-back();

        $profile->update($request->all());

        return redirect()->route('profiles_index');
    }
    public function show($idProfile)
    {
        $profile = $this->repository->find($idProfile);
        if(!$profile)
            return redirect()-back();

        return view('admin.pages.profiles.show', compact('profile'));
    }
    public function destroy($idProfile)
    {
        $profile = $this->repository->find($idProfile);
        if(!$profile)
            return redirect()-back();

        $profile->delete();

        return redirect()->route('profiles_index');
    }
    public function search(Request $request)
    {
        
        $profiles = $this->repository->where( function ($query) use ($request) {
            if($request->filter){
                $query
                    ->where('name','LIKE', "%{$request->filter}%")
                    ->orWhere('description','LIKE', "%{$request->filter}%" );
            }
        })->paginate();

        $filters = $request->only('filter');

        return view('admin.pages.profiles.index', [
            'profiles' => $profiles,
            'filters' => $filters
        ]);
    }
}
