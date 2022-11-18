<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'description','status_id','attachment','project_id','user_id'];

 
    public function status()
    {
        return $this->hasOne(Status::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class,'task_users');
    }

    public function comment()
    {
        return $this->hasMany(Comment::class);
    }
}


