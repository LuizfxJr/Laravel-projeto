<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Financing extends Model
{
    use HasFactory;

    protected $table = 'financings';

    protected $fillable = [
        'type_financing', 'type_product', 'value_product', 'cash_entry', 'bank_1', 'agency_1',
        'account_1', 'type_account_1', 'bank_2', 'agency_2', 'account_2',
        'type_account_2', 'file_rg', 'file_cpf', 'file_ir', 'file_cr', 'status', 'user_id',
        'client_id', 'conclusion', 'observation'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function indexFilter(object $filters, ?int $quantity_per_page = 5)
    {
        return $this->with(['user', 'client'])
            ->where(function ($query) use ($filters) {
                if (Auth::user()->user_level === 'collaborator') {
                    $query->where('user_id', '=',  Auth::user()->id);
                }
                if (isset($filters->client)) {
                    $query->where('client_id', 'LIKE', '%' . $filters->client . '%');
                }
                if (isset($filters->user)) {
                    $query->where('user_id', 'LIKE', '%' . $filters->user . '%');
                }
                if (isset($filters->status)) {
                    $query->where('status', 'LIKE', '%' . $filters->status . '%');
                }
            })
            // ->whereHas('equipment_type', function ($query) use ($filters) {
            //     if (isset($filters->equipment_type_search)) {
            //         $query->where('equipment_type_id', $filters->equipment_type_search);
            //     }
            // })
            ->paginate($quantity_per_page);
    }

    // public function exportFilter(object $filters)
    // {
    //     return $this->with(['sector_allocation', 'equipment_type'])
    //         ->where(function ($query) use ($filters) {
    //             if (isset($filters->search)) {
    //                 $query->where('name', 'LIKE', '%' . $filters->search . '%');
    //             }
    //         })
    //         ->whereHas('sector_allocation', function ($query) use ($filters) {
    //             if (isset($filters->sector_allocation_search)) {
    //                 $query->where('sector_allocation_id', $filters->sector_allocation_search);
    //             }
    //         })
    //         ->whereHas('equipment_type', function ($query) use ($filters) {
    //             if (isset($filters->equipment_type_search)) {
    //                 $query->where('equipment_type_id', $filters->equipment_type_search);
    //             }
    //         })
    //         ->orderBy('name', 'desc')->get();
    // }

    public function collumnNull($column)
    {
        return $this->update([$column => null]);
    }

    protected $type_financing = ['Imóvel', 'Carro', 'Moto'];

    public function getTypeFinancing()
    {
        return $this->type_financing;
    }

    protected $type_product = ['Novo', 'Usado'];

    public function getTypeProduct()
    {
        return $this->type_product;
    }

    protected $type_account = ['Conta Corrente', 'Poupança'];

    public function getTypeAccount()
    {
        return $this->type_account;
    }

    protected $status1 = ['Novo', 'Simulação', 'Simulação Aprovada', 'Andamento', 'Recusado', 'Aprovado'];
    protected $status = [
        'Novo', 'Análise Interna', 'Pré Aprovado', 'Recolhimento de documentos cliente',
        'Abertura de conta/tranferencia', 'Aprovado', 'Buscando Imóvel', 'Recolhimento de documentos/vendedor',
        'Vistoria', 'Análise de documentos', 'Contrato', 'Cartório', 'Anexo de Matricula/Contrato', 'Finalizado/Pago aos Vendedores', 'Negado'
    ];

    public function getStatus()
    {
        return $this->status;
    }
}
