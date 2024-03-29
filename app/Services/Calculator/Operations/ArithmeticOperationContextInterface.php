<?php

namespace App\Services\Calculator\Operations;

use ArithmeticError;
use DivisionByZeroError;

/**
 * Perform different arithmetic operations
 */
interface ArithmeticOperationContextInterface extends ArithmeticOperationInterface
{
    /**
     * Set the operation instance to use.
     *
     * @param OperatorInterface $operator The calculation strategy
     */
    public function setOperator(OperatorInterface $operator): ArithmeticOperationContextInterface;

    /**
     * Get the operation in use.
     *
     * @return OperatorInterface
     */
    public function getOperator(): OperatorInterface;
}
