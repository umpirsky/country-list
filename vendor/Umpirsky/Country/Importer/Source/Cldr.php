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
use Zend\Locale\Locale;
use Zend\Locale\Data\Cldr as ZendCldr;

/**
 * CLDR importer.
 *
 * @author Саша Стаменковић <umpirsky@gmail.com>
 */
class Cldr extends Importer {

    /**
     * @var Locale
     */
    protected $locale;

    /**
     * Cldr constructor.
     */
    public function __construct() {

        ZendCldr::disableCache(true);
        $this->locale = new Locale();
    }

    /**
     * {@inheritdoc}
     */
    public function getLanguages() {

        return array_keys($this->locale->getLocaleList());
    }

    /**
     * {@inheritdoc}
     */
    public function getCountries($language) {

        $countries = array();
        foreach (ZendCldr::getDisplayTerritory($language) as $iso => $name) {
            if (2 == strlen($iso)) {
                $countries[$iso] = $name;
            }
        }

        return $countries;
    }
}
