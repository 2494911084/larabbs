<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'name' => 'required|min:3|unique:users,name,' . \Auth::id(),
            'email' => 'required|email',
            'avatar' => 'dimensions:min_width=416,min_height=416',
            'introduction' => 'max:80',
        ];
    }

    public function attributes()
    {
        return [
            'avatar' => '头像',
        ];
    }
}
