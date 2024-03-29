<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ArithmeticExpressionRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // '/^\-?[0-9]+(\+|\-|\*|\/)\-?[0-9]+$/'
        if (!preg_match('/^\-?[0-9]+(\+|\-|\*|\/)\-?[0-9]+$/', $value)) {
            $fail(':attribute should be a valid arithmetic expression');
        }
    }
}
