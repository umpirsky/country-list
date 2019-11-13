<?php

namespace Umpirsky;

abstract class CountryList
{

    static function get(string $language): array
    {
	$path = __DIR__.'/../data/'.$language;

	if(!is_dir($path)) {
	    throw new \Exception("Language $language not found.");
	}

	return require $path.'/country.php';
    }

}
