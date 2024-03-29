<?php

namespace App\Services\Calculator\Operations;

/**
 * Represent common behaviors of the arithmetic operations between two numbers
 */
interface OperatorInterface extends ArithmeticOperationInterface
{
    /**
     * Get the arithmetic operation sign (e.g: +, - ...).
     *
     * @return string.
     */
    public function getSign(): string;
}
