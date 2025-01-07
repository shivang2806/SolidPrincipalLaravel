<?php

namespace App\Providers;

use App\Interfaces\ProductInterface;
use App\Interfaces\UserInterface;
use App\Repositories\ProductRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(UserInterface::class, UserRepository::class);
        $this->app->bind(ProductInterface::class, ProductRepository::class);
    }

    public function boot()
    {
        //
    }
}
