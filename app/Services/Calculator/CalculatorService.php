<?php

namespace App\Services\Calculator;

use App\Factories\Interfaces\OperatorFactoryInterface;
use ArithmeticError;
use DivisionByZeroError;
use App\Services\Calculator\Operations\ArithmeticOperationContext;
use App\Helpers\ArithmeticHelper;
use App\Exceptions\InvalidArithmeticExpressionException;

class CalculatorService implements CalculatorServiceInterface
{
    public function __construct(protected OperatorFactoryInterface $operatorFactory)
    {
    }
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
    public function calculate(string $expression): float
    {
        if (ArithmeticHelper::isValidArithmeticExpression($expression)) {
            $operator = $this->operatorFactory->create(
                    $this->extractOperatorFromExpression($expression)
            );

            $arithmeticContext = new ArithmeticOperationContext($operator);

            return $arithmeticContext->calculate(
                $this->getTheFirstNumber($expression),
                $this->getTheSecondNumber($expression)
            );

        } else {
            $this->throwInvalidExpression();
        }
    }

    /**
     * @param string $expression
     *
     * @return string The operation sign
     *
     * @example 4+7 will return '+'
     */
    private function extractOperatorFromExpression(string $expression): string
    {
        $_expression = ArithmeticHelper::cleanTheExpression($expression);
        $_expressionAsArray = str_split($_expression); // 2+3 => ['2' , '+' , '3']
        $foundedOperators = array_values(preg_grep("(\+|\-|\*|\/)", $_expressionAsArray));

        if (count($foundedOperators) > 1) // means one of the numbers is negative
        {
            // check if the first number negative
            if ($foundedOperators[0] === "-" && $_expressionAsArray[0] === "-")
                return $foundedOperators[1];
        }

        return $foundedOperators[0];
    }

    /**
     * Extract the first number from provided expression
     *
     * @param string $expression
     *
     * @return float
     *
     * @throws InvalidArithmeticExpressionException
     *
     * @example 2+6 will return 2
     */
    private function getTheFirstNumber(string $expression): float
    {
        $_expression = ArithmeticHelper::cleanTheExpression($expression);

        preg_match_all('/\-?[0-9]+/', $_expression, $matches);
        if (count($matches) > 0 && count($matches[0]) > 1)
            return (float)$matches[0][0];

        $this->throwInvalidExpression();
    }

    /**
     * Extract the second number from provided expression
     *
     * @param string $expression
     *
     * @return float
     *
     * @throws InvalidArithmeticExpressionException
     *
     * @example 2+6 will return 6 and 2 * -4 will return -4
     */
    private function getTheSecondNumber(string $expression): float
    {
        $_expression = ArithmeticHelper::cleanTheExpression($expression);

        // search for the second number in the expression including the operator (e.g -3 or *-5 ...)
        preg_match_all('/(\+|\-|\*|\/)\-?[0-9]+/', $_expression, $matches);

        /**
         * @example $matches if $expression = -2+-8
         *
         * array:2 [
         *  0 => array:2 [
         *    0 => "-2"
         *    1 => "+-8"
         *  ]
         *  1 => array:2 [
         *    0 => "-"
         *    1 => "+"
         *  ]
         * ]
         */
        if (count($matches) > 0 && count($matches[0]) >= 1) {
            $theSecondNumber = $matches[0][count($matches[0]) - 1];

            $operatorsCount = preg_match_all('/(\+|\-|\*|\/)/', $theSecondNumber);

            // remove the first operator if we got something like: +-3, *-4
            if ($operatorsCount > 1) {
                $theSecondNumber = substr($theSecondNumber, 1);

                // remove the second operator if it not a negative sign (-)
                if (!preg_match('/\-/', $theSecondNumber))
                    $theSecondNumber = substr($theSecondNumber, 1);

                return (float)$theSecondNumber;
            } elseif ($operatorsCount === 1) {
                $theSecondNumber = substr($theSecondNumber, 1);
                return (float)$theSecondNumber;
            }
        }

        $this->throwInvalidExpression();
    }

    /**
     * @throws InvalidArithmeticExpressionException
     */
    private function throwInvalidExpression()
    {
        throw new InvalidArithmeticExpressionException();
    }
}
