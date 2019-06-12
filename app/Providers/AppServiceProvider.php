<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('path.public', function(){
            return base_path('public_html');
        });

        if ($this->app->environment() !== 'production') {
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
        }

        $this->app->bind('App\Repositories\Contracts\IUser', 'App\Repositories\UserRepo');
        $this->app->bind('App\Repositories\Contracts\IProcedureType', 'App\Repositories\ProcedureTypeRepo');
        $this->app->bind('App\Repositories\Contracts\IRole', 'App\Repositories\RoleRepo');
        $this->app->bind('App\Repositories\Contracts\IProcedure', 'App\Repositories\ProcedureRepo');
        $this->app->bind('App\Repositories\Contracts\IStep', 'App\Repositories\StepRepo');
        $this->app->bind('App\Repositories\Contracts\IStepList', 'App\Repositories\StepListRepo');
        $this->app->bind('App\Repositories\Contracts\ITypeAccount', 'App\Repositories\TypeAccountRepo');
        $this->app->bind('App\Repositories\Contracts\IPosition', 'App\Repositories\PositionRepo');
        $this->app->bind('App\Repositories\Contracts\IOrganisation', 'App\Repositories\OrganisationRepo');
        $this->app->bind('App\Repositories\Contracts\ILog', 'App\Repositories\LogRepo');

    }
}
