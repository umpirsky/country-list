<?php

/**
 * This file is part of the Country List project.
 *
 *  (c) Saša Stamenković <umpirsky@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Umpirsky\Country\Importer;

/**
 * Abstract importer.
 *
 * @author Saša Stamenković <umpirsky@gmail.com>
 */
abstract class Importer implements ImporterInterface
{
    /**
     * Gets source name.
     *
     * @return string
     */
    public function getSource()
    {
        $className = get_class($this);

        return strtolower(substr($className, strrpos($className, '\\') + 1));
    }

}
