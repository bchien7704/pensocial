<?php namespace Penst\Providers;

use View;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider {

    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function boot()
    {

        View::composer('backend.shared.layout', 'Penst\Composers\SettingComposer');
    }

    /**
     * Register
     *
     * @return void
     */
    public function register()
    {

    }

}