<?php

namespace Codememory\Components\Mail;

use Codememory\Components\Caching\Exceptions\ConfigPathNotExistException;
use Codememory\Components\Configuration\Config;
use Codememory\Components\Configuration\Exceptions\ConfigNotFoundException;
use Codememory\Components\Configuration\Interfaces\ConfigInterface;
use Codememory\Components\Environment\Exceptions\EnvironmentVariableNotFoundException;
use Codememory\Components\Environment\Exceptions\IncorrectPathToEnviException;
use Codememory\Components\Environment\Exceptions\ParsingErrorException;
use Codememory\Components\Environment\Exceptions\VariableParsingErrorException;
use Codememory\Components\GlobalConfig\GlobalConfig;
use Codememory\FileSystem\File;
use JetBrains\PhpStorm\ArrayShape;

/**
 * Class Utils
 *
 * @package Codememory\Components\Mail
 *
 * @author  Codememory
 */
class Utils
{

    /**
     * @var ConfigInterface
     */
    private ConfigInterface $config;

    /**
     * @throws ConfigPathNotExistException
     * @throws ConfigNotFoundException
     * @throws EnvironmentVariableNotFoundException
     * @throws IncorrectPathToEnviException
     * @throws ParsingErrorException
     * @throws VariableParsingErrorException
     */
    public function __construct()
    {

        $config = new Config(new File());

        $this->config = $config->open(GlobalConfig::get('mail.configName'), []);

    }

    /**
     * @return array
     */
    public function getServers(): array
    {

        $servers = $this->config->get('servers') ?: [];

        foreach ($servers as &$serverData) {
            $serverData = $this->serverStructure(
                $serverData['host'] ?? null,
                $serverData['port'] ?? null,
                $serverData['timeout'] ?? null,
                $serverData['encryption'] ?? null,
                $serverData['mimeTypeBody'] ?? null,
                $serverData['charset'] ?? null,
            );
        }

        return $servers;

    }

    /**
     * @param string $serverName
     *
     * @return array
     */
    public function getServer(string $serverName): array
    {

        return $this->getServers()[$serverName] ?? [];

    }

    /**
     * @return array
     */
    public function getUsers(): array
    {

        $users = $this->config->get('users') ?: [];

        foreach ($users as &$user) {
            $user = $this->userStructure(
                $user['username'] ?? null,
                $user['password'] ?? null,
                $user['server'] ?? null,
                $user['from'] ?? []
            );
        }

        return $users;

    }

    /**
     * @param string $alias
     *
     * @return array
     */
    public function getUser(string $alias): array
    {

        return $this->getUsers()[$alias] ?? [];

    }

    /**
     * @param string $alias
     *
     * @return array
     */
    public function getUserFrom(string $alias): array
    {

        return $this->getUser($alias)['from'] ?? [];

    }

    /**
     * @return string|null
     */
    public function getActiveUser(): ?string
    {

        return $this->config->get('activeUser');

    }

    /**
     * @param string|null $host
     * @param int|null    $port
     * @param int|null    $timeout
     * @param string|null $encryption
     * @param string|null $mimeTypeBody
     * @param string|null $charset
     *
     * @return array
     */
    #[ArrayShape(['host' => "null|string", 'port' => "int|null", 'timeout' => "int|null", 'encryption' => "null|string", 'mimeTypeBody' => "null|string", 'charset' => "null|string"])]
    private function serverStructure(?string $host, ?int $port, ?int $timeout, ?string $encryption, ?string $mimeTypeBody, ?string $charset): array
    {

        return [
            'host'         => $host,
            'port'         => $port,
            'timeout'      => $timeout,
            'encryption'   => $encryption,
            'mimeTypeBody' => $mimeTypeBody,
            'charset'      => $charset
        ];

    }

    /**
     * @param string|null $username
     * @param string|null $password
     * @param string|null $server
     * @param array       $from
     *
     * @return array
     */
    #[ArrayShape(['username' => "null|string", 'password' => "null|string", 'server' => "null|string", 'from' => "array"])]
    private function userStructure(?string $username, ?string $password, ?string $server, array $from): array
    {

        return [
            'username' => $username,
            'password' => $password,
            'server'   => $server,
            'from'     => $from
        ];

    }

}