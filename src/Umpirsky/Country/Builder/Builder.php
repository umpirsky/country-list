<?php

namespace Umpirsky\Country\Builder;

use Symfony\Component\Console\Application;

class Builder extends Application
{
    public function __construct($path)
    {
        parent::__construct('List builder');

        $this->add($build = new Build($path));
        $this->setDefaultCommand($build->getName());
    }
}
