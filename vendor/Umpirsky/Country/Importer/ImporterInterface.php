<?php

/**
 * This file is part of the Country List project.
 *
 *  (c) Саша Стаменковић <umpirsky@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Umpirsky\Country\Importer;

/**
 * Importer interface.
 *
 * @author Саша Стаменковић <umpirsky@gmail.com>
 */
interface ImporterInterface
{
    /**
     * Get available languages.
     *
     * @return string[]
     */
    public function getLanguages();

    /**
     * Get list of all countries in given language.
     *
     * @param  string   $language
     * @return string[]
     */
    public function getCountries($language);
}
