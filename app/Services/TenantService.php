<?php

namespace App\Services;

use App\Models\Plan;
use App\Repositories\Contracts\TenantRepositoryInterface;
use Illuminate\Support\Arr;
class TenantService
{

    private $data, $plan;
    private $repository;

    public function __construct(TenantRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function getAllTenant($perPage)
    {
        return $this->repository->getAllTenants($perPage);
    }

    public function getTenantByUuid(string $uuid)
    {
        return $this->repository->getTenantByUuid($uuid);
    }

    public function make(Plan $plan, array $data)
    {
        $this->plan = $plan;
        $this->data = $data;

        $tenant = $this->crateTenant();

        $user = $this->createUser($tenant);

        return $user;
    }

    public function crateTenant()
    {
        return $this->plan->tenants()->create([
            'cnpj' => $this->data['cnpj'],
            'name' => $this->data['empresa'],
            'email' => $this->data['email'],

            'subscription' => now(),
            'expires_at' => now()->addDays(7),
            'subscription_id' => now(),
            'subscription' => now(),
            'subscription' => now(),
        ]);
    }

    public function createUser($tenant)
    {
        return $tenant->users()->create([
            'name' => $this->data['name'],
            'email' => $this->data['email'],
            'password' => bcrypt($this->data['password']),
        ]);
    }
}
