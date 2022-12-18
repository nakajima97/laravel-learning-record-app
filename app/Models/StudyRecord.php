<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudyRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'minute',
        'sub_category_id'
    ];
}
