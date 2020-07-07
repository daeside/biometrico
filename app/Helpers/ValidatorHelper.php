<?php

namespace App\Helpers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ValidatorHelper
{
    public static function ValidateForm(Request $request, $rules)
    {
        $validator = Validator::make($request->all(), $rules);
        return $validator->fails() ? false : true;
    }
}
