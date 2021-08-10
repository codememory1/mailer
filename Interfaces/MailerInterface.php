<?php

namespace Codememory\Components\Mail\Interfaces;

/**
 * Interface MailerInterface
 *
 * @package Codememory\Components\Mail\Interfaces
 *
 * @author  Codememory
 */
interface MailerInterface
{

    /**
     * =>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>
     * Create a new message to send to recipients. Callback takes one
     * argument MessageInterface - setting the message
     * <=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=
     *
     * @param callable $callback
     *
     * @return MailerInterface
     */
    public function createMessage(callable $callback): MailerInterface;

    /**
     * =>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>
     * Send all created messages. The async argument can be used to specify dispatch asynchronously,
     * i.e. if the previous submission returned false the next submission will fail
     * <=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=
     *
     * @param bool $async
     *
     * @return void
     */
    public function send(bool $async = false): void;

}