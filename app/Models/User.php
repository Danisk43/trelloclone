<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;



class User extends Authenticatable implements MustVerifyEmail, JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $fillable = ['first_name', 'last_name', 'email','password'];
    protected $table = 'users';
    protected $primaryKey='id';
    protected $attributes = [
        'is_verified' => 0,
    ];
    // public $timestamps = false;

    public function project_user()
    {
        return $this->belongsTo(ProjectUser::class);
    }

    public function task_user()
    {
        return $this->belongsTo(TaskUser::class);
    }

    public function comment()
    {
        return $this->hasMany(Comment::class);
    }

    public function projects()
    {
        return $this->belongsToMany(Project::class,'project_users');
    }

    public function tasks()
    {
        return $this->belongsToMany(Task::class,'task_users');
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

}
