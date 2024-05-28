<?php

namespace App\Providers;

use App\Http\View\Composers\MenuComposer;
use App\Http\View\Composers\CartComposer;
use Illuminate\Support\ServiceProvider;
//use Illuminate\View\View;
use Illuminate\Support\Facades\View;



class ViewServiceProvider extends ServiceProvider
{

    public function register()
    {

    }

    public function boot()
    {
        View::composer('header', MenuComposer::class);
        View::composer('cart', CartComposer::class);
    }
}
