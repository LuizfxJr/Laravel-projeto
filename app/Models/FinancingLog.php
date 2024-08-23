<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FinancingLog extends Model
{
    protected $table = 'financing_logs';

    protected $fillable = [
        'action', 'user_id', 'financing_id'
    ];

    public function financing()
    {
        return $this->belongsTo(Financing::class, 'financing_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
