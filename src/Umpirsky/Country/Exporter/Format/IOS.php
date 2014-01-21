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
 * ios exporter.
 * This exporter exports a file as read by the NSLocalizedString function
 * @author Simon Meyer <Simon.Meyer@gmx.de>
 */
class IOS extends Exporter
{
    /**
     * {@inheritdoc}
     */
    public function export(array $data)
    {
        $txt = '';
        foreach ($data as $id => $name) {
            $txt .= sprintf('"%s" = "%s";%s', $id, $name,PHP_EOL);
        }

        return $txt;
    }
    
    /**
     * {@inheritdoc}
     */
    public function getFormat()
    {
        return 'strings';
    }
}
