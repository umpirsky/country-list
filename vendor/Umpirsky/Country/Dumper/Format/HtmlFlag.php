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
        
        $document = \DOMImplementation::createDocument(
            'http://www.w3.org/1999/xhtml',
            'html',
            \DOMImplementation::createDocumentType(
                'html',
                '-//W3C//DTD XHTML 1.1//EN',
                'http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd'
            )
        );
        $head = $document->createElement('head');
        $metahttp = $document->createElement('meta');
        $metahttp->setAttribute('http-equiv', 'Content-Type');
        $metahttp->setAttribute('content', 'text/html; charset=utf-8');
        $head->appendChild($metahttp);
        $css = $document->createElement('link');
        $css->setAttribute('href', 'https://raw.github.com/lafeber/world-flags-sprite/master/stylesheets/flags32.css');
        $css->setAttribute('rel', 'stylesheet');
        $css->setAttribute('type', 'text/css');
        $head->appendChild($css);

        $body = $document->createElement('body');
        $ulElement = $document->createElement('ul');
        foreach ($data as $iso => $name) {
            $liElement = $document->createElement('li', $name);
            $liElement->setAttribute('class', sprintf('f32 %s', strtolower($iso)));
            $ulElement->appendChild($liElement);
        }        
        $body->appendChild($ulElement);

        $html = $document->getElementsByTagName('html')->item(0);
        $html->appendChild($head);
        $html->appendChild($body);
        
        return $document->saveHTML();
    }
    
    /**
     * {@inheritdoc}
     */
    public function getFormat() {

        return 'flags.html';
    }
}
