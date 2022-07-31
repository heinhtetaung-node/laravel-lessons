<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Response;
use Illuminate\Http\Exceptions\HttpResponseException;

class UserPostRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules(Request $request)
    {
        $checkDuplicate = '';
        $checkPassword = '';
        if ($request->id == NULL) {
            $checkDuplicate = '|unique:custom_user';
            $checkPassword = '|required';
        }

        return [
            'name' => 'required',
            'nickname' => 'required_with:name',
            'password' => 'nullable|min:6'.$checkPassword,
            'email' => 'required|email'.$checkDuplicate,
            'address' => 'required|min:5',
            'id' => 'nullable|integer',
        ];
    }

    /**
     * Handle a failed validation attempt.
     *
     * @param  \Illuminate\Contracts\Validation\Validator  $validator
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function failedValidation(Validator $validator)
    {
        if (Request::is('api/*')) {
            throw new HttpResponseException(response()->json($validator->errors(), 422));
        }
        
        throw (new ValidationException($validator))
                    ->errorBag($this->errorBag)
                    ->redirectTo($this->getRedirectUrl());
    }

}
