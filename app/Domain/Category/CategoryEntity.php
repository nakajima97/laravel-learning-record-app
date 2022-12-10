<?php

namespace App\Domain\Category;

class CategoryEntity
{
    private readonly int $id;
    private string $name;

    public function __construct(int $id, string $name)
    {
        $this->id = $id;
        $this->name = $name;
    }

    public function changeName(string $name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function equal(CategoryEntity $categoryEntity)
    {
        return $this->id === $categoryEntity->id;
    }
}
