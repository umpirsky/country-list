<?php

/**
 * This file is part of the Country List project.
 *
 *  (c) Саша Стаменковић <umpirsky@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Umpirsky\Country\Importer;

use Symfony\Component\Finder\Finder;

/**
 * Iterates through various importer sources.
 *
 * @author Саша Стаменковић <umpirsky@gmail.com>
 */
class Iterator implements \Iterator
{
    protected $importers;

    public function __construct()
    {
        $finder = new Finder();
        $iterator = $finder
            ->files()
            ->name('*.php')
            ->depth(0)
            ->in(__DIR__.'/Source');

        $this->importers = array();
        foreach ($iterator as $file) {
            $importerClassName = '\\Umpirsky\\Country\\Importer\\Source\\'.strstr($file->getFilename(), '.', true);
            $this->attach(new $importerClassName());
        }

        $this->rewind();
    }

    public function attach($importer)
    {
        $this->importers[] = $importer;
    }

    public function rewind()
    {
        reset($this->importers);
    }

    public function valid()
    {
        return false !== $this->current();
    }

    public function next()
    {
        next($this->importers);
    }

    public function current()
    {
        return current($this->importers);
    }

    public function key()
    {
        return key($this->importers);
    }
}
