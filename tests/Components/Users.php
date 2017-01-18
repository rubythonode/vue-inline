<?php

/*
 * This file is part of the VueInline package.
 *
 * (c) Gustavo Ocanto <gustavoocanto@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gocanto\VueInline\Tests\Components;

use Gocanto\VueInline\VueInline;

class Users extends VueInline
{
	/**
	 * Profile component.
	 *
	 * @return array
	 */
	public function profile()
	{
		return $this->tagName('users-profile')
			->withDefault()
			->render();
	}

	/**
	 * Login component.
	 *
	 * @return array
	 */
	public function login()
	{
		return $this->tagName('users-login')
			->withErrors()
			->render();
	}

	/**
	 * Invitations component.
	 *
	 * @return array
	 */
	public function invitations()
	{
		return $this->tagName('users-invitations')
			->loadTransFrom('profile') //if there is not trans relate to "invitations", we load them from another key.
			->withAlerts()
			->render();
	}

	/**
	 *  Email petition component.
	 *
	 * @return array
	 */
	public function emailpetitions()
	{
		$email = $this->props->get('email');

		return $this->tagName('email-petitions')
			->withProps([
				'email' => [
					'subject' => $email['subject'],
					'name' => $email['name'],
					'to' => $email['to'],
				]
			])
			->render();
	}
}