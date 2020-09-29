<?php

namespace Umpirsky;

class CountryList
{
    static function get(string $language): array
    {
        // Define the folder.
        $folder = __DIR__.'/../data/'.$language;

        // Test, if the folder for the locale exists.
        if (!is_dir($folder)) {
            throw new \OutOfBoundsException("Language $language not found.");
        }

        // Test, if the country entry as PHP file exists.
        if (!file_exists($folder.'/country.php')) {
            throw new \Exception("Country list file for $language not found.");
        }

        // Require and return the array
        return require $folder.'/country.php';
    }
}
