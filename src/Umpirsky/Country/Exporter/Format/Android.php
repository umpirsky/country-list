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

use Umpirsky\Country\Exporter\Exporter;

/**
 * XML exporter.
 *
 * @author Саша Стаменковић <umpirsky@gmail.com>
 */
class Android extends Exporter
{
    /**
     * {@inheritdoc}
     */
    public function export(array $data)
    {
    	$prettyprint = true;
    	
        $countriesElement = new \SimpleXmlElement('<?xml version="1.0" encoding="utf-8"?><resources xmlns:tools="http://schemas.android.com/tools"/>');
        foreach ($data as $iso => $name) {
            $countryElement = $countriesElement->addChild('string', $name);
            $countryElement->addAttribute('name', "COUNTRY_NAME_".$iso);
        }
        $result = '';
        
        // prettyprint
        if ($prettyprint)
        {
        	$dom = dom_import_simplexml($countriesElement)->ownerDocument;
			$dom->formatOutput = true;
			$result =  $dom->saveXML();
        }
        else
        {
        	$result = $countriesElement->asXML();
        }
        
        return $result;
    }
    
    public function getFileName()
    {
        return 'countries.xml';
    }
}
