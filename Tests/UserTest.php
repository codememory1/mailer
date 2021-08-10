<?php

namespace Codememory\Components\Mail\Tests;

use Codememory\Components\Mail\Exceptions\NoServerSelectedException;
use Codememory\Components\Mail\Exceptions\ServerExistException;
use Codememory\Components\Mail\Exceptions\UserExistException;
use Codememory\Components\Mail\Exceptions\UserNotExistException;
use Codememory\Components\Mail\Interfaces\ServerInterface;
use Codememory\Components\Mail\Interfaces\ServerWorkerInterface;
use Codememory\Components\Mail\Interfaces\UserConfigurationInterface;
use Codememory\Components\Mail\Interfaces\UserInterface;
use Codememory\Components\Mail\Interfaces\UserWorkerInterface;
use Codememory\Components\Mail\Workers\ServerWorker;
use Codememory\Components\Mail\Workers\UserWorker;
use PHPUnit\Framework\TestCase;

/**
 * Class UserTest
 *
 * @package Codememory\Components\Mail\Tests
 *
 * @author  Codememory
 */
class UserTest extends TestCase
{

    /**
     * @var UserWorkerInterface
     */
    private UserWorkerInterface $userWorker;

    /**
     * @var ServerWorkerInterface
     */
    private ServerWorkerInterface $serverWorker;

    /**
     * @return void
     * @throws ServerExistException
     */
    public function setUp(): void
    {

        $this->userWorker = new UserWorker();
        $this->serverWorker = new ServerWorker();

        $this->serverWorker->add('server1');

    }

    /**
     * @return void
     * @throws NoServerSelectedException
     * @throws UserExistException
     */
    public function testAddUser(): void
    {

        $this->assertContainsOnlyInstancesOf(UserWorkerInterface::class, [
            $this->userWorker->addUser('user1', function (UserConfigurationInterface $configuration) {
                $configuration->setServer($this->serverWorker->getServer('server1'));
            })
        ]);

    }

    /**
     * @return void
     * @throws NoServerSelectedException
     * @throws UserExistException
     */
    public function testAddUserIfExist(): void
    {

        $this->userWorker->addUser('user1', function (UserConfigurationInterface $configuration) {
            $configuration->setServer($this->serverWorker->getServer('server1'));
        });

        $this->expectException(UserExistException::class);

        $this->userWorker->addUser('user1', function (UserConfigurationInterface $configuration) {
            $configuration->setServer($this->serverWorker->getServer('server1'));
        });

    }

    /**
     * @return void
     * @throws NoServerSelectedException
     * @throws UserExistException
     */
    public function testAddUserWithoutServer(): void
    {

        $this->expectException(NoServerSelectedException::class);

        $this->userWorker->addUser('user1', function (UserConfigurationInterface $configuration) {
        });

    }

    /**
     * @return void
     * @throws NoServerSelectedException
     * @throws UserExistException
     * @throws UserNotExistException
     */
    public function testGetUser(): void
    {

        $this->userWorker->addUser('user1', function (UserConfigurationInterface $configuration) {
            $configuration->setServer($this->serverWorker->getServer('server1'));
        });

        $this->assertContainsOnlyInstancesOf(UserInterface::class, [
            $this->userWorker->getUser('user1')
        ]);

    }

    /**
     * @return void
     * @throws NoServerSelectedException
     * @throws UserExistException
     * @throws UserNotExistException
     */
    public function testUserConfiguration(): void
    {

        $this->userWorker->addUser('user1', function (UserConfigurationInterface $configuration) {
            $configuration
                ->setUsername('user1@gmail.com')
                ->setPassword('user1_password')
                ->addFrom('user1From@gmail.com')
                ->addFrom('user1From2@gmail.com', 'User From2')
                ->setServer($this->serverWorker->getServer('server1'));
        });

        $userConfiguration = $this->userWorker->getUser('user1')->getUserConfiguration();
        $expFrom = [
            'user1From@gmail.com',
            'user1From2@gmail.com' => 'User From2'
        ];

        $this->assertEquals('user1@gmail.com', $userConfiguration->getUsername());
        $this->assertEquals('user1_password', $userConfiguration->getPassword());
        $this->assertEquals($expFrom, $userConfiguration->getFrom());
        $this->assertContainsOnlyInstancesOf(ServerInterface::class, [
            $userConfiguration->getServer()
        ]);
        $this->assertEquals('server1', $userConfiguration->getServer()->getServerName());

    }

    /**
     * @dataProvider addMultipleUsersProvider
     *
     * @param string $alias
     *
     * @return void
     * @throws NoServerSelectedException
     * @throws UserExistException
     */
    public function testAddMultipleUsers(string $alias): void
    {

        $this->assertContainsOnlyInstancesOf(UserWorkerInterface::class, [
            $this->userWorker->addUser($alias, function (UserConfigurationInterface $configuration) {
                $configuration->setServer($this->serverWorker->getServer('server1'));
            })
        ]);

    }

    /**
     * @return string[][]
     */
    public function addMultipleUsersProvider(): array
    {

        return [
            ['user1'],
            ['user2'],
            ['user3']
        ];

    }

}