<?php

namespace App\Domain\Category;

class CategoryEntity
{
  private readonly int $id;
  private string $name;

  function __construct(int $id, string $name) {
    $this->id = $id;
    $this->name = $name;
  }

  function changeName(string $name) {
    $this->name = $name;
  }

  function getName() {
    return $this->name;
  }

  function equal(CategoryEntity $categoryEntity) {
    return $this->id === $categoryEntity->id;
  }
}
