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
 * MySQL dumper.
 *
 * @author Саша Стаменковић <umpirsky@gmail.com>
 */
class MySql extends Dumper {

    /**
     * {@inheritdoc}
     */
    public function dump(array $data) {

        $sql = "CREATE TABLE `country` (" . PHP_EOL .
            "   `id` char(2) NOT NULL COMMENT 'ISO 3166-1 country code'," . PHP_EOL .
            "   `name` varchar(64) DEFAULT NULL COMMENT 'Country name'," . PHP_EOL .
            "   PRIMARY KEY  (`id`)" . PHP_EOL .
            ") ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Stores country names';" . PHP_EOL . PHP_EOL .

            "INSERT  INTO `country`" . PHP_EOL .
            "(`id`, `name`)" . PHP_EOL .
            "VALUES" . PHP_EOL
        ;

        foreach ($data as $id => $name) {
            $sql .= sprintf("('%s', '%s'),%s", $id, $name, PHP_EOL);
        }

        return substr($sql, 0, -2) . ';';
    }
}
