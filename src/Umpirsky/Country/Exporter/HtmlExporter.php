<?php

namespace Umpirsky\Country\Exporter;

abstract class HtmlExporter extends Exporter
{
    /**
     * Array of stylesheets for this HTML document.
     *
     * @var string[]
     */
    protected $stylesheets = array();

    /**
     * @var \DOMDocument
     */
    protected $document;

    /**
     * Wraps DOM element to document and exports it as HTML string.
     *
     * @param  \DOMElement $element
     * @return string
     */
    protected function exportHtml(\DOMElement $element)
    {
        $body = $this->getDocument()->createElement('body');
        $body->appendChild($element);
        $html = $this->getDocument()->getElementsByTagName('html')->item(0);
        $html->appendChild($this->getHead());
        $html->appendChild($body);

        $html =  $this->getDocument()->saveHTML();
        $this->reset();

        return $html;
    }

    /**
     * Creates HTML document.
     *
     * @return \DOMDocument
     */
    protected function getDocument()
    {
        if (null === $this->document) {
            $this->document = \DOMImplementation::createDocument(
                'http://www.w3.org/1999/xhtml',
                'html',
                \DOMImplementation::createDocumentType(
                    'html',
                    '-//W3C//DTD XHTML 1.0 Strict//EN',
                    'http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd'
                )
            );
        }

        return $this->document;
    }

    /**
     * Resets document internal objects.
     */
    protected function reset()
    {
        $this->document = null;
        $this->stylesheets = array();
    }

    /**
     * Adds new stylesheet to this HTML document.
     *
     * @param string $stylesheet
     */
    protected function addStylesheet($stylesheet)
    {
        $this->stylesheets[] = $stylesheet;
    }

    /**
     * Gets all stylesheets for this HTML document.
     *
     * @return string[]
     */
    protected function getStylesheets()
    {
        return $this->stylesheets;
    }

    /**
     * Creates HTML head.
     *
     * @return \DOMElement
     */
    protected function getHead()
    {
        $head = $this->getDocument()->createElement('head');
        $metahttp = $this->getDocument()->createElement('meta');
        $metahttp->setAttribute('http-equiv', 'Content-Type');
        $metahttp->setAttribute('content', 'text/html; charset=utf-8');
        $head->appendChild($metahttp);
        $head->appendChild($this->getDocument()->createElement('title', 'Country List'));

        foreach ($this->getStylesheets() as $href) {
            $stylesheet = $this->getDocument()->createElement('link');
            $stylesheet->setAttribute('href', $href);
            $stylesheet->setAttribute('rel', 'stylesheet');
            $stylesheet->setAttribute('type', 'text/css');
            $head->appendChild($stylesheet);
        }

        return $head;
    }
}
