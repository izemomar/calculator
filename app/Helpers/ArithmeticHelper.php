<?php

namespace App\Helpers;

class ArithmeticHelper
{

    /**
     * Remove spaces and special chars from provided arithmetic expression
     *
     * @return string
     */
    public static function cleanTheExpression(string $expression): string
    {
        // remove spaces
        $expression = str_replace(" ", "", $expression);

        // remove special chars
        $expression = trim($expression);

        return $expression;
    }

    /**
     * Whether provided expression a valid arithmetic expression
     *
     * This version verifies if the expression contains one operation like 3*4 , 2+4, -2*4, -2*-4
     * otherwise the expression is invalid
     *
     * @param string $expression arithmetic expression (e.g: 2+5)
     *
     * @return bool
     */
    public static function isValidArithmeticExpression(string $expression): bool
    {
        $_expression = static::cleanTheExpression($expression);
        return preg_match('/^\-?[0-9]+(\+|\-|\*|\/)\-?[0-9]+$/', $_expression);
    }
}