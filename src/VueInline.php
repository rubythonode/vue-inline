<?php

/*
 * This file is part of the VueInline package.
 *
 * (c) Gustavo Ocanto <gustavoocanto@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gocanto\VueInline;

use Illuminate\Support\Collection;
use Illuminate\Container\Container;
use Gocanto\VueInline\Support\Parser;

abstract class VueInline
{
	/**
	 * It's the components class repository.
	 *
	 * @var string
	 */
	protected $repository = '';

	/**
	 * The component name.
	 *
	 * @var string
	 */
	protected $component = '';

	/**
	 * The component props stack.
	 *
	 * @var array
	 */
	protected $data = [];

	/**
	 * The trans to be passed down to the component.
	 *
	 * @var null
	 */
	protected $trans = null;

	/**
	 * The component model.
	 *
	 * @var mixed
	 */
	protected $props = null;

	/**
	 * Creates a new component instance.
	 *
	 * @param string $repository
	 * @param string $component
     * @param  null|string|array $props The properties list to be pass to the component.
     * @return void
	 */
	public function __construct($repository, $component, $props = null)
	{
		$this->props = $props;
		$this->component = $component;
		$this->repository = $repository;
		$this->trans = Parser::parseTrans($repository, $component);
	}

	/**
	 * Assign the component tag name.
	 *
	 * @return self
	 */
	protected function tagName(string $is = '')
	{
		$this->data['is'] = trim($is) == '' ? $this->component : $is;

		return $this;
	}

	/**
	 * Stacks the alerts trans to the data array.
	 *
	 * @return self
	 */
	protected function withAlerts()
	{
		if ($this->trans->has('alerts')) {
			$this->data['messages']['alerts'] = $this->trans->get('alerts');
		}

		return $this;
	}

	/**
	 * Stacks the errors trans to the data array.
	 *
	 * @return self
	 */
	protected function withErrors()
	{
		if ($this->trans->has('errors')) {
			$this->data['messages']['errors'] = $this->trans->get('errors');
		} else {
			$this->data['messages']['errors'] = Parser::parseTrans('errors');
		}

		return $this;
	}

	/**
	 * Stacks the trans to the data array.
	 *
	 * @return self
	 */
	protected function withTrans()
	{
		$this->data['trans'] = $this->trans->reject(function($item, $key) {
        	return $key == 'alerts' || $key == 'errors';
       	})->all();

       	return $this;
	}

	/**
	 * Stacks the custom properties to the component.
	 *
	 * @param  array  $props
	 * @return self
	 */
	protected function withProps(array $props = [])
	{
		$this->data['props'] = $props;

		return $this;
	}

	/**
	 * Stacks the default trans to the data array.
	 *
	 * @return self
	 */
	protected function withDefault()
	{
		return $this->withTrans()->withAlerts()->withErrors();
	}

	/**
	 * Returns the component body.
	 *
	 * @return array
	 */
	protected function render() : array
	{
		return $this->data;
	}

	/**
	 * Swaps the default trans source for a given wrapper.
	 *
	 * @param  string $wrapper
	 * @return self
	 */
	protected function loadTransFrom($wrapper)
	{
		$this->trans = Parser::parseTrans($this->repository, $wrapper);

		return $this;
	}
}