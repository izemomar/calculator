<?php

namespace App\Factories\Interfaces;

use App\Services\Calculator\Operations\OperatorInterface;

interface OperatorFactoryInterface
{
    /**
     * Create an operator instance based on the given operator sign.
     *
     * @param string $sign The operator sign.
     *
     * @return OperatorInterface The operator instance.
     */
    public function create(string $sign): OperatorInterface;
}