<?php namespace Wegnermedia\Eventer;

use Illuminate\Support\ServiceProvider;

use Config, Event;

class EventerServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->package('wegnermedia/eventer');
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		// Register Event Listeners
		foreach ($this->getHandlers() as $handler)
		{
			$this->listen($handler);
		}
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array();
	}

	/**
	 * Get List of Qualified Handlers
	 *
	 * @return array
	 **/
	protected function getHandlers()
	{
		return Config::get('Eventer::handlers', []);
	}

	/**
	 * Listen for an Event
	 *
	 * @return void
	 **/
	protected function listen($handler)
	{
		if ( class_exists($handler) )
		{
			Event::listen('*', $handler);
		}
	}

}
