<?php

namespace CodeDelivery\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'CodeDelivery\Repositories\CategoriaRepository',
            'CodeDelivery\Repositories\CategoriaRepositoryEloquent'
        );
        
        $this->app->bind(
            'CodeDelivery\Repositories\ProdutosRepository',
            'CodeDelivery\Repositories\ProdutosRepositoryEloquent'
        );

        $this->app->bind(
            'CodeDelivery\Repositories\ClienteRepository',
            'CodeDelivery\Repositories\ClienteRepositoryEloquent'
        );

        $this->app->bind(
            'CodeDelivery\Repositories\UserRepository',
            'CodeDelivery\Repositories\UserRepositoryEloquent'
        );
    }
}
