<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    public function project_user()
    {
        return $this->belongsTo(ProjectUser::class);
    }

    public function task()
    {
        return $this->hasMany(Task::class);
    }

    public function status()
    {
        return $this->hasMany(Status::class);
    }

    public function users()
    {
        return $this->hasManyThrough(User::class,ProjectUser::class);
    }
}