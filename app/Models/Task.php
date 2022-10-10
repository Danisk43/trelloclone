<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
}
 
class Task extends Model
{
    public function status()
    {
        return $this->hasOne(Status::class);
    }
}

class Task extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

class Task extends Model
{
    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}

class Task extends Model
{
    public function task_user()
    {
        return $this->belongsTo(Task_user::class);
    }
}

class Task extends Model
{
    public function comment()
    {
        return $this->hasMany(Comment::class);
    }
}


