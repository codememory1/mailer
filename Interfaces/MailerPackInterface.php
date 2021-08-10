<?php

namespace Codememory\Components\Mail\Interfaces;

/**
 * Interface MailerPackInterface
 *
 * @package Codememory\Components\Mail\Interfaces
 *
 * @author  Codememory
 */
interface MailerPackInterface
{

    /**
     * =>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>
     * Choose another user for authentication
     * <=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=
     *
     * @param string $alias
     *
     * @return MailerPackInterface
     */
    public function selectUser(string $alias): MailerPackInterface;

    /**
     * =>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>
     * Returns the mailer of the currently active user
     * <=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=
     *
     * @return MailerInterface
     */
    public function getMailer(): MailerInterface;

    /**
     * =>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>
     * Returns the worker working with the server
     * <=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=
     *
     * @return ServerWorkerInterface
     */
    public function getServerWorker(): ServerWorkerInterface;

    /**
     * =>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>
     * Returns an employee working with users
     * <=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=
     *
     * @return UserWorkerInterface
     */
    public function getUserWorker(): UserWorkerInterface;

}