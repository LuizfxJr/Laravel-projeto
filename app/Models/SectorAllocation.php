<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SectorAllocation extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = ['description'];
    protected $table = 'sector_allocations';
}
