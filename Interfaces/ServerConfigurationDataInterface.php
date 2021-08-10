<?php

namespace Codememory\Components\Mail\Interfaces;

/**
 * Interface ServerConfigurationDataInterface
 *
 * @package Codememory\Components\Mail\Interfaces
 *
 * @author  Codememory
 */
interface ServerConfigurationDataInterface
{

    /**
     * =>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>
     * Returns the host of the server
     * <=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=
     *
     * @return string
     */
    public function getHost(): string;

    /**
     * =>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>
     * Returns the port of the server
     * <=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=
     *
     * @return int
     */
    public function getPort(): int;

    /**
     * =>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>
     * Returns the encryption of the server
     * <=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=
     *
     * @return string|null
     */
    public function getEncryption(): ?string;

    /**
     * =>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>
     * Get the connection timeout
     * <=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=
     *
     * @return int
     */
    public function getTimeout(): int;

    /**
     * =>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>
     * Returns the content type for body
     * <=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=
     *
     * @return string
     */
    public function getMimeTypeBody(): string;

    /**
     * =>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>
     * Returns the encoding of the body message
     * <=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=
     *
     * @return string|null
     */
    public function getCharset(): ?string;

}