<?php

namespace App\Domain\StudyRecord;

use App\Domain\Category\CategoryEntity;
use App\Domain\StudyTime\StudyTime;

class StudyRecord
{
    private readonly int $id;
    private StudyTime $study_time;
    private CategoryEntity $main_category;
    private CategoryEntity $sub_category;

    public function __construct(int $id, StudyTime $study_time, CategoryEntity $main_category, CategoryEntity $sub_category)
    {
        $this->id = $id;
        $this->study_time = $study_time;
        $this->main_category = $main_category;
        $this->sub_category = $sub_category;
    }

    public function equal(StudyRecord $study_record)
    {
      return $this->id === $study_record->id;
    }

    public function getStudyTime()
    {
      return $this->study_time;
    }

    public function getMainCategory()
    {
      return $this->main_category;
    }

    public function getSubCategory()
    {
      return $this->sub_category;
    }

    public function changeStudyTime(StudyTime $study_time)
    {
      $this->study_time = $study_time;
    }

    public function changeMainCategory(Category $main_category)
    {
      $this->main_category = $main_category;
    }

    public function changeSubCategory(Category $sub_category)
    {
      $this->sub_category = $sub_category;
    }
}
