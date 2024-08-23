<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class LoanRequest extends FormRequest
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
            'consigned_type'    => ['required', 'string'],
            'consigned_value'   => ['required', 'string'],
            'kind_benefit'      => ['required', 'string'],
            'registration'      => ['required', 'string'],
            'margin'            => ['required', 'string'],
            'bank'              => ['required', 'string'],
            'agency'            => ['required', 'string'],
            'account'           => ['required', 'string'],
            'type_account'      => ['required', 'string'],
            'file_rg'           => ['nullable', 'file_rg'],
            'file_cpf'          => ['nullable', 'file_cpf'],
            'file_ir'           => ['nullable', 'file_ir'],
            'file_cc'           => ['nullable', 'file_cr'],
            'status'            => ['nullable'],
            'user_id'           => ['required'],
            'client_id'         => ['required'],
            'conclusion'        => ['nullable'],
            'observation'       => ['nullable'],
        ];
    }
}
