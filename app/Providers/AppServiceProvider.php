<?php

namespace App\Providers;

use App\Models\Category;

use Illuminate\Support\ServiceProvider;
use View;


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
        View::composer('frontend.partial.category',function ($view){
            $view->with('categories', Category::where('status', 1)->get() );
        });

        View::composer('frontend.partial.header',function ($header){
            $header->with('header_categories', Category::where('publication_status', 1)->get() );
        });

//        View::composer('frontend.partial.carousal',function ($carousal){
//            $carousal->with('carousals', Slider::where('publication_status', 1)->get() );
//        });


        View::composer('frontend.partial.header',function ($logo){
            $logo->with('logos', Logo::where('publication_status', 1)->get() );
        });
    }
}
