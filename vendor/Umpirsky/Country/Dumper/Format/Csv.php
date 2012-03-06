<?php

/**
 * This file is part of the Country List project.
 *
 *  (c) Саша Стаменковић <umpirsky@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Umpirsky\Country\Dumper\Format;

use Umpirsky\Country\Dumper\Dumper;

/**
 * CSV dumper.
 *
 * @author Саша Стаменковић <umpirsky@gmail.com>
 */
class Csv extends Dumper {

    /**
     * {@inheritdoc}
     */
    public function dump(array $data) {

        $outstream = fopen('php://temp', 'r+');
        fputcsv($outstream, array('id', 'name'));
        foreach ($data as $id => $name) {
            fputcsv($outstream, array($id, $name));
        }
        rewind($outstream);
        $csv = stream_get_contents($outstream);
        fclose($outstream);
        
        return $csv;
    }
}
