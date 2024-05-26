<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Database\Eloquent\Builder;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Builder::macro('whereLike', function($column, $search) {
            /** @disregard */
            return $this->where($column, 'LIKE', "%{$search}%");
          });

        Blade::if('logueado', function () {
            return session()->has('cliente');
        });

        Blade::if('esadmin', function () {
            return session()->has('cliente') && session()->get('cliente')->es_admin;
        });
    }
}
