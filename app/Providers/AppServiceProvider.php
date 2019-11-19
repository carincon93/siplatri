<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;

use App\Trimestre;

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

      Route::resourceVerbs([
          'create'  => 'crear',
          'edit'    => 'editar',
      ]);

      // Using Closure based composers...
      View::composer('layouts.app', function ($view) {
          $view->with('trimestreActivo', Trimestre::where('activo', true)->first())->with('trimestreEnProgramacion', Trimestre::where('programando', true)->first());
      });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
