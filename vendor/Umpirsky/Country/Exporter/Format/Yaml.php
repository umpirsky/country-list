<?php

/**
 * This file is part of the Country List project.
 *
 *  (c) Саша Стаменковић <umpirsky@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Umpirsky\Country\Exporter\Format;

use Umpirsky\Country\Exporter\Exporter;
use Symfony\Component\Yaml\Yaml as SymfonyYaml;

/**
 * Yaml exporter.
 *
 * @author Саша Стаменковић <umpirsky@gmail.com>
 */
class Yaml extends Exporter
{
    /**
     * {@inheritdoc}
     */
    public function export(array $data)
    {
        return SymfonyYaml::dump($data);
    }
}
