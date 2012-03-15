<?php

/**
 * This file is part of the Country List project.
 *
 *  (c) Саша Стаменковић <umpirsky@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Umpirsky\Country\Dumper;

/**
 * Abstract HTML dumper.
 *
 * @author Саша Стаменковић <umpirsky@gmail.com>
 */
abstract class HtmlDumper extends Dumper {
    
    /**
     * Wraps DOM element to document and dumps it as HTML string.
     * 
     * @param \DOMElement $element
     * @return string
     */
    protected function dumpHtml(\DOMElement $element) {
        
        $document = $this->createDocument();
        $head = $this->createHead($document);
        $body = $document->createElement('body');
        $body->appendChild($element);
        $html = $document->getElementsByTagName('html')->item(0);
        $html->appendChild($head);
        $html->appendChild($body);
        
        return $document->saveHTML();
    }
    
    /**
     * Creates HTML document.
     * 
     * @return \DOMDocument
     */
    protected function createDocument() {
        
        return \DOMImplementation::createDocument(
            'http://www.w3.org/1999/xhtml',
            'html',
            \DOMImplementation::createDocumentType(
                'html',
                '-//W3C//DTD XHTML 1.1//EN',
                'http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd'
            )
        );
    }
    
    /**
     * Creates HTML head.
     * 
     * @param \DOMDocument $document
     * @return \DOMElement
     */
    protected function createHead(\DOMDocument $document) {
        
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
        
        return $head;
    }
}