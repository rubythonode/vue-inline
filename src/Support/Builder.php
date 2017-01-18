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

use RuntimeException;
use Illuminate\Container\Container;
use Illuminate\Contracts\Config\Repository as Config;

class Builder
{
	/**
	 * It's the components class repository.
	 *
	 * @var string
	 */
	protected $repository = '';

	/**
	 * It's the required component name.
	 *
	 * @var string
	 */
	protected $component = '';

	/**
	 * Builds the given component repository.
	 *
     * @param  string $signature The component signature
     * @param  null|string|array $props The properties list to be pass to the component.
	 * @return array
	 */
	public static function build(string $signature, $props = null) : array
	{
		$builder = new static();

		list($builder->repository, $builder->component) = Parser::parse($signature);

		if (! $builder->isBuildable()) {
			throw new RuntimeException("The components repository (" . $builder->className() .") is not valid or does not exist.");
		}

		return $builder->create($props);
	}

	/**
	 * Checks whether the given component repository is a valid object.
	 *
	 * @param  string $repository
	 * @return boolean
	 */
	protected function isBuildable() : bool
	{
		return !! class_exists($this->className());
	}

	/**
	 * Creates a new repository and invoke the given component.
	 *
	 * @param  string|array $props
	 * @return array
	 */
	protected function create($props = null) : array
	{
		if ($this->componentDoesNotExist()) {
			throw new RuntimeException("
				The required component (" . $this->component . ")
				does not exist within the repository (" . $this->className() . ")
			");
		}

		return $this->buildRepository($props);
	}

	/**
	 * Checks whether the required component exist within the repository.
	 *
	 * @return bool
	 */
	protected function componentDoesNotExist() : bool
	{
		return ! method_exists($this->className(), $this->component);
	}

	/**
	 * Returns the repository name.
	 *
	 * @return string
	 */
	protected function className() : string
	{
		$config = Container::getInstance()->make('config');

		//We get components namespace.
		$namespace = $config->get('vueinline.namespace');

		return $namespace . ucfirst(strtolower($this->repository));
	}

	/**
	 * Builds a new repository with a given props.
	 *
	 * @param  null|string|array $props The properties list to be pass to the component.
	 * @return array
	 */
	protected function buildRepository($props = null) : array
	{
		//Example component signature (users:profile)

		//The component asked for. In this case, component is equal to "profile".
		$component = $this->component;

		//The components repository. In this case, component is equal to "users"
		//which would be the class where the components body are.
		$className = $this->className();

		//Creates the component repository. In this case, repository is equal to "Namespace\Users".
		$repository = new $className($this->repository, $component, Parser::parseProps($props));

		//Returns the component information. In this case, component is equal to "profile".
		return $repository->$component();
	}
}