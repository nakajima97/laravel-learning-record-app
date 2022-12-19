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

    public function User()
    {
        return $this->belongsTo(User::class);
    }

    public function SubCategory()
    {
        return $this->belongsTo(SubCategory::class);
    }
}
