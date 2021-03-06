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

namespace JBZoo\CrossCMS;

/**
 * Class AbstractLibs
 * @package JBZoo\CrossCMS
 */
abstract class AbstractLibs extends AbstractHelper
{
    /**
     * @return bool
     */
    abstract public function jQuery();

    /**
     * @return bool
     */
    abstract public function jQueryUI();

    /**
     * @return bool
     */
    abstract public function jQueryAutocomplete();

    /**
     * @return bool
     */
    abstract public function jQueryDatePicker();

    /**
     * @return bool
     */
    abstract public function colorPicker();
}
