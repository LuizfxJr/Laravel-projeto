<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoanLog extends Model
{
    protected $table = 'loan_logs';

    protected $fillable = [
        'action', 'user_id', 'loan_id'
    ];

    public function loan()
    {
        return $this->belongsTo(Loans::class, 'loan_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
