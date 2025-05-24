<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

use App\Models\Workout;
use App\Models\Progress;
use App\Models\Plan;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role', // Eğer roller varsa (örneğin 'coach', 'user')
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // ✔️ Bir eğitmenin oluşturduğu antrenmanlar
    public function createdWorkouts()
    {
        return $this->hasMany(Workout::class, 'author_id');
    }

    // ✔️ Kullanıcıya atanmış antrenmanlar
    public function assignedWorkouts()
    {
        return $this->hasMany(Workout::class, 'user_id');
    }

    // ✔️ Kullanıcının antrenman ilerlemesi
    public function progress()
    {
        return $this->hasMany(Progress::class);
    }

    // ✔️ Kullanıcının planları
    public function plans()
    {
        return $this->hasMany(Plan::class);
    }
}
