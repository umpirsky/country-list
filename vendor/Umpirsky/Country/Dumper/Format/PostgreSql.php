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
class PostgreSql extends Dumper {
    
    /**
     * {@inheritdoc}
     */
    public function dump(array $data) {

        $table = new \Doctrine\DBAL\Schema\Table('country', array(), array(), array(), false, array());
        $table->addColumn('id', 'string', array('notnull' => true));
        $table->setPrimaryKey(array('id'));
        $table->addColumn('name', 'string', array('length' => 64));
        
        $platform = \Doctrine\DBAL\DriverManager::getConnection(array('driver' => 'pdo_pgsql'))->getDatabasePlatform();
        
        $sql = $platform->getCreateTableSQL($table, \Doctrine\DBAL\Platforms\AbstractPlatform::CREATE_INDEXES);
        
        return $sql;
    }
}
