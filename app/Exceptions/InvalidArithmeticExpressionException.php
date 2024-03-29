<?php

namespace App\Exceptions;

use Exception;

class InvalidArithmeticExpressionException extends Exception
{
    public function __construct(string $message = 'Invalid arithmetic expression.')
    {
        parent::__construct($message);
    }
}
