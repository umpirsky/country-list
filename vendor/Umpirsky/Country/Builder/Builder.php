<?php

/**
 * This file is part of the Country List project.
 *
 *  (c) Саша Стаменковић <umpirsky@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Umpirsky\Country\Builder;

use Symfony\Component\Console\Application;

/**
 * Country list command line build interface.
 *
 * @author Саша Стаменковић <umpirsky@gmail.com>
 */
class Builder extends Application
{
   /**
    * Builder constructor.
    *
    * @param string $path base path to build files
    */
    public function __construct($path)
    {
        parent::__construct('Welcome to country list', '1.2');

        $this->addCommands(array(
            new Build($path)
        ));
    }
}
