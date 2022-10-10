<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
}

class Comment extends Model
{
    public function task()
    {
        return $this->belongsTo(Task::class);
    }
}