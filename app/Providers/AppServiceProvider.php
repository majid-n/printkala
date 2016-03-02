<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Basket;
use Sentinel;
use Blade;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::extend(function($value) {
            return preg_replace('/\@define(.+)/', '<?php ${1}; ?>', $value);
        });

        if ( $user = Sentinel::check() ) {
            $num = $user->baskets->where('order_id', 0)->count();
            view()->share([ 'num'=> $num ]);
        }
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
