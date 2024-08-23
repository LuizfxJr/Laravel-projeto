<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Loans extends Model
{
    use HasFactory;

    protected $table = 'loans';

    protected $fillable = [
        'consigned_type', 'consigned_value', 'kind_benefit', 'registration', 'margin', 'bank',
        'agency', 'account', 'type_account', 'file_rg', 'file_cpf',
        'file_ir', 'file_cc', 'status', 'user_id', 'client_id', 'conclusion', 'observation'
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

    protected $status = ['Novo', 'Simulação', 'Simulação Aprovada', 'Andamento', 'Recusado', 'Aprovado'];

    public function getStatus()
    {
        return $this->status;
    }

    protected $type_account = ['Conta Corrente', 'Poupança'];

    public function getTypeAccount()
    {
        return $this->type_account;
    }
}
