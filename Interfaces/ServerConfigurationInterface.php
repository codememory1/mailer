<?php

namespace Codememory\Components\Mail\Interfaces;

/**
 * Interface ServerConfigurationInterface
 *
 * @package Codememory\Components\Mail\Interfaces
 *
 * @author  Codememory
 */
interface ServerConfigurationInterface
{

    /**
     * =>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>
     * Set the host to connect to
     * Literal IPv6 addresses should be wrapped in square brackets
     * <=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=
     *
     * @param string $host
     *
     * @return ServerConfigurationInterface
     */
    public function setHost(string $host): ServerConfigurationInterface;

    /**
     * =>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>
     * Set the port to connect to
     * <=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=
     *
     * @param int $port
     *
     * @return ServerConfigurationInterface
     */
    public function setPort(int $port): ServerConfigurationInterface;

    /**
     * =>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>
     * Set the encryption type (tls or ssl)
     * <=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=
     *
     * @param string $encryption
     *
     * @return ServerConfigurationInterface
     */
    public function setEncryption(string $encryption): ServerConfigurationInterface;

    /**
     * =>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>
     * Set the connection timeout
     * <=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=
     *
     * @param int $timeout
     *
     * @return ServerConfigurationInterface
     */
    public function setTimeout(int $timeout): ServerConfigurationInterface;

    /**
     * =>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>
     * Set the content type for the message
     * <=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=
     *
     * @param string $mimeType
     *
     * @return ServerConfigurationInterface
     */
    public function setMimeTypeBody(string $mimeType): ServerConfigurationInterface;

    /**
     * =>=>=>=>=>=>=>=>=>=>=>=>=>=>
     * Set message encoding
     * <=<=<=<=<=<=<=<=<=<=<=<=<=<=
     *
     * @param string $charset
     *
     * @return ServerConfigurationInterface
     */
    public function setCharset(string $charset): ServerConfigurationInterface;

}