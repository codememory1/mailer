<?php

namespace Codememory\Components\Mail;

use Codememory\Components\Mail\Interfaces\MailerInterface;
use Codememory\Components\Mail\Interfaces\MailerPackInterface;
use Codememory\Components\Mail\Interfaces\ServerConfigurationInterface;
use Codememory\Components\Mail\Interfaces\ServerWorkerInterface;
use Codememory\Components\Mail\Interfaces\UserConfigurationInterface;
use Codememory\Components\Mail\Interfaces\UserInterface;
use Codememory\Components\Mail\Interfaces\UserWorkerInterface;

/**
 * Class MailerPackInterface
 *
 * @package Codememory\Components\Mail
 *
 * @author  Codememory
 */
class MailerPack implements MailerPackInterface
{

    /**
     * @var Utils
     */
    private Utils $utils;

    /**
     * @var ServerWorkerInterface
     */
    private ServerWorkerInterface $serverWorker;

    /**
     * @var UserWorkerInterface
     */
    private UserWorkerInterface $userWorker;

    /**
     * @var UserInterface
     */
    private UserInterface $activeUser;

    /**
     * @param ServerWorkerInterface $serverWorker
     * @param UserWorkerInterface   $userWorker
     */
    public function __construct(ServerWorkerInterface $serverWorker, UserWorkerInterface $userWorker)
    {

        $this->serverWorker = $serverWorker;
        $this->userWorker = $userWorker;
        $this->utils = new Utils();

        $this->initServers();
        $this->initUsers();

        $this->activeUser = $this->userWorker->getUser($this->utils->getActiveUser());

    }

    /**
     * @inheritDoc
     */
    public function selectUser(string $alias): MailerPack
    {

        $this->activeUser = $this->userWorker->getUser($alias);

        return $this;

    }

    /**
     * @inheritDoc
     */
    public function getMailer(): MailerInterface
    {

        return new Mailer($this->activeUser);

    }

    /**
     * @inheritDoc
     */
    public function getServerWorker(): ServerWorkerInterface
    {

        return $this->serverWorker;

    }

    /**
     * @inheritDoc
     */
    public function getUserWorker(): UserWorkerInterface
    {

        return $this->userWorker;

    }

    /**
     * =>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>
     * Initializing servers from configuration
     * <=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=
     *
     * @return void
     */
    private function initServers(): void
    {

        $servers = $this->utils->getServers();

        foreach ($servers as $serverName => $serverData) {
            $this->serverWorker->add($serverName, function (ServerConfigurationInterface $configuration) use ($serverData) {
                if (null !== $host = $serverData['host']) {
                    $configuration->setHost($host);
                }

                if (null !== $port = $serverData['port']) {
                    $configuration->setPort($port);
                }

                if (null !== $timeout = $serverData['timeout']) {
                    $configuration->setTimeout($timeout);
                }

                if (null !== $encryption = $serverData['encryption']) {
                    $configuration->setEncryption($encryption);
                }

                if (null !== $mimeTypeBody = $serverData['mimeTypeBody']) {
                    $configuration->setMimeTypeBody($mimeTypeBody);
                }

                if (null !== $charset = $serverData['charset']) {
                    $configuration->setCharset($charset);
                }
            });
        }

    }

    /**
     * =>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>
     * Initializing users from configuration
     * <=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=
     *
     * @return void
     */
    private function initUsers(): void
    {

        $users = $this->utils->getUsers();

        foreach ($users as $alias => $userData) {
            $this->userWorker->addUser($alias, function (UserConfigurationInterface $configuration) use ($userData) {
                if (null !== $username = $userData['username']) {
                    $configuration->setUsername($username);
                }

                if (null !== $password = $userData['password']) {
                    $configuration->setPassword($password);
                }

                if (null !== $serverName = $userData['server']) {
                    $configuration->setServer($this->serverWorker->getServer($serverName));
                }

                if (null !== $from = $userData['from']) {
                    foreach ($from as $fromData) {
                        $configuration->addFrom($fromData['email'], $fromData['name'] ?? null);
                    }
                }
            });
        }

    }

}