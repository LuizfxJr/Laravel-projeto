<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ponto extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'data',
        'hora_entrada',
        'hora_saida',
        'hora_intervalo_saida',
        'hora_intervalo_volta',
    ];

    protected $dates = [
        'data',
        'hora_entrada',
        'hora_saida',
        'hora_intervalo_saida',
        'hora_intervalo_volta',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
