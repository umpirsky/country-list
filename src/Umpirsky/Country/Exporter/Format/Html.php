<?php

namespace Umpirsky\Country\Exporter\Format;

use Umpirsky\Country\Exporter\HtmlExporter;

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
            $optionElement = $this->getDocument()->createElement(
                'option',
                htmlentities($name)
            );
            $optionElement->setAttribute('value', $iso);
            $selectElement->appendChild($optionElement);
        }

        return $this->exportHtml($selectElement);
    }
}
