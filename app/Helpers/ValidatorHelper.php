<?php

namespace App\Helpers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class ValidatorHelper
{
    public static function ValidateForm(Request $request, $rules)
    {
        $validator = Validator::make($request->all(), $rules);
        return $validator->fails() ? false : true;
    }

    public static function ParseDate($date)
    {
        return Carbon::parse($date)->format("Y-m-d H:m:s");
    }
}
