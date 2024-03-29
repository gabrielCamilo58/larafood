<?php

namespace App\Providers;

use App\Repositories\CategoryRepository;
use App\Repositories\ClientRepository;
use App\Repositories\Contracts\CategoryRepositoryInterface;
use App\Repositories\Contracts\ClientRepositoryInterface;
use App\Repositories\Contracts\EvaluationRepositoryInterface as ContractsEvaluationRepositoryInterface;
use App\Repositories\Contracts\OrderRepositoryInterface;
use App\Repositories\Contracts\ProductsRepositoryInterface;
use App\Repositories\Contracts\TableRepositoryInterface;
use App\Repositories\Contracts\TenantRepositoryInterface;
use App\Repositories\EvaluationRepository;
use App\Repositories\EvaluationRepositoryInterface;
use App\Repositories\OrderRepository;
use App\Repositories\ProductsRepository;
use App\Repositories\TableRepository;
use App\Repositories\TenantRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            TenantRepositoryInterface::class,
            TenantRepository::class
        );

        $this->app->bind(
            CategoryRepositoryInterface::class,
            CategoryRepository::class
        );

        $this->app->bind(
            TableRepositoryInterface::class,
            TableRepository::class,
        );
        $this->app->bind(
            ProductsRepositoryInterface::class,
            ProductsRepository::class,
        );
        $this->app->bind(
            ClientRepositoryInterface::class,
            ClientRepository::class,
        );
        $this->app->bind(
            OrderRepositoryInterface::class,
            OrderRepository::class,
        );

        $this->app->bind(
            ContractsEvaluationRepositoryInterface::class,
            EvaluationRepository::class,

        );

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
