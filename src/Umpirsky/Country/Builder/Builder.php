<?php

namespace Umpirsky\Country\Builder;

use Symfony\Component\Console\Application;

class Builder extends Application
{
    public function __construct($path)
    {
        parent::__construct('Country list', '1.2');

        $this->addCommands(array(
            new Build($path)
        ));
    }
}
