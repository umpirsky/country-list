<?php

/**
 * This file is part of the Country List project.
 *
 *  (c) Саша Стаменковић <umpirsky@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

require_once __DIR__ . '/vendor/Symfony/Component/ClassLoader/UniversalClassLoader.php';

use Symfony\Component\ClassLoader\UniversalClassLoader;

$loader = new UniversalClassLoader();
$loader->registerNamespaces(array(
    'Symfony' => __DIR__ . '/vendor',
    'Umpirsky' => __DIR__ . '/vendor',
    'Doctrine' => array(__DIR__ . '/vendor/doctrine/dbal/lib', __DIR__ . '/vendor/doctrine/dbal/lib/vendor/doctrine-common/lib')
));
$loader->register();