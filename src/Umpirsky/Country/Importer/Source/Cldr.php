<?php

namespace Umpirsky\Country\Importer\Source;

use Umpirsky\Country\Importer\Importer;

class Cldr extends Importer
{
    public function __construct()
    {
        \Zend_Locale::disableCache(true);
    }

    /**
     * {@inheritdoc}
     */
    public function getLanguages()
    {
        return array_keys(\Zend_Locale::getLocaleList());
    }

    /**
     * {@inheritdoc}
     */
    public function getCountries($language)
    {
        $countries = \Zend_Locale::getTranslationList('territory', $language, 2);
        if (is_array($countries)) {
            asort($countries);
        }

        return $countries;
    }
}
