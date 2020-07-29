<?php

namespace App\Http\Validator;

use Illuminate\Validation\Validator;

class IsCustomValidator extends Validator
{
    public function validateIsCustom($attribute, $value, $parameters)
    {
        return $value == 1;
    }
}
