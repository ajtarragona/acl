<?php

namespace Ajtarragona\ACL;

use Illuminate\Support\ServiceProvider;
use Ajtarragona\ACL\Commands\SetupAcl;

class ACLServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->bootConfig();

        //vistas
        $this->loadViewsFrom(__DIR__.'/resources/views', 'acl');
        
        $this->loadRoutesFrom(__DIR__.'/routes.php');

         //idiomas
        $this->loadTranslationsFrom(__DIR__.'/resources/lang', 'acl');

        $this->registerCommands();


    }

    /**
     * Defines the boot configuration
     *
     * @return void
     */
    protected function bootConfig()
    {   
        $base = __DIR__.'/Config/';
        $publish=[];

        foreach(['acl','acl_seed'] as $name){
            $path = $base.$name.'.php';
            $this->mergeConfigFrom($path, $name);
            $publish[$path]=config_path($name.'.php');
        }
               
        $this->publishes($publish,'ajtarragona-acl');
       
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

    public function registerCommands()
    {
        
        if ($this->app->runningInConsole()) {
            $this->commands([
                SetupAcl::class,
            ]);
        }
    }
}
