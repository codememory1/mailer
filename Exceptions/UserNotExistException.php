<?php

namespace Codememory\Components\Mail\Exceptions;

use JetBrains\PhpStorm\Pure;

/**
 * Class UserNotExistException
 *
 * @package Codememory\Components\Mail\Exceptions
 *
 * @author  Codememory
 */
class UserNotExistException extends UserException
{

    /**
     * @param string $alias
     */
    #[Pure]
    public function __construct(string $alias)
    {

        parent::__construct(sprintf('User alias %s does not exist', $alias));

    }

}