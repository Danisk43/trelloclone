<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;
    protected $fillable = ['type','project_id'];


    public function task()
    {
        return $this->belongsToMany(Task::class);
    }

    public function project(){
        return $this->hasOne(Project::class);
    }
}
