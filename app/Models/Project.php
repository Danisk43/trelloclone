<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'owner_id'];

    public function project_user()
    {
        return $this->belongsTo(ProjectUser::class);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function status()
    {
        return $this->hasMany(Status::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class,'project_users');
    }
}