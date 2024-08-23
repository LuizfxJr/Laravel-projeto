<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ClientRequest extends FormRequest
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
            'name'                  => ['required', 'string'],
            'email'                 => ['nullable', 'string'],
            'phone'                 => ['required', 'string'],
            'cpf'                   => ['required', 'string'],
            'rg'                    => ['required', 'string'],
            'birth_date'            => ['required', 'date'],
            'shipping_date'         => ['required', 'date'],
            'issuing_agency'        => ['required', 'string'],
            'mother_name'           => ['required', 'string'],
            'marital_status'        => ['required', 'string'],
            'company'               => ['required', 'string'],
            'work_regime'           => ['required', 'string'],
            'profession'            => ['required', 'string'],
            'gross_income'          => ['required'],
            'net_income'            => ['required'],
            'admission_date'        => ['required', 'date'],
            'address'               => ['required', 'string'],
            'address_number'        => ['required', 'string'],
            'address_neighborhood'  => ['required', 'string'],
            'address_city'          => ['required', 'string'],
            'address_state'         => ['required', 'string'],
            'address_cep'           => ['required', 'string']
        ];
    }
}
