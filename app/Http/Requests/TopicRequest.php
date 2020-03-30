<?php

namespace App\Http\Requests;

class TopicRequest extends Request
{
    public function rules()
    {
        switch($this->method())
        {
            // CREATE
            case 'POST':
            // UPDATE
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'title' => 'required|min:3',
                    'category_id' => 'required|numeric',
                    'body' => 'required|min:3',
                ];
            }
            case 'GET':
            case 'DELETE':
            default:
            {
                return [];
            }
        }
    }

    public function attributes()
    {
        return [
            'category_id' => '分类',
        ];
    }

    public function messages()
    {
        return [
            // Validation messages
        ];
    }
}
