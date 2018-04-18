<?php
namespace Vumasms\Laravel\Providers;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use Vumasms\VumaSMS;
/**
* 
*/
class ServiceProvider extends BaseServiceProvider
{
	protected $namespace='Vumasms\\Laravel\\Controllers\\';
	/**
	 * Perform post-registration booting of services.
	 *
	 * @return void
	 */
	public function boot()
	{
        $configPath = __DIR__.'/config/config.php';
	      $this->publishes([$configPath => config_path('vumasms.php')]);
        $this->mapApiRoutes();
	}
    protected function mapApiRoutes()
    {
      $this->app['router']->any('vumasms/callback', $this->namespace.'Callback@act');
    }

	 /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {
      	$configPath =__DIR__.'/config/config.php';
        $this->mergeConfigFrom($configPath, 'vumasms');    	
    	
        $this->app->singleton("vumasms", function ($app){        	
            return new VumaSMS(config("vumasms.api.key"),config("vumasms.api.secret"));
        });
    }
}