<?php

namespace Tests\Feature;

use App\Models\Plan;
use App\Models\Product;
use App\Models\Tenant;
use Faker\Factory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;


class TenantTest extends TestCase
{
    
    /**
     * Test Get All Tenants
     *
     * @return void
     */
    public function testGetAllTenants()
    {
    
        Tenant::factory()->create();
        
        

        $response = $this->getJson('/api/v1/tenants');
        $response->dump();

        $response->assertStatus(200);
    }

     /**
     * Test Get Error Single Tenant
     *
     * @return void
     */
    public function testErrorGetTenants()
    {
        $tenant = 'fake value';

        $response = $this->getJson("/api/v1/tenants/{$tenant}");
        $response->dump();

        $response->assertStatus(404);
    }
    /**
     * Test Get Single Tenant
     *
     * @return void
     */
    public function testGetTenants()
    {
        $tenant = Tenant::factory()->create();

        $response = $this->getJson("/api/v1/tenants/{$tenant->uuid}");
        $response->dump();

        $response->assertStatus(200);
    }


}
