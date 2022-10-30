<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    use HasFactory;

    public function lecture()
    {
        return $this->hasOne(Lecture::class, 'id', 'lecture_id');
    }
}
