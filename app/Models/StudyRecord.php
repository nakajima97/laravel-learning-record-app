<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class StudyRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'minute',
        'sub_category_id'
    ];

    public static function fetchTodayRecord($user_id)
    {
        $today = new Carbon();

        return StudyRecord::where('user_id', $user_id)
            ->where('created_at', '>=', $today->toDateString() . ' 00:00:00')
            ->where('created_at', '<=', $today->toDateString() . ' 23:59:59')
            ->get();
    }

    public function User()
    {
        return $this->belongsTo(User::class);
    }

    public function SubCategory()
    {
        return $this->belongsTo(SubCategory::class);
    }
}
