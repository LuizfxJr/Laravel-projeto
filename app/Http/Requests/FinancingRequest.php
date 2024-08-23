<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class FinancingRequest extends FormRequest
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
            'type_financing'    => ['required', 'string'],
            'type_product'      => ['required', 'string'],
            'cash_entry'        => ['required', 'string'],
            'bank_1'            => ['required', 'string'],
            'agency_1'          => ['required', 'string'],
            'account_1'         => ['required', 'string'],
            'type_account_1'    => ['required', 'string'],
            'bank_2'            => ['required', 'string'],
            'agency_2'          => ['required', 'string'],
            'account_2'         => ['required', 'string'],
            'type_account_2'    => ['required', 'string'],
            'file_rg'           => ['nullable', 'file_rg'],
            'file_cpf'          => ['nullable', 'file_cpf'],
            'file_ir'           => ['nullable', 'file_ir'],
            'file_cr'           => ['nullable', 'file_cr'],
            'status'            => ['nullable'],
            'user_id'           => ['required'],
            'client_id'         => ['required'],
            'conclusion'        => ['nullable'],
            'observation'       => ['nullable'],
        ];
    }
}
