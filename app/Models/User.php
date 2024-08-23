<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'code', 
        'birth_date', 
        'address', 
        'number',
        'district', 
        'city', 
        'federative_unit', 
        'admission_date', 
        'user_level', 
        'workload', 
        'description',
        'file', 
        'occupation_id', 'work_shift_id', 'sector_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */

    protected $user_levels = ['administrator', 'supervisor', 'collaborator'];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function occupation()
    {
        return $this->belongsTo(Occupation::class);
    }

    public function sector()
    {
        return $this->belongsTo(Sector::class);
    }

    public function workShift()
    {
        return $this->belongsTo(WorkShift::class);
    }

    public function getUserLevels(){
        return $this->user_levels;
    }

    public function indexFilter(object $filters, ?int $quantity_per_page=5){
        return $this->with(['occupation', 'sector'])
        ->where(function ($query) use ($filters){
            if(isset($filters->search)){
                $query->where('name', 'LIKE', '%'.$filters->search.'%');
            }
        })
        ->whereHas('occupation', function($query) use ($filters){
            if(isset($filters->occupation_search)){
                $query->where('occupation_id', $filters->occupation_search);
            }
        })
        ->whereHas('sector', function($query) use ($filters){
            if(isset($filters->sector_search)){
                $query->where('sector_id', $filters->sector_search);
            }
        })
        ->orderBy('name', 'desc')->paginate($quantity_per_page);
    }

    public function collumnNull($column){
        return $this->update([$column => null]);
    }
}
