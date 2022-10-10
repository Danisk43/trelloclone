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

    public function project_user()
    {
        return $this->belongsTo(ProjectUser::class);
    }

    public function task_user()
    {
        return $this->belongsTo(TaskUser::class);
    }

    public function task()
    {
        return $this->hasMany(Task::class);
    }

    public function comment()
    {
        return $this->hasMany(Comment::class);
    }
}
