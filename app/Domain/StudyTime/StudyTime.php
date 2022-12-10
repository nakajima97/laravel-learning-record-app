<?php

namespace App\Domain\StudyTime;

class StudyTime
{
    private readonly int $minutes;

    public function __construct(int $minutes)
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

    public function equal(StudyTime $study_record)
    {
        return $this->minutes === $study_record->getMinutes();
    }

    public function add(StudyTime $study_record)
    {
        return new StudyTime($this->minutes + $study_record->getMinutes());
    }
}
