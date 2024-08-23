<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'cpf',
        'rg',
        'birth_date',
        'shipping_date',
        'issuing_agency',
        'mother_name',
        'marital_status',
        'company',
        'work_regime',
        'profession',
        'gross_income',
        'net_income',
        'admission_date',
        'address',
        'address_number',
        'address_neighborhood',
        'address_city',
        'address_state',
        'address_cep',
        'user_id'
    ];


    protected $marital_status = ['solteiro', 'casado', 'divorciado', 'viuvo'];

    public function getMaritalStatus()
    {
        return $this->marital_status;
    }

    public function indexFilter(object $filters, ?int $quantity_per_page = 5)
    {
        return $this
            ->where(function ($query) use ($filters) {
                if (Auth::user()->user_level === 'collaborator') {
                    $query->where('user_id', '=',  Auth::user()->id);
                }
                if (isset($filters->search)) {
                    $query->where('name', 'LIKE', '%' . $filters->search . '%');
                }
                if (isset($filters->search_cpf)) {
                    $query->where('cpf', 'LIKE', '%' . $filters->search_cpf . '%');
                }
            })
            ->orderBy('name', 'desc')->paginate($quantity_per_page);
    }

    public function collumnNull($column)
    {
        return $this->update([$column => null]);
    }

    public function removePrefix($value)
    {
        // remove o prefixo "R$"
        $preco = str_replace('R$ ', '', $value);

        return $preco;
    }
}
