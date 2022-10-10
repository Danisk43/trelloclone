<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'users';
    protected $primaryKey='id';
}

class User extends Model
{
    public function project_user()
    {
        return $this->belongsTo(Project_user::class);
    }
}

class User extends Model
{
    public function task_user()
    {
        return $this->belongsTo(Task_user::class);
    }
}

class User extends Model
{
    public function task()
    {
        return $this->hasMany(Task::class);
    }
}
