<?php

namespace Codememory\Components\Mail\Interfaces;

/**
 * Interface ServerWorkerInterface
 *
 * @package Codememory\Components\Mail\Interfaces
 *
 * @author  Codememory
 */
interface ServerWorkerInterface
{

    /**
     * =>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>
     * Add a new server. The first argument is the name of a server that does not exist.
     * The second argument is callback, which takes one argument If callback is not specified,
     * default settings will be used
     * <=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=
     *
     * @param string        $serverName
     * @param callable|null $callback
     *
     * @return ServerWorkerInterface
     */
    public function add(string $serverName, ?callable $callback = null): ServerWorkerInterface;

    /**
     * =>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>
     * Returns the server by name if it exists, if the server does not exist,
     * a ServerNotExistsException will be thrown
     * <=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=
     *
     * @param string $serverName
     *
     * @return ServerInterface
     */
    public function getServer(string $serverName): ServerInterface;

    /**
     * =>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>
     * Check server existence by name
     * <=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=
     *
     * @param string $serverName
     *
     * @return bool
     */
    public function existServer(string $serverName): bool;

}