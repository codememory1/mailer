<?php

namespace Codememory\Components\Mail\Interfaces;

/**
 * Interface UserConfigurationInterface
 *
 * @package Codememory\Components\Mail\Interfaces
 *
 * @author  Codememory
 */
interface UserConfigurationInterface
{

    /**
     * =>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>
     * Set the username to authenticate with
     * <=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=
     *
     * @param string $username
     *
     * @return UserConfigurationInterface
     */
    public function setUsername(string $username): UserConfigurationInterface;

    /**
     * =>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>
     * Set the password to authenticate with
     * <=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=
     *
     * @param string $password
     *
     * @return UserConfigurationInterface
     */
    public function setPassword(string $password): UserConfigurationInterface;

    /**
     * =>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>
     * Install the server to which you want to connect
     * <=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=
     *
     * @param ServerInterface $server
     *
     * @return UserConfigurationInterface
     */
    public function setServer(ServerInterface $server): UserConfigurationInterface;

    /**
     * =>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>
     * Add data from which messages will be sent to the user
     * <=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=
     *
     * @param string      $email
     * @param string|null $name
     *
     * @return UserConfigurationInterface
     */
    public function addFrom(string $email, ?string $name = null): UserConfigurationInterface;

}