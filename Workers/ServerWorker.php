<?php

namespace Codememory\Components\Mail\Workers;

use Codememory\Components\Mail\Exceptions\ServerExistException;
use Codememory\Components\Mail\Exceptions\ServerNotExistException;
use Codememory\Components\Mail\Interfaces\ServerInterface;
use Codememory\Components\Mail\Interfaces\ServerWorkerInterface;
use Codememory\Components\Mail\Server;
use Codememory\Components\Mail\ServerConfiguration;
use Swift_SmtpTransport;

/**
 * Class ServerWorkerInterface
 *
 * @package Codememory\Components\Mail\Workers
 *
 * @author  Codememory
 */
class ServerWorker implements ServerWorkerInterface
{

    /**
     * @var array
     */
    private array $servers = [];

    /**
     * @inheritDoc
     * @throws ServerExistException
     */
    public function add(string $serverName, ?callable $callback = null): ServerWorkerInterface
    {

        if ($this->existServer($serverName)) {
            throw new ServerExistException($serverName);
        }

        $serverConfiguration = new ServerConfiguration();

        if (null !== $callback) {
            call_user_func($callback, $serverConfiguration);
        }

        $this->servers[$serverName] = new Server($serverName, $serverConfiguration);

        return $this;

    }

    /**
     * @inheritDoc
     * @throws ServerNotExistException
     */
    public function getServer(string $serverName): ServerInterface
    {

        if (!$this->existServer($serverName)) {
            throw new ServerNotExistException($serverName);
        }

        return $this->servers[$serverName];

    }

    /**
     * @inheritDoc
     */
    public function existServer(string $serverName): bool
    {

        return array_key_exists($serverName, $this->servers);

    }

}