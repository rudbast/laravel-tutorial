<?php

namespace App\Providers;

use App\Article;
use Illuminate\Support\ServiceProvider;

class ViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->composeNavigation();
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Load latest article into each view
     *
     * @return void
     */
    public function composeNavigation()
    {
        view()->composer('partials.nav', function($view) {
            $view->with('latest', Article::latest()->first());
        });
    }
}
