<?php

namespace App\Providers;

use App\User;
use App\Category;
use App\Wishlist;
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
        $this->app->singleton('\Braintree\Gateway', function () {
            return new \Braintree\Gateway([
                'environment' => config('services.braintree.environment'),
                'merchantId' => config('services.braintree.merchantId'),
                'publicKey' => config('services.braintree.publicKey'),
                'privateKey' => config('services.braintree.privateKey')
            ]);
        });

        $this->app->singleton('App\User', function () {
            return User::where('email', '=', config('e-commerce.administrators'))
                ->first();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        \View::composer('*', function ($view) {
            $categories = \Cache::rememberForever('categories', function () {
                return Category::all();
            });

            $view->with('categories', $categories);
        });

        \View::composer('partials.header', function ($view) {
            $view->with('cartCount', \Cart::getContent()->count());
            $view->with('wishlistCount', Wishlist::count());
        });
    }
}
