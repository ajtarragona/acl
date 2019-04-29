<?php

namespace Ajtarragona\ACL;

use Illuminate\Support\ServiceProvider;

class ACLServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //vistas
        $this->loadViewsFrom(__DIR__.'/resources/views', 'acl');
        
        $this->loadRoutesFrom(__DIR__.'/routes.php');

         //idiomas
        $this->loadTranslationsFrom(__DIR__.'/resources/lang', 'acl');


        $this->bootConfig();


    }

    /**
     * Defines the boot configuration
     *
     * @return void
     */
    protected function bootConfig()
    {   
        $path = __DIR__.'/Config/acl.php';
       
        $this->mergeConfigFrom($path, 'acl');
        
        $this->publishes([
            $path => config_path('acl.php')
        ],'ajtarragona-acl');
        
    }


    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        
                
        //helpers
        foreach (glob(__DIR__.'/Helpers/*.php') as $filename){
            require_once($filename);
        }
    }
}
