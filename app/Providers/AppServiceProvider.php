<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Models\Blog;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Product;
use App\Models\Visitor;
use Carbon\Carbon;
use Illuminate\Http\Request;

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
        Schema::defaultStringLength(191);

            view()->composer('*',function($view){
                $customerAll = Customer::all()->count();
                $orderAll = Order::all()->count();
                $productAll = Product::all()->count();
                $blogAll = Blog::all()->count();
                $view->with(compact('customerAll','orderAll','productAll','blogAll'));
            });
    }
}
