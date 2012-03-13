<?php

/**
 * This file is part of the Country List project.
 *
 *  (c) Саша Стаменковић <umpirsky@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Umpirsky\Country\Dumper\Format;

use Umpirsky\Country\Dumper\Dumper;

/**
 * XML dumper.
 *
 * @author Саша Стаменковић <umpirsky@gmail.com>
 */
class Xml extends Dumper {

    /**
     * {@inheritdoc}
     */
    public function dump(array $data) {

        $countriesElement = new \SimpleXmlElement("<?xml version=\"1.0\" encoding=\"utf-8\"?><countries/>");
        foreach ($data as $iso => $name) {
            $countryElement = $countriesElement->addChild('country');
            $countryElement->addChild('iso', $iso);
            $countryElement->addChild('name', $name);
        }

        return $countriesElement->asXML();
    }
}
