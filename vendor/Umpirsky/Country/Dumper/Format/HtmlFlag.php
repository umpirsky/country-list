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

use Umpirsky\Country\Dumper\HtmlDumper;

/**
 * HTML dumper, adds country flags as well.
 *
 * @see https://github.com/lafeber/world-flags-sprite
 * @author Саша Стаменковић <umpirsky@gmail.com>
 */
class HtmlFlag extends HtmlDumper {

    /**
     * {@inheritdoc}
     */
    public function dump(array $data) {

        $this->addStylesheet('https://raw.github.com/umpirsky/world-flags-sprite/github-cdn/stylesheets/flags16.cdn.css');

        $ulElement = $this->getDocument()->createElement('ul');
        foreach ($data as $iso => $name) {
            $liElement = $this->getDocument()->createElement('li', $name);
            $liElement->setAttribute('class', sprintf('flag %s', strtolower($iso)));
            $ulElement->appendChild($liElement);
        }

        return $this->dumpHtml($ulElement);
    }

    /**
     * {@inheritdoc}
     */
    public function getFormat() {

        return 'flags.html';
    }
}
