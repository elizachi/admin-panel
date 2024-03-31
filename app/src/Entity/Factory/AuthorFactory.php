<?php

declare(strict_types=1);

namespace App\Entity\Factory;

use App\Entity\Author;

class AuthorFactory
{
    public function __construct() {
    }

    public function newAuthorInstance(string $name, string $surname, string $patronymic): Author {
        $author = new Author(
            $name,
            $surname,
            $patronymic
        );

        return $author;
    }
}