<?php

declare(strict_types=1);

namespace App\Users\Domain\Entity;

class Author {
    private int $id;
    private string $name;
    private string $surname;

    private string $patronymic;

    public function __construct(
        string $name, string $surname, string $patronymic) {
        $this->name = $name;
        $this->surname = $surname;
        $this->patronymic = $patronymic;
    }
}