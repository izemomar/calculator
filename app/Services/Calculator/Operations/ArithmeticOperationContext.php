<?php

namespace App\Services\Calculator\Operations;

use ArithmeticError;
use DivisionByZeroError;

/**
 * Perform different arithmetic operations
 */
class ArithmeticOperationContext implements ArithmeticOperationContextInterface
{
    /**
     * The strategy instance in use.
     *
     * @var OperatorInterface | null
     */
    private $operator;

    /**
     * @param OperatorInterface $operator The strategy instance to use.
     */
    function __construct(OperatorInterface $operator)
    {
        $this->operator = $operator;
    }

    /**
     * Set the operation instance to use.
     *
     * @param OperatorInterface $operator The calculation strategy
     */
    public function setOperator(OperatorInterface $operator): ArithmeticOperationContext
    {
        $this->operator = $operator;
        return $this;
    }

    /**
     * Get the operation in use.
     *
     * @return OperatorInterface
     */
    public function getOperator(): OperatorInterface
    {
        return $this->operator;
    }

    /**
     * Perform an arithmetic operation on two given numbers.
     *
     * @param float $a The first number.
     * @param float $b The second number.
     *
     * @return float The result of performed operation on the parameters.
     *
     * @throws ArithmeticError|DivisionByZeroError
     */
    public function calculate(float $a, float $b): float
    {
        if ($this->operator !== null) {
            try {
                return $this->operator->calculate($a, $b);
            } catch (DivisionByZeroError $e) {
                throw $e;
            }
        } else throw new ArithmeticError("No operation was provided");
    }
}
