<?php

namespace Codememory\Components\Mail;

use Codememory\Components\Mail\Interfaces\MessageInterface;
use Codememory\Components\Mail\Interfaces\ServerInterface;
use Codememory\Components\Mail\Interfaces\UserConfigurationDataInterface;
use Swift_Attachment;
use Swift_Message;

/**
 * Class Message
 *
 * @package Codememory\Components\Mail
 *
 * @author  Codememory
 */
class Message implements MessageInterface
{

    /**
     * @var UserConfigurationDataInterface
     */
    private UserConfigurationDataInterface $userConfigurationData;

    /**
     * @var ServerInterface
     */
    private ServerInterface $server;

    /**
     * @var Swift_Message
     */
    private Swift_Message $swiftMessage;

    /**
     * @param UserConfigurationDataInterface $userConfigurationData
     */
    public function __construct(UserConfigurationDataInterface $userConfigurationData)
    {

        $this->userConfigurationData = $userConfigurationData;
        $this->server = $this->userConfigurationData->getServer();
        $this->swiftMessage = new Swift_Message();

        $this->swiftMessage->setFrom($this->userConfigurationData->getFrom());

    }

    /**
     * @inheritDoc
     */
    public function setSubject(string $subject): MessageInterface
    {

        $this->swiftMessage->setSubject($subject);

        return $this;

    }

    /**
     * @inheritDoc
     */
    public function setBody(string $body): MessageInterface
    {

        $serverConfiguration = $this->server->getServerConfiguration();

        $this->swiftMessage->setBody($body, $serverConfiguration->getMimeTypeBody(), $serverConfiguration->getCharset());

        return $this;

    }

    /**
     * @inheritDoc
     */
    public function addRecipientAddress(string $email, ?string $name = null): MessageInterface
    {

        $this->swiftMessage->addTo($email, $name);

        return $this;

    }

    /**
     * @inheritDoc
     */
    public function addRecipientAddresses(array $addresses): MessageInterface
    {

        foreach ($addresses as $key => $value) {
            if (is_string($key)) {
                $this->swiftMessage->addTo($key, $value);
            } else {
                $this->swiftMessage->addTo($value);
            }
        }

        return $this;

    }

    /**
     * @inheritDoc
     */
    public function addRecipientCopy(string $email, ?string $name): MessageInterface
    {

        $this->swiftMessage->addCc($email, $name);

        return $this;

    }

    /**
     * @inheritDoc
     */
    public function addRecipientHiddenCopy(string $email, ?string $name = null): MessageInterface
    {

        $this->swiftMessage->addBcc($email, $name);

        return $this;

    }

    /**
     * @inheritDoc
     */
    public function attach(string $path, ?callable $callback = null): MessageInterface
    {

        $attachment = Swift_Attachment::fromPath($path);

        if (null !== $callback) {
            call_user_func($callback, $attachment);
        }

        $this->swiftMessage->attach($attachment);

        return $this;

    }

    /**
     * @inheritDoc
     */
    public function attachmentWithData(mixed $data, string $filename): MessageInterface
    {

        $attachment = new Swift_Attachment($data, $filename, $this->server->getServerConfiguration()->getMimeTypeBody());

        $this->swiftMessage->attach($attachment);

        return $this;

    }

    /**
     * @return Swift_Message
     */
    public function getSwiftMessage(): Swift_Message
    {

        return $this->swiftMessage;

    }

}