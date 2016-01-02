<?php

/**
 * This file is part of the Country List project.
 *
 *  (c) Saša Stamenković <umpirsky@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Umpirsky\Country\Exporter\Format;

use Umpirsky\Country\Exporter\Exporter;

/**
 * PHP exporter.
 *
 * @author Saša Stamenković <umpirsky@gmail.com>
 */
class Php extends Exporter
{
    /**
     * {@inheritdoc}
     */
    public function export(array $data)
    {
        return sprintf('<?php return %s;%s', var_export($data, true), PHP_EOL);
    }
}
