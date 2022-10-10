<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
 
    public function status()
    {
        return $this->hasOne(Status::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function task_user()
    {
        return $this->belongsTo(TaskUser::class);
    }

    public function comment()
    {
        return $this->hasMany(Comment::class);
    }
}


