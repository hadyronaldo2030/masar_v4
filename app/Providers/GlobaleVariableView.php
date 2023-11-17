<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class GlobaleVariableView extends ServiceProvider
{
    public function boot()
    {
        // $globalVariable = '/public/';
        $globalVariable = '';

        View::composer('*', function ($view) use ($globalVariable) {
            $view->with('globalVariable', $globalVariable);
        });
    }

    public function register()
    {
        //
    }
}
