<?php

namespace Umpirsky\Country\Exporter\Format;

use Umpirsky\Country\Exporter\Exporter;

class Json extends Exporter
{
    /**
     * {@inheritdoc}
     */
    public function export(array $data)
    {
        return json_encode($data);
    }
}
