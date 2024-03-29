<?php

namespace App\Services\Calculator;

use App\Factories\Interfaces\OperatorFactoryInterface;
use ArithmeticError;
use DivisionByZeroError;

interface CalculatorServiceInterface
{
    /**
     * Calculate provided arithmetic expression
     *
     * This version accepts only one operation per expression (3+3 , 4*2 ...)
     *
     * @param string $expression arithmetic expression (e.g: 2+5)
     *
     * @return float The result
     *
     * @throws InvalidArithmeticExpressionException|DivisionByZeroError
     */
    public function calculate(string $expression): float;
}
