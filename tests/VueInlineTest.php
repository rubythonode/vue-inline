<?php

/*
 * This file is part of the VueInline package.
 *
 * (c) Gustavo Ocanto <gustavoocanto@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gocanto\VueInline\Tests;

use Gocanto\VueInline\Support\Builder;

class VueInlineTest extends TestCase
{
    public function test_creates_a_default_component_for_a_given_signature()
    {
        $component = component('users:profile');

        $this->assertArrayHasKey('is', $component);
        $this->assertContains('users-profile', $component);
        $this->assertEquals($component['trans']['title'], 'The section title');
        $this->assertEquals($component['messages']['errors'][404]['title'], 'Page Not Found');
        $this->assertEquals($component['messages']['alerts']['confirm']['title'], 'Are you sure?');
    }

    public function test_creates_a_component_with_errors()
    {
        $component = component('users:login');

        $this->assertArrayHasKey('is', $component);
        $this->assertTrue(empty($component['trans']));
        $this->assertContains('users-login', $component);
        $this->assertTrue(empty($component['messages']['alerts']));
        $this->assertTrue(count($component['messages']['errors']) > 0);
    }

    public function test_creates_a_component_with_alerts()
    {
        $component = component('users:invitations');

        $this->assertArrayHasKey('is', $component);
        $this->assertTrue(empty($component['trans']));
        $this->assertContains('users-invitations', $component);
        $this->assertTrue(empty($component['messages']['erros']));
        $this->assertTrue(count($component['messages']['alerts']) > 0);
    }

    public function test_creates_a_default_component_for_a_given_signature_from_concrete_class()
    {
       $component = Builder::build('users:profile');

        $this->assertArrayHasKey('is', $component);
        $this->assertContains('users-profile', $component);
        $this->assertEquals($component['trans']['title'], 'The section title');
        $this->assertEquals($component['messages']['errors'][404]['title'], 'Page Not Found');
        $this->assertEquals($component['messages']['alerts']['confirm']['title'], 'Are you sure?');
    }

    public function test_creates_a_component_with_props()
    {
        $component = component('users:emailpetitions', [
            'email' => [
                'subject' => 'Testing this package',
                'to' => 'gustavoocanto@gmail.com',
                'name' => 'Gustavo Ocanto',
            ]
        ]);

        $this->assertArrayHasKey('is', $component);
        $this->assertContains('email-petitions', $component);
        $this->assertTrue(isset($component['props']['email']));
        $this->assertTrue(count($component['props']['email']) > 0);
        $this->assertEquals($component['props']['email']['name'], 'Gustavo Ocanto');
        $this->assertEquals($component['props']['email']['to'], 'gustavoocanto@gmail.com');
        $this->assertEquals($component['props']['email']['subject'], 'Testing this package');
    }

    /**
     * @expectedException RuntimeException
     */
    public function test_throw_an_exception_if_a_component_does_not_exist()
    {
        $component = component('users:testing');
    }

     /**
     * @expectedException RuntimeException
     */
    public function test_throw_an_exception_if_a_repository_does_not_exist()
    {
        $component = component('userss:login');
    }

     /**
     * @expectedException InvalidArgumentException
     */
    public function test_throw_an_exception_if_a_component_signature_is_not_valid()
    {
        $component = component('users-login');
    }
}