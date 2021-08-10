<?php

namespace Codememory\Components\Mail\Exceptions;

use JetBrains\PhpStorm\Pure;

/**
 * Class ServerNotExistException
 *
 * @package Codememory\Components\Mail\Exceptions
 *
 * @author  Codememory
 */
class ServerNotExistException extends ServerException
{

    /**
     * @param string $serverName
     */
    #[Pure]
    public function __construct(string $serverName)
    {

        parent::__construct(sprintf('Server named %s does not exist', $serverName));

    }

}