<?php

namespace App\Providers;

/**
* Parsedown Custom Service Provider
*/

use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\AliasLoader;

class ParsedownCustomServiceProvider extends \AlfredoRamos\ParsedownExtra\ParsedownExtraServiceProvider
{

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides() {
		return ['App\ParsedownCustom'];
	}
}