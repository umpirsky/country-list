<?php

namespace Umpirsky\Country\Importer;

interface ImporterInterface
{
    /**
     * Get available languages.
     *
     * @return string[]
     */
    public function getLanguages();

    /**
     * Get list of all countries in given language.
     *
     * @param  string   $language
     * @return string[]
     */
    public function getCountries($language);
}
