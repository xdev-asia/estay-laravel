<?php

namespace Froiden\LaravelInstaller\Request;

use Illuminate\Foundation\Http\FormRequest;
use Froiden\LaravelInstaller\Helpers\Reply;

class CoreRequest extends FormRequest
{

    protected function formatErrors(\Illuminate\Contracts\Validation\Validator $validator)
    {
        return Reply::formErrors($validator);
    }

}