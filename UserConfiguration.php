<?php

namespace Codememory\Components\Mail;

use Codememory\Components\Mail\Interfaces\ServerInterface;
use Codememory\Components\Mail\Interfaces\UserConfigurationDataInterface;
use Codememory\Components\Mail\Interfaces\UserConfigurationInterface;

/**
 * Class UserConfiguration
 *
 * @package Codememory\Components\Mail
 *
 * @author  Codememory
 */
class UserConfiguration implements UserConfigurationInterface, UserConfigurationDataInterface
{

    /**
     * @var string|null
     */
    private ?string $username = null;

    /**
     * @var string|null
     */
    private ?string $password = null;

    /**
     * @var ServerInterface|null
     */
    private ?ServerInterface $server = null;

    /**
     * @var array
     */
    private array $from = [];

    /**
     * @inheritDoc
     */
    public function setUsername(string $username): UserConfigurationInterface
    {

        $this->username = $username;

        return $this;

    }

    /**
     * @inheritDoc
     */
    public function setPassword(string $password): UserConfigurationInterface
    {

        $this->password = $password;

        return $this;

    }

    /**
     * @inheritDoc
     */
    public function setServer(ServerInterface $server): UserConfigurationInterface
    {

        $this->server = $server;

        return $this;

    }

    /**
     * @inheritDoc
     */
    public function addFrom(string $email, ?string $name = null): UserConfigurationInterface
    {

        if (null !== $name) {
            $this->from[$email] = $name;
        } else {
            $this->from[] = $email;
        }

        return $this;

    }

    /**
     * @inheritDoc
     */
    public function getUsername(): ?string
    {

        return $this->username;

    }

    /**
     * @inheritDoc
     */
    public function getPassword(): ?string
    {

        return $this->password;

    }

    /**
     * @inheritDoc
     */
    public function getServer(): ?ServerInterface
    {

        return $this->server;

    }

    /**
     * @inheritDoc
     */
    public function getFrom(): array
    {

        return $this->from;

    }

}