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

namespace JBZoo\CrossCMS\Joomla;

use JBZoo\CrossCMS\AbstractHttp;
use JBZoo\Data\Data;

/**
 * Class Http
 * @package JBZoo\CrossCMS
 */
class Http extends AbstractHttp
{
    /**
     * {@inheritdoc}
     */
    protected function _request($url, $args, Data $options)
    {
        $method    = $options->get('method');
        $headers   = $options->get('headers');
        $timeout   = $options->get('timeout');
        $sslVerify = $options->get('ssl_verify');

        if (empty($headers)) {
            $headers = null;
        }
        
        if ($sslVerify) {
            // "curl" driver doesn't have such option
            $httpClient = \JHttpFactory::getHttp(); // try to find curl driver
        } else {
            $httpClient = \JHttpFactory::getHttp(null, 'stream');
        }

        $httpClient->setOption('userAgent', $options->get('user_agent'));

        if (self::METHOD_GET === $method) {
            $apiResponse = $httpClient->get($url, $headers, $timeout);

        } elseif (self::METHOD_POST === $method) {
            $apiResponse = $httpClient->post($url, $args, $headers, $timeout);

        } elseif (self::METHOD_HEAD === $method) {
            $apiResponse = $httpClient->head($url, $headers, $timeout);

        } elseif (self::METHOD_PUT === $method) {
            $apiResponse = $httpClient->put($url, $args, $headers, $timeout);

        } elseif (self::METHOD_DELETE === $method) {
            $apiResponse = $httpClient->delete($url, $headers, $timeout);

        } elseif (self::METHOD_OPTIONS === $method) {
            $apiResponse = $httpClient->options($url, $headers, $timeout);

        } elseif (self::METHOD_PATCH === $method) {
            $apiResponse = $httpClient->patch($url, $args, $headers, $timeout);

        } else {
            $apiResponse = $httpClient->get($url, $headers, $timeout);
        }

        return $apiResponse;
    }

    /**
     * @param $apiResponse
     * @return Data
     */
    protected function _compactResponse($apiResponse)
    {
        $response = array(
            'code'    => (int)$apiResponse->code,
            'headers' => array_change_key_case($apiResponse->headers, CASE_LOWER),
            'body'    => $apiResponse->body,
        );

        $response = new Data($response);

        return $response;
    }
}
