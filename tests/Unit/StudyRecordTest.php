<?php
namespace Tests\Unit;

// require_once('../../app/Domain/StudyRecord/StudyRecord.php');

use PHPUnit\Framework\TestCase;
use App\Domain\StudyRecord\StudyRecord;

class StudyRecordTest extends TestCase
{
    public function test_equal_method()
    {
        $study_record = new StudyRecord(60);

        $this->assertEquals($study_record->getMinutes(), 60);
    }

    public function test_getHourMinutes()
    {
        $study_record = new StudyRecord(150);

        $this->assertEquals($study_record->getHourMinutes(), "2:30");
    }

    public function test_equal()
    {
        $study_record1 = new StudyRecord(60);
        $study_record2 = new StudyRecord(60);

        $this->assertTrue($study_record1->equal($study_record2));
    }

    public function test_add()
    {
        $study_record1 = new StudyRecord(60);
        $study_record2 = new StudyRecord(60);

        $study_record = $study_record1->add($study_record2);

        $this->assertEquals($study_record->getMinutes(), 120);
    }
}
