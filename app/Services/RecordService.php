<?php
namespace App\Services;

use Carbon\Carbon;
use App\Models\StudyRecord;

class RecordService
{
  public function getTodayRecords($user)
  {
    $today = Carbon::today();

    return $user->StudyRecords()
      ->whereBetween('created_at', [$today->startOfDay()->toDateTimeString(), $today->endOfDay()->toDateTimeString()])
      ->orderBy('created_at', 'desc')
      ->paginate(20);
  }
}
