<?php

namespace ATOZ\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

use ATOZ\OrderDetail;

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
        Validator::extend('prefix', function($attribute, $value, $parameters)
        {
            return substr($value, 0, 3) == '081';
        });

        
        $count_unpaid = OrderDetail::where('status', config('global.STATUS_WAITING'))->count();
        View::share(compact('count_unpaid'));
    }
}
