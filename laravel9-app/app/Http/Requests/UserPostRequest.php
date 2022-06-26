<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

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
        $checkDuplicate = ($request->id == NULL)? '|unique:custom_user' : '';
        
        return [
            'name' => 'required',
            'nickname' => 'required_with:name',
            'email' => 'required|email'.$checkDuplicate,
            'address' => 'required|min:5',
            'id' => 'nullable|integer',
        ];
    }
}
