<?php

namespace Umpirsky\Country\Exporter\Format;

use Umpirsky\Country\Exporter\SqlExporter;

class PostgreSql extends SqlExporter
{
    /**
     * {@inheritdoc}
     */
    public function getDriver()
    {
        return 'pdo_pgsql';
    }
}
