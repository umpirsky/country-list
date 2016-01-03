<?php

namespace Umpirsky\Country\Exporter\Format;

use Umpirsky\Country\Exporter\Exporter;

class Xml extends Exporter
{
    /**
     * {@inheritdoc}
     */
    public function export(array $data)
    {
        $countriesElement = new SimpleXMLExtended("<?xml version=\"1.0\" encoding=\"utf-8\"?><countries/>");

        foreach ($data as $iso => $name) {
            $countryElement = $countriesElement->addChild('country');
            $countryElement->addChild('iso', $iso);
            $countryElement->addChild('name', $countryElement->addCData($name));
        }

        return $countriesElement->asXML();
    }
}

class SimpleXMLExtended extends \SimpleXMLElement
{
    public function addCData($text)
    {
        $node = dom_import_simplexml($this);
        $node->appendChild(
            $node->ownerDocument->createCDATASection($text)
        );
    }
}
