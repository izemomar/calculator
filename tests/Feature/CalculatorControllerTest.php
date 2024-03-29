<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Route;
use Tests\TestCase;
use App\Services\Calculator\CalculatorServiceInterface;

class CalculatorControllerTest extends TestCase
{
    /** @test */
    public function it_displays_the_calculator_page()
    {
        $response = $this->get(route('calculator.index'));

        $response->assertStatus(200);
        $response->assertSee('Calculator');
    }

    /** @test */
    public function it_can_calculate_expression()
    {
        $response = $this->post(route('calculator.store'), [
            'expression' => '2+3',
        ]);

        $response->assertStatus(200);
        $response->assertSee('5');
    }

    /** @test */
    public function it_returns_error_for_invalid_expression()
    {
        $response = $this->post(route('calculator.store'), [
            'success' => false,
            'message' => 'Invalid expression',
        ]);

        $response->assertStatus(302);
        $response->assertDontSee('5'); // Ensuring the result is not displayed
    }
}
