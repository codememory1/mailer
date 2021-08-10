<?php

namespace Codememory\Components\Mail;

use Codememory\Components\Mail\Interfaces\ServerConfigurationDataInterface;
use Codememory\Components\Mail\Interfaces\ServerConfigurationInterface;

/**
 * Class ServerConfiguration
 *
 * @package Codememory\Components\Mail
 *
 * @author  Codememory
 */
class ServerConfiguration implements ServerConfigurationInterface, ServerConfigurationDataInterface
{

    /**
     * @var string
     */
    private string $host = 'localhost';

    /**
     * @var int
     */
    private int $port = 25;

    /**
     * @var string|null
     */
    private ?string $encryption = null;

    /**
     * @var int
     */
    private int $timeout = 30;

    /**
     * @var string
     */
    private string $mimeTypeBody = 'text/html';

    /**
     * @var string|null
     */
    private ?string $charset = null;

    /**
     * @inheritDoc
     */
    public function setHost(string $host): ServerConfigurationInterface
    {

        $this->host = $host;

        return $this;

    }

    /**
     * @inheritDoc
     */
    public function setPort(int $port): ServerConfigurationInterface
    {

        $this->port = $port;

        return $this;

    }

    /**
     * @inheritDoc
     */
    public function setEncryption(string $encryption): ServerConfigurationInterface
    {

        $this->encryption = $encryption;

        return $this;

    }

    /**
     * @inheritDoc
     */
    public function setTimeout(int $timeout): ServerConfigurationInterface
    {

        $this->timeout = $timeout;

        return $this;

    }

    /**
     * @inheritDoc
     */
    public function setMimeTypeBody(string $mimeType): ServerConfigurationInterface
    {

        $this->mimeTypeBody = $mimeType;

        return $this;

    }

    /**
     * @inheritDoc
     */
    public function setCharset(string $charset): ServerConfigurationInterface
    {

        $this->charset = $charset;

        return $this;

    }

    /**
     * @inheritDoc
     */
    public function getHost(): string
    {

        return $this->host;

    }

    /**
     * @inheritDoc
     */
    public function getPort(): int
    {

        return $this->port;

    }

    /**
     * @inheritDoc
     */
    public function getEncryption(): ?string
    {

        return $this->encryption;

    }

    /**
     * @inheritDoc
     */
    public function getTimeout(): int
    {

        return $this->timeout;

    }

    /**
     * @inheritDoc
     */
    public function getMimeTypeBody(): string
    {

        return $this->mimeTypeBody;

    }

    /**
     * @inheritDoc
     */
    public function getCharset(): ?string
    {

        return $this->charset;

    }

}