<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    use HasFactory;

    protected $table = 'equipments';

    protected $fillable = [
        'name', 'register_date', 'provider', 'cnpj', 'phone', 'responsible',
        'description', 'equipment_type_id', 'sector_allocation_id'
    ];

    public function equipment_type()
    {
        return $this->belongsTo(EquipmentType::class);
    }

    public function sector_allocation()
    {
        return $this->belongsTo(SectorAllocation::class);
    }

    public function indexFilter(object $filters, ?int $quantity_per_page = 5)
    {
        return $this->with(['sector_allocation', 'equipment_type'])
            ->where(function ($query) use ($filters) {
                if (isset($filters->search)) {
                    $query->where('name', 'LIKE', '%' . $filters->search . '%');
                }
            })
            ->whereHas('sector_allocation', function ($query) use ($filters) {
                if (isset($filters->sector_allocation_search)) {
                    $query->where('sector_allocation_id', $filters->sector_allocation_search);
                }
            })
            ->whereHas('equipment_type', function ($query) use ($filters) {
                if (isset($filters->equipment_type_search)) {
                    $query->where('equipment_type_id', $filters->equipment_type_search);
                }
            })
            ->orderBy('name', 'desc')->paginate($quantity_per_page);
    }

    public function exportFilter(object $filters)
    {
        return $this->with(['sector_allocation', 'equipment_type'])
            ->where(function ($query) use ($filters) {
                if (isset($filters->search)) {
                    $query->where('name', 'LIKE', '%' . $filters->search . '%');
                }
            })
            ->whereHas('sector_allocation', function ($query) use ($filters) {
                if (isset($filters->sector_allocation_search)) {
                    $query->where('sector_allocation_id', $filters->sector_allocation_search);
                }
            })
            ->whereHas('equipment_type', function ($query) use ($filters) {
                if (isset($filters->equipment_type_search)) {
                    $query->where('equipment_type_id', $filters->equipment_type_search);
                }
            })
            ->orderBy('name', 'desc')->get();
    }

    public function collumnNull($column)
    {
        return $this->update([$column => null]);
    }
}
