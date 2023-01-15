<?php

namespace App\Providers;

use App\Models\Config;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        view()->share('config',Config::findOrFail(1));
        Route::resourceVerbs([
            'create' => 'olustur',
            'edit' => 'guncelle',
            'update' => 'guncelle'
        ]);
    }
}
