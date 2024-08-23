<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Helper extends Model
{
    use HasFactory;

    protected $federative_unit = [
        ['id'=>'AC','country'=>'brazil','description'=>'Acre'],
        ['id'=>'AL','country'=>'brazil','description'=>'Alagoas'],
        ['id'=>'AP','country'=>'brazil','description'=>'Amapá'],
        ['id'=>'AM','country'=>'brazil','description'=>'Amazonas'],
        ['id'=>'BA','country'=>'brazil','description'=>'Bahia'],
        ['id'=>'CE','country'=>'brazil','description'=>'Ceará'],
        ['id'=>'DF','country'=>'brazil','description'=>'Distrito Federal'],
        ['id'=>'ES','country'=>'brazil','description'=>'Espírito Santo'],
        ['id'=>'GO','country'=>'brazil','description'=>'Goiás'],
        ['id'=>'MA','country'=>'brazil','description'=>'Maranhão'],
        ['id'=>'MT','country'=>'brazil','description'=>'Mato Grosso'],
        ['id'=>'MS','country'=>'brazil','description'=>'Mato Grosso do Sul'],
        ['id'=>'MG','country'=>'brazil','description'=>'Minas Gerais'],
        ['id'=>'PA','country'=>'brazil','description'=>'Pará'],
        ['id'=>'PB','country'=>'brazil','description'=>'Paraíba'],
        ['id'=>'PR','country'=>'brazil','description'=>'Paraná'],
        ['id'=>'PE','country'=>'brazil','description'=>'Pernambuco'],
        ['id'=>'PI','country'=>'brazil','description'=>'Piauí'],
        ['id'=>'RJ','country'=>'brazil','description'=>'Rio de Janeiro'],
        ['id'=>'RN','country'=>'brazil','description'=>'Rio Grande do Norte'],
        ['id'=>'RS','country'=>'brazil','description'=>'Rio Grande do Sul'],
        ['id'=>'RO','country'=>'brazil','description'=>'Rondônia'],
        ['id'=>'RR','country'=>'brazil','description'=>'Roraima'],
        ['id'=>'SC','country'=>'brazil','description'=>'Santa Catarina'],
        ['id'=>'SP','country'=>'brazil','description'=>'São Paulo'],
        ['id'=>'SE','country'=>'brazil','description'=>'Sergipe'],
        ['id'=>'TO','country'=>'brazil','description'=>'Tocantins']
    ];

    public function getFederativeUnit(){
        return $this->federative_unit;
    }

}
