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

use JBZoo\CrossCMS\Cms;
use JBZoo\CrossCMS\AbstractRequest;

/**
 * Class Request
 * @package JBZoo\CrossCMS
 */
class Request extends AbstractRequest
{
    /**
     * @var \WP_Query
     */
    private $_wp_query = null;

    /**
     * {@inheritdoc}
     * @SuppressWarnings(PHPMD.Superglobals)
     */
    public function __construct(Cms $cms)
    {
        parent::__construct($cms);
        $this->_wp_query = new \WP_Query($_REQUEST);
    }

    /**
     * {@inheritdoc}
     */
    protected function _get($name, $default = null, $isArray = false)
    {
        return $this->_wp_query->get($name, $default);
    }

    /**
     * {@inheritdoc}
     */
    protected function _set($name, $value)
    {
        $this->_wp_query->set($name, $value);
    }

    /**
     * {@inheritdoc}
     */
    public function checkToken($name = 'crosscms')
    {
        return wp_verify_nonce($name);
    }
}
