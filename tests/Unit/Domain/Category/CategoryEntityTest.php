<?php

namespace Tests\Unit\Domain\Category;

use PHPUnit\Framework\TestCase;
use App\Domain\Category\CategoryEntity;

class CategoryEntityTest extends TestCase
{
    public function test_get_name()
    {
        $categoryEntity = new CategoryEntity(1, "初期値");
        $this->assertSame($categoryEntity->getName(), "初期値");
    }

    public function test_change_name()
    {
        $categoryEntity = new CategoryEntity(1, "初期値");
        $this->assertSame($categoryEntity->getName(), "初期値");

        $categoryEntity->changeName("変更後");
        $this->assertFalse($categoryEntity->getName() == "初期値");
        $this->assertSame($categoryEntity->getName(), "変更後");
    }

    public function test_equal_method()
    {
        $categoryEntity1 = new CategoryEntity(1, "テストカテゴリー");
        $categoryEntity2 = new CategoryEntity(1, "カテゴリー名は別");

        $this->assertTrue($categoryEntity1->equal($categoryEntity2));
    }
}
