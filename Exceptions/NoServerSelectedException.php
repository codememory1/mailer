<?php

namespace Codememory\Components\Mail\Exceptions;

use JetBrains\PhpStorm\Pure;

/**
 * Class NoServerSelectedException
 *
 * @package Codememory\Components\Mail\Exceptions
 *
 * @author  Codememory
 */
class NoServerSelectedException extends ServerException
{

    /**
     * @param string $alias
     */
    #[Pure]
    public function __construct(string $alias)
    {

        parent::__construct(sprintf('No server selected for user with alias %s', $alias));

    }

}