<?php

/**
 * This file is part of the Country List project.
 *
 *  (c) Saša Stamenković <umpirsky@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Umpirsky\Country\Exporter;

/**
 * Abstract exporter.
 *
 * @author Saša Stamenković <umpirsky@gmail.com>
 */
abstract class Exporter implements ExporterInterface
{
    /**
     * Gets exporter format.
     *
     * @return string
     */
    public function getFormat()
    {
        $className = get_class($this);

        return strtolower(substr($className, strrpos($className, '\\') + 1));
    }
}
