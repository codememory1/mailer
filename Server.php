<?php

namespace Codememory\Components\Mail;

use Codememory\Components\Mail\Interfaces\ServerConfigurationDataInterface;
use Codememory\Components\Mail\Interfaces\ServerInterface;
use Swift_SmtpTransport;

/**
 * Class Server
 *
 * @package Codememory\Components\Mail
 *
 * @author  Codememory
 */
class Server implements ServerInterface
{

    /**
     * @var string
     */
    private string $serverName;

    /**
     * @var ServerConfigurationDataInterface
     */
    private ServerConfigurationDataInterface $serverConfiguration;

    /**
     * @param string                           $serverName
     * @param ServerConfigurationDataInterface $serverConfiguration
     */
    public function __construct(string $serverName, ServerConfigurationDataInterface $serverConfiguration)
    {

        $this->serverName = $serverName;
        $this->serverConfiguration = $serverConfiguration;

    }

    /**
     * @inheritDoc
     */
    public function getServerName(): string
    {

        return $this->serverName;

    }

    /**
     * @inheritDoc
     */
    public function getServerConfiguration(): ServerConfigurationDataInterface
    {

        return $this->serverConfiguration;

    }

    /**
     * @inheritDoc
     */
    public function getTransport(): Swift_SmtpTransport
    {

        $smtpTransport = new Swift_SmtpTransport();

        $smtpTransport
            ->setHost($this->getServerConfiguration()->getHost())
            ->setPort($this->getServerConfiguration()->getPort())
            ->setTimeout($this->getServerConfiguration()->getTimeout())
            ->setEncryption($this->getServerConfiguration()->getEncryption());

        return $smtpTransport;

    }

}