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
 * HTML dumper.
 *
 * @author Саша Стаменковић <umpirsky@gmail.com>
 */
class Html extends Dumper {

    /**
     * {@inheritdoc}
     */
    public function dump(array $data) {

        $document = new \DOMDocument('1.0', 'utf-8');
        foreach ($data as $iso => $name) {
            $optionElement = $document->createElementNS(null, 'option', $name);
            $optionElement->setAttribute('value', $iso);
            $document->appendChild($optionElement);
        }

        return $document->saveHTML();
    }
}
