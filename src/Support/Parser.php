<?php

/*
 * This file is part of the VueInline package.
 *
 * (c) Gustavo Ocanto <gustavoocanto@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gocanto\VueInline\Support;

use Lang;
use InvalidArgumentException;
use Illuminate\Support\Collection;

class Parser
{
	/**
	 * Parse the component signature.
	 *
	 * @param  string $expression
	 * @return array
	 */
	public static function parse($expression) : array
	{
		if (trim($expression) === '') {
            throw new InvalidArgumentException('Component signature is empty.');
        }

        if (strpos($expression, ':') === false) {
            throw new InvalidArgumentException('The component signature has to contain a colon. For example "factory:identifier"');
        }

        return explode(':', $expression);
	}

	/**
	 * Parse the component props.
	 *
	 * @param  null|string|array $props
	 * @return array
	 */
	public static function parseProps($props) : Collection
	{
		if (is_array($props)) {
			return new Collection ($props);
		}

		if (is_string($props)) {
			return new Collection ([$props]);
		}

		return new Collection ();
	}

	/**
	 * Parse the component translations.
	 *
	 * @param  string $repository
	 * @param  string $component
	 * @return Collection
	 */
	public static function parseTrans($repository, $component = '') : Collection
	{
		$key = $repository . (trim($component) == '' ? '' : '.' . $component);

		if (! Lang::has($key)) {
			return new Collection();
		}

		return new Collection(Lang::get($key));
	}
}