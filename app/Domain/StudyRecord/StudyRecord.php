<?php
namespace App\Domain\StudyRecord;

class StudyRecord
{
  private readonly int $minutes;

  function __construct(int $minutes)
  {
    if ($minutes <= 0) {
      throw new \Exception("値がマイナスです", 1);
    }

    $this->minutes = $minutes;
  }

  public function getMinutes()
  {
    return $this->minutes;
  }

  public function getHourMinutes()
  {
    $time = intdiv($this->minutes, 60);
    $minutes = $this->minutes - $time * 60;

    return (string)$time . ':' . $minutes;
  }

  public function equal(StudyRecord $study_record)
  {
    return $this->minutes === $study_record->getMinutes();
  }

  public function add(StudyRecord $study_record)
  {
    return new StudyRecord($this->minutes + $study_record->getMinutes());
  }
}
 