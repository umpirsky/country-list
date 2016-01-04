<?php

namespace Umpirsky\Country\Builder;

use Symfony\Component\Console\Application;
use Umpirsky\Country\Importer\ImporterInterface;

class Builder extends Application
{
    public function __construct(ImporterInterface $importer, $path)
    {
        parent::__construct('List builder');

        $this->add($build = new Build($importer, $path));
        $this->setDefaultCommand($build->getName());
    }
}
