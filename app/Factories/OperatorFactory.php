<?php

namespace App\Factories;

use App\Factories\Interfaces\OperatorFactoryInterface;
use App\Services\Calculator\Operations\Adder;
use App\Services\Calculator\Operations\Divider;
use App\Services\Calculator\Operations\Multiplicator;
use App\Services\Calculator\Operations\Subtractor;
use App\Services\Calculator\Operations\OperatorInterface;
use Exception;

/**
 * Create operators instances based on their arithmetic signs
 */
class OperatorFactory implements OperatorFactoryInterface
{

    /**
     * @var $operators
     */
    private static $operators = [
        Adder::class,
        Subtractor::class,
        Multiplicator::class,
        Divider::class,
    ];

    /**
     * @return OperatorInterface A New operator instance
     */
    public function create(string $sign): OperatorInterface
    {
        $_operator = null;

        // search operators by their sign
        foreach (self::$operators as $operator) {

            $operatorInstance = new $operator;
            if ($operatorInstance?->getSign() === $sign) {
                $_operator = $operatorInstance;
                break;
            }
        }

        if ($_operator instanceof OperatorInterface) return $_operator;
        else throw new Exception("Invalid operator");
    }
}
