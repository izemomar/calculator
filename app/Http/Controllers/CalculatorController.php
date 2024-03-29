<?php

namespace App\Http\Controllers;

use App\Exceptions\InvalidArithmeticExpressionException;
use Inertia\Inertia;
use Ramsey\Uuid\Math\CalculatorInterface;
use App\Http\Requests\CalculateExpressionRequest;
use Exception;
use DivisionByZeroError;
use App\Services\Calculator\CalculatorServiceInterface;

class CalculatorController extends Controller
{

    public function __construct(protected CalculatorServiceInterface $calculator)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // show the calculator view with inertia
        return Inertia::render('Calculator');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CalculateExpressionRequest $request)
    {
        try {
            $expression = $request->validated("expression");
            $result = $this->calculator->calculate($expression);

            return Inertia::render('Calculator', [
                'result' => $result,
                'expression' => $expression,
                'success' => true
            ]);

        } catch (InvalidArithmeticExpressionException | DivisionByZeroError $e) {
            return Inertia::render('Calculator', [
                'message' => $e->getMessage(),
                'success' => false
            ]);
        } catch (Exception $e) {
            return Inertia::render('Calculator', [
                'message' => 'An error occurred while calculating the expression.',
                'success' => false
            ]);
        }
    }
}
