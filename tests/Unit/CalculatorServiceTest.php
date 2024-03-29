<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Services\Calculator\CalculatorService;
use App\Services\Calculator\CalculatorServiceInterface;
use App\Services\Calculator\Operations\ArithmeticOperationContext;
use App\Exceptions\InvalidArithmeticExpressionException;
use App\Services\Calculator\Operations\OperatorInterface;
use App\Services\Calculator\Operations\Adder;
use App\Services\Calculator\Operations\Subtractor;
use App\Services\Calculator\Operations\Multiplicator;
use App\Services\Calculator\Operations\Divider;
use App\Factories\Interfaces\OperatorFactoryInterface;


class CalculatorServiceTest extends TestCase
{
    public function testCalculate_Addition()
    {
        $operatorFactory = $this->createMock(OperatorFactoryInterface::class);
        $operatorFactory->method('create')
                        ->willReturn(new Adder());

        $calculatorService = new CalculatorService($operatorFactory);

        $result = $calculatorService->calculate("2+3");
        $this->assertEquals(5, $result);
    }

    public function testCalculate_Subtraction()
    {
        
        $operatorFactory = $this->createMock(OperatorFactoryInterface::class);
        $operatorFactory->method('create')
                        ->willReturn(new Subtractor());

        
        $calculatorService = new CalculatorService($operatorFactory);

        
        $result = $calculatorService->calculate("5-3");
        $this->assertEquals(2, $result);
    }

    public function testCalculate_Multiplication()
    {
        
        $operatorFactory = $this->createMock(OperatorFactoryInterface::class);
        $operatorFactory->method('create')
                        ->willReturn(new Multiplicator());

        
        $calculatorService = new CalculatorService($operatorFactory);

        
        $result = $calculatorService->calculate("5*3");
        $this->assertEquals(15, $result);
    }

    public function testCalculate_Division()
    {
        
        $operatorFactory = $this->createMock(OperatorFactoryInterface::class);
        $operatorFactory->method('create')
                        ->willReturn(new Divider());

        
        $calculatorService = new CalculatorService($operatorFactory);

        
        $result = $calculatorService->calculate("6/3");
        $this->assertEquals(2, $result);
    }

    public function testCalculate_InvalidExpression()
    {
        
        $operatorFactory = $this->createMock(OperatorFactoryInterface::class);
        $operatorFactory->method('create')
                        ->willReturn(new Adder());

        
        $calculatorService = new CalculatorService($operatorFactory);

        
        $this->expectException(InvalidArithmeticExpressionException::class);
        $calculatorService->calculate("2+3+4");
    }

    public function testCalculate_DivisionByZero()
    {
        
        $operatorFactory = $this->createMock(OperatorFactoryInterface::class);
        $operatorFactory->method('create')
                        ->willReturn(new Divider());

        
        $calculatorService = new CalculatorService($operatorFactory);

        
        $this->expectException(\DivisionByZeroError::class);
        $calculatorService->calculate("2/0");
    }

    public function testCalculate_InvalidOperator()
    {
        
        $operatorFactory = $this->createMock(OperatorFactoryInterface::class);
        $operatorFactory->method('create')
                        ->willThrowException(new \Exception());

        
        $calculatorService = new CalculatorService($operatorFactory);

        
        $this->expectException(\Exception::class);
        $calculatorService->calculate("2+3");
    }

}
