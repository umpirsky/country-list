<?php

namespace Umpirsky\Country\Importer;

abstract class Importer implements ImporterInterface
{
    /**
     * Gets source name.
     *
     * @return string
     */
    public function getSource()
    {
        $className = get_class($this);

        return strtolower(substr($className, strrpos($className, '\\') + 1));
    }

}
