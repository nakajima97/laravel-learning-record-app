<?php

namespace Tests\Unit\Domain\StudyRecord;

use PHPUnit\Framework\TestCase;
use App\Domain\StudyRecord\StudyRecord;
use App\Domain\StudyTime\StudyTime;
use App\Domain\Category\CategoryEntity;

class StudyRecordTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_equal()
    {
        $study_time = new StudyTime(60);
        $main_category = new CategoryEntity(1, "メインカテゴリ");
        $sub_category = new CategoryEntity(2, "サブカテゴリ");

        $study_record1 = new StudyRecord(1, $study_time, $main_category, $sub_category);

        $study_record2 = new StudyRecord(1, $study_time, $main_category, $sub_category);

        $this->assertTrue($study_record1->equal($study_record2));
    }
}
