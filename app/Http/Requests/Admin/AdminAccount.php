<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class AdminAccount extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'username' => 'min:5|max:16|required|unique:users,username,' . $this->route('id'),
            'email' => 'email|required|unique:users,email, ' . $this->route('id'),
            'first_name' => 'max:16',
            'last_name' => 'max:16',
            'company' => 'max:20',
            'address' => 'max:20',
            'city' => 'max:20',
            'country' => 'max:20',
            'state' => 'max:20',
            'zip' => 'max:20',
            'password' => 'min:6|confirmed',
            'avatar' => 'image',
        ];
    }

    public function messages(){

        return [
            'username.min'          => get_string('min_6'),
            'username.max'          => get_string('max_16'),
            'first_name'            => get_string('max_16'),
            'last_name'             => get_string('max_16'),
            'city'                  => get_string('max_20'),
            'state'                 => get_string('max_20'),
            'address'               => get_string('max_20'),
            'company'               => get_string('max_20'),
            'zip'                   => get_string('max_20'),
            'country'               => get_string('max_20'),
            'username.required'     => get_string('required_field'),
            'username.unique'       => get_string('not_unique_field'),
            'email.required'        => get_string('required_field'),
            'email.unique'          => get_string('not_unique_field'),
            'avatar.image'          => get_string('not_valid_image'),
            'password.min'          => get_string('min_6'),
            'password.confirmed'    => get_string('password_confirmed_error'),
            'avatar.dimensions'     => get_string('max_dimension_300'),
        ];
    }

}
