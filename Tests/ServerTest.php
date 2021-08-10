<?php

namespace Codememory\Components\Mail\Tests;

use Codememory\Components\Mail\Exceptions\ServerExistException;
use Codememory\Components\Mail\Exceptions\ServerNotExistException;
use Codememory\Components\Mail\Interfaces\ServerConfigurationInterface;
use Codememory\Components\Mail\Interfaces\ServerInterface;
use Codememory\Components\Mail\Interfaces\ServerWorkerInterface;
use Codememory\Components\Mail\Workers\ServerWorker;
use PHPUnit\Framework\TestCase;

/**
 * Class ServerTest
 *
 * @package Codememory\Components\Mail\Tests
 *
 * @author  Codememory
 */
class ServerTest extends TestCase
{

    /**
     * @var ServerWorkerInterface
     */
    private ServerWorkerInterface $serverWorker;

    /**
     * @return void
     */
    public function setUp(): void
    {

        $this->serverWorker = new ServerWorker();

    }

    /**
     * @return void
     * @throws ServerExistException
     */
    public function testAddServer(): void
    {

        $this->assertContainsOnlyInstancesOf(ServerWorkerInterface::class, [
            $this->serverWorker->add('server1')
        ]);

    }

    /**
     * @return void
     * @throws ServerExistException
     */
    public function testAddServerIfExist(): void
    {

        $this->serverWorker->add('server1');

        $this->expectException(ServerExistException::class);

        $this->serverWorker->add('server1');

    }

    /**
     * @return void
     * @throws ServerExistException
     */
    public function testExistServer(): void
    {

        $this->serverWorker->add('server1');

        $this->assertTrue($this->serverWorker->existServer('server1'));

    }

    /**
     * @return void
     * @throws ServerExistException
     */
    public function testGetServer(): void
    {

        $server = $this->serverWorker
            ->add('server1')
            ->getServer('server1');

        $this->assertContainsOnlyInstancesOf(ServerInterface::class, [$server]);

    }

    /**
     * @dataProvider addMultipleServersProvider
     *
     * @param string $serverName
     *
     * @return void
     * @throws ServerExistException
     */
    public function testAddMultipleServers(string $serverName): void
    {

        $this->assertContainsOnlyInstancesOf(ServerWorkerInterface::class, [
            $this->serverWorker->add($serverName)
        ]);

    }

    /**
     * @return void
     * @throws ServerExistException
     */
    public function testAddServerWithConfiguration(): void
    {

        $this->assertContainsOnlyInstancesOf(ServerWorkerInterface::class, [
            $this->serverWorker->add('server1', function (ServerConfigurationInterface $configuration) {
                $configuration
                    ->setHost('localhost')
                    ->setPort(25)
                    ->setMimeTypeBody('text/html');
            })
        ]);

    }

    /**
     * @return void
     * @throws ServerExistException
     * @throws ServerNotExistException
     */
    public function testServerConfiguration(): void
    {

        $this->assertContainsOnlyInstancesOf(ServerWorkerInterface::class, [
            $this->serverWorker->add('server1', function (ServerConfigurationInterface $configuration) {
                $configuration
                    ->setHost('localhost')
                    ->setPort(25)
                    ->setTimeout(10)
                    ->setMimeTypeBody('text/html')
                    ->setEncryption('tls')
                    ->setCharset('utf-8');
            })
        ]);

        $server = $this->serverWorker->getServer('server1');
        $serverConfiguration = $server->getServerConfiguration();

        $this->assertEquals('localhost', $serverConfiguration->getHost());
        $this->assertEquals(25, $serverConfiguration->getPort());
        $this->assertEquals(10, $serverConfiguration->getTimeout());
        $this->assertEquals('text/html', $serverConfiguration->getMimeTypeBody());
        $this->assertEquals('tls', $serverConfiguration->getEncryption());
        $this->assertEquals('utf-8', $serverConfiguration->getCharset());

    }


    /**
     * @return string[][]
     */
    public function addMultipleServersProvider(): array
    {

        return [
            ['server1'],
            ['server2'],
            ['server3']
        ];

    }

}