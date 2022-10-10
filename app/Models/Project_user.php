<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project_user extends Model
{
    use HasFactory;
}

class Project_user extends Model
{
    public function user()
    {
        return $this->hasMany(User::class);
    }
}

class Project_user extends Model
{
    public function project()
    {
        return $this->hasMany(Project::class);
    }
}