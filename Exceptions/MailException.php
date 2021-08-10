<?php

namespace Codememory\Components\Mail\Exceptions;

use ErrorException;
use JetBrains\PhpStorm\Pure;

/**
 * Class MailException
 *
 * @package Codememory\Components\Mail\Exceptions
 *
 * @author  Codememory
 */
abstract class MailException extends ErrorException
{

    /**
     * @param string|null $message
     */
    #[Pure]
    public function __construct(string $message = null)
    {

        parent::__construct($message ?: '');

    }

}