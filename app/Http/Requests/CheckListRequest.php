<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class CheckListRequest extends FormRequest
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
            'customCheck1'                  => ['required'],
            'customCheck2'                  => ['required'],
            'customCheck3'                  => ['required'],
            'customCheck4'                  => ['required'],
            'customCheck5'                  => ['required'],
            'customCheck6'                  => ['required'],
            'customCheck7'                  => ['required'],
            'customCheck8'                  => ['required'],
            'customCheck9'                  => ['required'],
            'customCheck10'                  => ['required'],
            'customCheck11'                  => ['required'],
        ];
    }
}
