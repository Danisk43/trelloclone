<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
}

class Project extends Model
{
    public function project_user()
    {
        return $this->belongsTo(Project_user::class);
    }
}

class Project extends Model
{
    public function task()
    {
        return $this->hasMany(Task::class);
    }
}