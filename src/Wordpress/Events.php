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
 * @author    Denis Smetannikov <denis@jbzoo.com>
 */

namespace JBZoo\CrossCMS\Wordpress;

use JBZoo\CrossCMS\AbstractEvents;

/**
 * Class Event
 * @package JBZoo\CrossCMS
 */
class Events extends AbstractEvents
{
    /**
     *  Example of Wordpress Plugin with hooks
     *
     *  // Init
     *  add_action('wp', function () {
     *      $app = Cms::getInstance();
     *      $app->trigger(AbstractEvent::EVENT_INIT);
     *  });
     *
     *
     *  // Header render
     *  add_action('wp_head', function () {
     *      $app = Cms::getInstance();
     *      $app->trigger(AbstractEvent::EVENT_HEADER);
     *  });
     *
     *
     *  // Content handlers (for macroses)
     *  add_filter('the_content', function ($content) {
     *      $app = Cms::getInstance();
     *      $app['events']->filterContent($content);
     *      return $content;
     *  });
     *
     *
     *  // Shutdown callback
     *  add_action('shutdown', function () {
     *      $app = Cms::getInstance();
     *      $app->trigger(AbstractEvent::EVENT_SHUTDOWN);
     *  });
     */

    /**
     * {@inheritdoc}
     */
    public function filterContent(&$content = null)
    {
        $this->_cms->trigger(AbstractEvents::EVENT_CONTENT, array(&$content));
    }
}
