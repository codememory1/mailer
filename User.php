<?php

namespace Codememory\Components\Mail;

use Codememory\Components\Mail\Interfaces\UserConfigurationDataInterface;
use Codememory\Components\Mail\Interfaces\UserInterface;
use Swift_SmtpTransport;

/**
 * Class User
 *
 * @package Codememory\Components\Mail
 *
 * @author  Codememory
 */
class User implements UserInterface
{

    /**
     * @var string
     */
    private string $alias;

    /**
     * @var UserConfigurationDataInterface
     */
    private UserConfigurationDataInterface $userConfiguration;

    /**
     * @param string                         $alias
     * @param UserConfigurationDataInterface $userConfiguration
     */
    public function __construct(string $alias, UserConfigurationDataInterface $userConfiguration)
    {

        $this->alias = $alias;
        $this->userConfiguration = $userConfiguration;

    }

    /**
     * @inheritDoc
     */
    public function getAlias(): string
    {

        return $this->alias;

    }

    /**
     * @inheritDoc
     */
    public function getUserConfiguration(): UserConfigurationDataInterface
    {

        return $this->userConfiguration;

    }

    /**
     * @inheritDoc
     */
    public function getTransport(): Swift_SmtpTransport
    {

        $serverTransport = $this->userConfiguration->getServer()->getTransport();

        $serverTransport
            ->setUsername($this->userConfiguration->getUsername())
            ->setPassword($this->userConfiguration->getPassword());

        return $serverTransport;

    }

}