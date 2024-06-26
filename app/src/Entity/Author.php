<?php

declare(strict_types=1);

namespace App\Entity;

class Author
{
    private int $authorId;
    private string $name;
    private string $surname;

    private string $patronymic;

    public function __construct(string $name, string $surname, string $patronymic)
    {
        $this->name = $name;
        $this->surname = $surname;
        $this->patronymic = $patronymic;
    }

    public function __toString()
    {
        $stringAuthor = $this->name . ' ' . $this->surname . ' ' . $this->patronymic;
        return $stringAuthor;
    }

    public function getId(): int
    {
        return $this->authorId;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getSurname(): string
    {
        return $this->surname;
    }

    public function getPatronymic(): string
    {
        return $this->patronymic;
    }
}