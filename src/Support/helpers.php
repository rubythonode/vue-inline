<?php

/*
 * This file is part of the VueInline package.
 *
 * (c) Gustavo Ocanto <gustavoocanto@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Gocanto\VueInline\Support\Builder;

if (! function_exists('component')) {
    /**
     * Returns the vue components props for a given signature.
     *
     * @param  string $signature The component signature
     * @param  null|string|array $props The properties list to be pass to the component.
     * @return array
     */
    function component(string $signature, $props = null)
    {
        return Builder::build($signature, $props);
    }
}
