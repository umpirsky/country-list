<?php

namespace Umpirsky\Country\Importer\Source;

use Umpirsky\Country\Importer\Importer;
use Symfony\Component\Locale\Locale;

class Icu extends Importer
{
    /**
     * @var Locale
     */
    protected $locale;

    public function __construct()
    {
        $this->locale = new Locale();
    }

    /**
     * {@inheritdoc}
     */
    public function getLanguages()
    {
        return $this->locale->getLocales();
    }

    /**
     * {@inheritdoc}
     */
    public function getCountries($language)
    {
        return $this->locale->getDisplayCountries($language);
    }
}
