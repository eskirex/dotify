<?php

namespace Eskirex\Component\Dotify\Exceptions;

use Throwable;

class InvalidArgumentException extends \Exception
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}