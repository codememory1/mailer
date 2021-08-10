<?php

namespace Codememory\Components\Mail;

use Codememory\Components\Mail\Interfaces\MailerInterface;
use Codememory\Components\Mail\Interfaces\UserInterface;
use Swift_Mailer;

/**
 * Class Mailer
 *
 * @package Codememory\Components\Mail
 *
 * @author  Codememory
 */
class Mailer implements MailerInterface
{

    /**
     * @var UserInterface
     */
    private UserInterface $user;

    /**
     * @var Swift_Mailer
     */
    private Swift_Mailer $swiftMailer;

    /**
     * @var array
     */
    private array $messages = [];

    /**
     * @param UserInterface $user
     */
    public function __construct(UserInterface $user)
    {

        $this->user = $user;
        $this->swiftMailer = new Swift_Mailer($user->getTransport());

    }

    /**
     * @inheritDoc
     */
    public function createMessage(callable $callback): Mailer
    {

        $message = new Message($this->user->getUserConfiguration());

        call_user_func($callback, $message);

        $this->messages[] = $message;

        return $this;

    }

    /**
     * @inheritDoc
     */
    public function send(bool $async = false): void
    {

        /** @var Message $message */
        foreach ($this->messages as $message) {
            $swiftMailer = clone $this->swiftMailer;
            $sendStatus = $swiftMailer->send($message->getSwiftMessage(), $failedRecipients);

            if($async && !$sendStatus) {
                break;
            }
        }

    }

}