<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Messages;
use App\Repositories\MessagesInterface;
use App\Repositories\CacheMessages;

class AppServiceProvider extends ServiceProvider
{
	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->app->bind(MessagesInterface::class, CacheMessages::class);
	}

	/**
	 * Register any application services.
	 *
	 * @return void
	 */
	public function register()
	{
		//
	}
}
