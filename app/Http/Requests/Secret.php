<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Secret extends FormRequest
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
            'secret' => 'min:1|max:255|required',
            'expiration_time' => 'required|date_format:Y-m-d',
            'ttl' => 'min:1|required'
        ];
    }
}
