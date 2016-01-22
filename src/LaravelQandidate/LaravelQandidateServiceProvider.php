<?php namespace AM2Studio\LaravelQandidate;

use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\Router;

class LaravelQandidateServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

     /**
      * Perform post-registration booting of services.
      */
     public function boot()
     {
         if (is_dir(base_path().'/resources/views/packages/am2studio/qandidate')) {
             $this->loadViewsFrom(
                base_path() . '/resources/views/packages/am2studio/qandidate',
                'qandidate'
            );
         } else {
             $this->loadViewsFrom(
                __DIR__ . '/../views/qandidate',
                'qandidate'
            );
         }
         $this->mergeConfigFrom(
            __DIR__.'/../config/qandidate.php',
            'qandidate'
        );

         if (config('qandidate.defaultRoutes')) {
             $this->setupRoutes($this->app->router);
         }

         $this->publishes([
            __DIR__.'/../database/migrations/' => database_path(
                'migrations'
            )
        ], 'migrations');

         $this->publishes([
             __DIR__.'/../config/qandidate.php' => config_path(
                'qandidate.php'
            )
        ], 'config');

         $this->publishes([
            __DIR__.'/../views/qandidate' => base_path(
                'resources/views/packages/am2studio/qandidate'
            )
        ], 'views');
     }

    /**
     * Define the routes for the application.
     *
     * @param \Illuminate\Routing\Router $router
     */
    public function setupRoutes(Router $router)
    {
        $router->group([
            'namespace' => 'AM2Studio\LaravelQandidate\Http\Controllers'],
            function ($router) {
                require __DIR__.'/Http/routes.php';
            }
        );
    }

    /**
     * Register any package services.
     */
    public function register()
    {
        $this->app->register('Collective\Html\HtmlServiceProvider');
        $loader = \Illuminate\Foundation\AliasLoader::getInstance();
        $loader->alias('Form', 'Collective\Html\FormFacade');

        $this->app->bind('qandidate', function ($app) {
            return new Qandidate($app);
        });

    }
}
