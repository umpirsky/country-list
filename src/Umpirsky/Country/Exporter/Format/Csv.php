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
 * CSV exporter.
 *
 * @author Saša Stamenković <umpirsky@gmail.com>
 */
class Csv extends Exporter
{
    /**
     * {@inheritdoc}
     */
    public function export(array $data)
    {
        $outstream = fopen('php://temp', 'r+');
        fputcsv($outstream, array('iso', 'name'));
        foreach ($data as $iso => $name) {
            fputcsv($outstream, array($iso, $name));
        }
        rewind($outstream);
        $csv = stream_get_contents($outstream);
        fclose($outstream);

        return $csv;
    }
}
