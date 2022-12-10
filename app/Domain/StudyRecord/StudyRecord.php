<?php

namespace App\Domain\StudyRecord;

use App\Domain\Category;
use App\Domain\StudyTime;

class StudyRecord
{
    private readonly int $id;
    private StudyTime $study_time;
    private Category $main_category;
    private Category $sub_category;

    public function __construct(int $id, StudyTime $study_time, Category $main_category, Category $sub_category)
    {
        $this->id = $id;
        $this->study_time = $study_time;
        $this->main_category = $main_category;
        $this->sub_category = $sub_category;
    }
}
