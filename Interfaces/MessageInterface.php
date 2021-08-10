<?php

namespace Codememory\Components\Mail\Interfaces;

/**
 * Interface MessageInterface
 *
 * @package Codememory\Components\Mail\Interfaces
 *
 * @author  Codememory
 */
interface MessageInterface
{

    /**
     * =>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>
     * Set message subject
     * <=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=
     *
     * @param string $subject
     *
     * @return MessageInterface
     */
    public function setSubject(string $subject): MessageInterface;

    /**
     * =>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>
     * Set message content - any format
     * <=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=
     *
     * @param string $body
     *
     * @return MessageInterface
     */
    public function setBody(string $body): MessageInterface;

    /**
     * =>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>
     * Add recipient's address (who will receive the message)
     * <=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=
     *
     * @param string      $email
     * @param string|null $name
     *
     * @return MessageInterface
     */
    public function addRecipientAddress(string $email, ?string $name = null): MessageInterface;

    /**
     * =>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>
     * Add recipient addresses (who will receive the message)
     * <=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=
     *
     * @param array $addresses
     *
     * @return MessageInterface
     */
    public function addRecipientAddresses(array $addresses): MessageInterface;

    /**
     * =>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>
     * Add addresses of recipients who will receive a copy of the message
     * <=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=
     *
     * @param string      $email
     * @param string|null $name
     *
     * @return MessageInterface
     */
    public function addRecipientCopy(string $email, ?string $name): MessageInterface;

    /**
     * =>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>
     * Add a recipient who will receive a Bcc
     * <=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=
     *
     * @param string      $email
     * @param string|null $name
     *
     * @return MessageInterface
     */
    public function addRecipientHiddenCopy(string $email, ?string $name = null): MessageInterface;

    /**
     * =>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>
     * Add file to message. And with the additional callback argument, you can customize
     * the file to be sent. Callback accepts one Swift_Attachment argument
     * <=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=
     *
     * @param string        $path
     * @param callable|null $callback
     *
     * @return MessageInterface
     */
    public function attach(string $path, ?callable $callback = null): MessageInterface;

    /**
     * =>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>
     * This method combines 2 methods setBody and attach
     * <=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=
     *
     * @param mixed  $data
     * @param string $filename
     *
     * @return MessageInterface
     */
    public function attachmentWithData(mixed $data, string $filename): MessageInterface;

}