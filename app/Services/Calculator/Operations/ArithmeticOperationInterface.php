<?php

namespace App\Services\Calculator\Operations;

/**
 * Represent common behaviors of the arithmetic operations between two numbers
 */
interface ArithmeticOperationInterface
{
    /**
     * Perform an arithmetic operation on two given numbers.
     *
     * @param float $a The first number.
     * @param float $b The second number.
     *
     * @return float The result of performed operation on the parameters.
     */
    public function calculate(float $a, float $b): float;
}
