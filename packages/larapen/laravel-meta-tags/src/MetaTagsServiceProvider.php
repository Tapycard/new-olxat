<?php

namespace Larapen\LaravelMetaTags;

use Illuminate\Support\ServiceProvider;

class MetaTagsServiceProvider extends ServiceProvider
{
	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = true;
	
	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot(): void
	{
		$this->publishes([__DIR__ . '/config/config.php' => config_path('meta-tags.php')]);
	}
	
	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register(): void
	{
		$this->app->singleton('metatag', function ($app) {
			return new MetaTag(
				$app['request'],
				$app['config']['meta-tags'],
				$app['config']->get('app.locale')
			);
		});
	}
	
	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides(): array
	{
		return ['metatag'];
	}
}
