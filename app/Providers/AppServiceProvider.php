<?php

namespace App\Providers;

use App\Listeners\DeductProductionQuantity;
use App\Listeners\EmptyCart;
use App\Models\Category;
use App\Services\CurrencyConverter;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind('currency.converter', function () {
            return new CurrencyConverter(config('services.currency_converter.api_key'));
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
       $categories = Category::all();
       view()->share('categories', $categories);

       Event::listen(EmptyCart::class,DeductProductionQuantity::class);

    }
}
