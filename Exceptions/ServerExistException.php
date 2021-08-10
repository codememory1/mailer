<?php

namespace Codememory\Components\Mail\Exceptions;

use JetBrains\PhpStorm\Pure;

/**
 * Class ServerExistException
 *
 * @package Codememory\Components\Mail\Exceptions
 *
 * @author  Codememory
 */
class ServerExistException extends ServerException
{

    /**
     * @param string $serverName
     */
    #[Pure]
    public function __construct(string $serverName)
    {

        parent::__construct(sprintf('A server named %s already exists', $serverName));

    }

}