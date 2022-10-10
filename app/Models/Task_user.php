<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task_user extends Model
{
    use HasFactory;
}

class Task_user extends Model
{
    public function user()
    {
        return $this->hasOne(User::class);
    }
}

class Task_user extends Model
{
    public function task()
    {
        return $this->hasMany(Task::class);
    }
}