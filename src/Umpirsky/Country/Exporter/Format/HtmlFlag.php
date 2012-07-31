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
 * HTML exporter, adds country flags as well.
 *
 * @see https://github.com/lafeber/world-flags-sprite
 * @author Саша Стаменковић <umpirsky@gmail.com>
 */
class HtmlFlag extends HtmlExporter
{
    /**
     * {@inheritdoc}
     */
    public function export(array $data)
    {
        $this->addStylesheet('http://country-list.umpirsky.com/css/flags32.css');

        $ulElement = $this->getDocument()->createElement('ul');
        $ulElement->setAttribute('class', 'f32');
        foreach ($data as $iso => $name) {
            $liElement = $this->getDocument()->createElement('li', $name);
            $liElement->setAttribute('class', sprintf('flag %s', strtolower($iso)));
            $ulElement->appendChild($liElement);
        }

        return $this->exportHtml($ulElement);
    }

    /**
     * {@inheritdoc}
     */
    public function getFormat()
    {
        return 'flags.html';
    }
}
