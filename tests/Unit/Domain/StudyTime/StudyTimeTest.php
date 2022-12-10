<?php
namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Domain\StudyTime\StudyTime;

class StudyTimeTest extends TestCase
{
    public function test_equal_method()
    {
        $study_time = new StudyTime(60);

        $this->assertEquals($study_time->getMinutes(), 60);
    }

    public function test_getHourMinutes()
    {
        $study_time = new StudyTime(150);

        $this->assertEquals($study_time->getHourMinutes(), "2:30");
    }

    public function test_equal()
    {
        $study_time1 = new StudyTime(60);
        $study_time2 = new StudyTime(60);

        $this->assertTrue($study_time1->equal($study_time2));
    }

    public function test_add()
    {
        $study_time1 = new StudyTime(60);
        $study_time2 = new StudyTime(60);

        $study_time = $study_time1->add($study_time2);

        $this->assertEquals($study_time->getMinutes(), 120);
    }
}
