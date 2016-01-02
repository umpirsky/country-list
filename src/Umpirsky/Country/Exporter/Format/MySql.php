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

use Umpirsky\Country\Exporter\SqlExporter;

/**
 * MySQL exporter.
 *
 * @author Saša Stamenković <umpirsky@gmail.com>
 */
class MySql extends SqlExporter
{
    /**
     * {@inheritdoc}
     */
    public function getDriver()
    {
        return 'pdo_mysql';
    }
}
