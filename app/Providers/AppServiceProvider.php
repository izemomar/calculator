<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {

        $this->app->bind(
            \App\Factories\Interfaces\OperatorFactoryInterface::class,
            \App\Factories\OperatorFactory::class
        );

        $this->app->bind(
            \App\Services\Calculator\Operations\ArithmeticOperationContextInterface::class,
            \App\Services\Calculator\Operations\ArithmeticOperationContext::class
        );

        $this->app->bind(
            \App\Services\Calculator\CalculatorServiceInterface::class,
            \App\Services\Calculator\CalculatorService::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
