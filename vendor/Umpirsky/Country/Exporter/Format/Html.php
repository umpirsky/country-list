<?php

/**
 * This file is part of the Country List project.
 *
 *  (c) Саша Стаменковић <umpirsky@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Umpirsky\Country\Exporter\Format;

use Umpirsky\Country\Exporter\HtmlExporter;

/**
 * HTML exporter.
 *
 * @author Саша Стаменковић <umpirsky@gmail.com>
 */
class Html extends HtmlExporter
{
    /**
     * {@inheritdoc}
     */
    public function export(array $data)
    {
        $selectElement = $this->getDocument()->createElement('select');
        $selectElement->setAttribute('name', 'country');
        foreach ($data as $iso => $name) {
            $optionElement = $this->getDocument()->createElement('option', $name);
            $optionElement->setAttribute('value', $iso);
            $selectElement->appendChild($optionElement);
        }

        return $this->exportHtml($selectElement);
    }
}
