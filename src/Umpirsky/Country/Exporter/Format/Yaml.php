<?php

namespace Umpirsky\Country\Exporter\Format;

use Umpirsky\Country\Exporter\Exporter;
use Symfony\Component\Yaml\Yaml as SymfonyYaml;

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
