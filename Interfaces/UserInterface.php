<?php

namespace Codememory\Components\Mail\Interfaces;

use Swift_SmtpTransport;

/**
 * Interface UserInterface
 *
 * @package Codememory\Components\Mail\Interfaces
 *
 * @author  Codememory
 */
interface UserInterface
{

    /**
     * =>=>=>=>=>=>=>=>=>=>=>=>=>=>
     * Returns the user's alias
     * <=<=<=<=<=<=<=<=<=<=<=<=<=<=
     *
     * @return string
     */
    public function getAlias(): string;

    /**
     * =>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>
     * Reverting user data configuration
     * <=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=
     *
     * @return UserConfigurationDataInterface
     */
    public function getUserConfiguration(): UserConfigurationDataInterface;

    /**
     * =>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>
     * Returns Swift_SmtpTransport with a connected server and an authenticated user
     * <=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=
     *
     * @return Swift_SmtpTransport
     */
    public function getTransport(): Swift_SmtpTransport;

}