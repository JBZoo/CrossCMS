<?php
/**
 * JBZoo CrossCMS
 *
 * This file is part of the JBZoo CCK package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @package   CrossCMS
 * @license   MIT
 * @copyright Copyright (C) JBZoo.com,  All rights reserved.
 * @link      https://github.com/JBZoo/CrossCMS
 */

namespace JBZoo\CrossCMS\Wordpress;

use JBZoo\CrossCMS\AbstractEvent;

/**
 * Class Event
 * @package JBZoo\CrossCMS
 */
class Event extends AbstractEvent
{
    /**
     * {@inheritdoc}
     */
    public function filterContent(&$content = null)
    {
        $this->trigger(AbstractEvent::EVENT_CONTENT, array(&$content));
    }
}