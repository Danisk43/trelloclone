<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;
}

class Status extends Model
{
    public function task()
    {
        return $this->belongsTo(Task::class);
    }
}