<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class AuthUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        if(request()->routeIs('auth.signup')){
         $return = [
            'name'          => 'required|unique:users',
            'email'         => 'required|email|unique:users,email',
            'password'      => 'required|confirmed:password|min:6',
            'phone_number'  => 'required|unique:users',
            'profile_photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'certificate'   => 'required|mimes:pdf|max:2048' ];}
            else if (request()->routeIs('auth.login')){
                $return = [
                    'email'         => 'required|email',
                    'password'      => 'required|min:6',
                    'phone_number'  => 'required|',
                ];
            }

        return $return;
    }

    protected function failedValidation(Validator $validator)
{
    $errors = $validator->errors();

    $response = response()->json([
        'message' => 'Validation Error',
        'details' => $errors->messages(),
    ], 422);

    throw new HttpResponseException($response);
    }

}
