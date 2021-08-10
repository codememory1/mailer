<?php

namespace Codememory\Components\Mail\Exceptions;

use JetBrains\PhpStorm\Pure;

/**
 * Class UserExistException
 *
 * @package Codememory\Components\Mail\Exceptions
 *
 * @author  Codememory
 */
class UserExistException extends UserException
{

    /**
     * @param string $alias
     */
    #[Pure]
    public function __construct(string $alias)
    {

        parent::__construct(sprintf('The user with the alias %s already exists', $alias));

    }

}