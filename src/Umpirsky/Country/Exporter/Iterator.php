<?php

namespace Umpirsky\Country\Exporter;

use Symfony\Component\Finder\Finder;

/**
 * Iterates through various exporter formats.
 */
class Iterator implements \Iterator
{
    protected $exporters;

    public function __construct()
    {
        $finder = new Finder();
        $iterator = $finder
            ->files()
            ->name('*.php')
            ->depth(0)
            ->in(__DIR__.'/Format');

        $this->exporters = array();
        foreach ($iterator as $file) {
            $exporterClassName = '\\Umpirsky\\Country\\Exporter\\Format\\'.strstr($file->getFilename(), '.', true);
            $this->attach(new $exporterClassName());
        }

        $this->rewind();
    }

    public function attach($exporter)
    {
        $this->exporters[] = $exporter;
    }

    public function rewind()
    {
        reset($this->exporters);
    }

    public function valid()
    {
        return false !== $this->current();
    }

    public function next()
    {
        next($this->exporters);
    }

    public function current()
    {
        return current($this->exporters);
    }

    public function key()
    {
        return key($this->exporters);
    }
}
