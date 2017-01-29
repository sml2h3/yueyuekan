<?php
/**
 * Created by PhpStorm.
 * User: wenanzhe
 * Date: 17/1/21
 * Time: 02:22
 */

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AdminServiceProvider extends ServiceProvider
{
    public function boot(){
        view()->composer(
            'layouts.admin', 'App\Http\Controllers\Admin\SliderController'
        );
    }

    public function register()
    {
        //
    }
}