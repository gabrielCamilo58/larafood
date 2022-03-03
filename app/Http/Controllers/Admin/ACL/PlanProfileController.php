<?php

namespace App\Http\Controllers\Admin\ACL;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use App\Models\Profile;
use Illuminate\Http\Request;

class PlanProfileController extends Controller
{
    protected $profile, $plan;

    public function __construct(Profile $profile, Plan $plan)
    {
        $this->profile = $profile;
        $this->plan = $plan;
        $this->middleware(['can:plans']);
    }
    public function plan($idProfile)
    {
        $profile = $this->profile->find($idProfile);
        if(!$profile)
            return redirect()->back();
        
        $plans = $profile->plans()->paginate();

        return view('admin.pages.profiles.plan.plan', compact('plans', 'profile'));
    }

    public function planAvailable(Request $request ,$idProfile)
    {
        $profile = $this->profile->find($idProfile);
        
        $filters = $request->except('_token');

        $plans = $profile->plansAvailable($request->filter);

        return view('admin.pages.profiles.plan.available', compact('plans', 'profile', 'filters'));
    }

    public function attach(Request $request, $idProfile)
    {
        if(!$profile = $this->profile->find($idProfile)) return redirect()->back();
        
        if(!$request->plans || count($request->plans) == 0) return redirect()->back()->with('info', 'Precisa escolher pelo menos um plano');

        $profile->plans()->attach($request->plans);

        return redirect()->route('plan_profile', $profile->id);
    }

    public function detach($idProfile, $idPlan)
    {
        $profile = $this->profile->find($idProfile);
        $plan = $this->plan->find($idPlan);

        $profile->plans()->detach($plan);

        return redirect()->back();
    }

    public function profiles($idPlan)
    {
        $plan = $this->plan->find($idPlan);

        $profiles = $plan->profiles()->paginate();

        return view('admin.pages.plans.profile',compact('plan', 'profiles'));
    }

    public function searchProfilePlan(Request $request, $idProfile)
    {
        $profile = $this->profile->find($idProfile);
        $filters = $request->except('_token');

        $plans = $profile->search($request->filter);

        return view('admin.pages.profiles.plan.plan', compact('profile', 'plans', 'filters'));
    }

}
