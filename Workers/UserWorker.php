<?php

namespace Codememory\Components\Mail\Workers;

use Codememory\Components\Mail\Exceptions\NoServerSelectedException;
use Codememory\Components\Mail\Exceptions\UserExistException;
use Codememory\Components\Mail\Exceptions\UserNotExistException;
use Codememory\Components\Mail\Interfaces\UserInterface;
use Codememory\Components\Mail\Interfaces\UserWorkerInterface;
use Codememory\Components\Mail\User;
use Codememory\Components\Mail\UserConfiguration;

/**
 * Class UserWorkerInterface
 *
 * @package Codememory\Components\Mail\Workers
 *
 * @author  Codememory
 */
class UserWorker implements UserWorkerInterface
{

    /**
     * @var array
     */
    public array $users = [];

    /**
     * @inheritDoc
     * @throws UserExistException
     * @throws NoServerSelectedException
     */
    public function addUser(string $alias, callable $callback): UserWorkerInterface
    {

        if ($this->existUser($alias)) {
            throw new UserExistException($alias);
        }

        $userConfiguration = new UserConfiguration();

        call_user_func($callback, $userConfiguration);

        if (null === $userConfiguration->getServer()) {
            throw new NoServerSelectedException($alias);
        }

        $this->users[$alias] = new User($alias, $userConfiguration);

        return $this;

    }

    /**
     * @inheritDoc
     * @throws UserNotExistException
     */
    public function getUser(string $alias): UserInterface
    {

        if (!$this->existUser($alias)) {
            throw new UserNotExistException($alias);
        }

        return $this->users[$alias];

    }

    /**
     * @inheritDoc
     */
    public function existUser(string $alias): bool
    {

        return array_key_exists($alias, $this->users);

    }

}