<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class CollaboratorCreateRequest extends FormRequest
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
            'code'              => ["required","unique:users,code,{$this->id}"],
            'name'              => ['required', 'string'],
            'user_level'        => ['required'],
            'description'       => ['nullable'],
            'file'              => ['nullable', 'image'],
            'occupation_id'     => ['required'],
            'sector_id'         => ['required'],
            'email'             => ['email', "unique:users,email,{$this->id}"],
            'password'          => 'required|confirmed|min:6'
        ];
    }
    
}
