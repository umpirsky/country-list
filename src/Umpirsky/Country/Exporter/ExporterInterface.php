<?php

/**
 * This file is part of the Country List project.
 *
 *  (c) Саша Стаменковић <umpirsky@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Umpirsky\Country\Exporter;

/**
 * Exporter interface.
 *
 * @author Саша Стаменковић <umpirsky@gmail.com>
 */
interface ExporterInterface
{
    /**
     * Exports data into specific format.
     *
     * @param  array  $data
     * @return string
     */
    public function export(array $data);
}
