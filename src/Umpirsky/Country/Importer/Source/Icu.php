<?php

/**
 * This file is part of the Country List project.
 *
 *  (c) Саша Стаменковић <umpirsky@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Umpirsky\Country\Importer\Source;

use Umpirsky\Country\Importer\Importer;
use Symfony\Component\Locale\Locale;

/**
 * ICU importer.
 *
 * @author Саша Стаменковић <umpirsky@gmail.com>
 */
class Icu extends Importer
{
    /**
     * @var Locale
     */
    protected $locale;

    /**
     * Icu constructor.
     */
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
