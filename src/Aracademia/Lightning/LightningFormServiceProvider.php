<?php
/**
 * User: rrafia
 * Date: 7/23/14
 */

namespace Aracademia\Lightning;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;

class LightningFormServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	public function boot()
    {
        $this->package('Aracademia/Lightning');
        AliasLoader::getInstance()->alias('Lightning', 'Aracademia\Lightning\LightningFormBuilder');
    }

    /**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		//
	}

}
