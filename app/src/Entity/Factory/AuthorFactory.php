<?php

declare(strict_types=1);

namespace App\Entity\Factory;

use App\Entity\Author;
use App\Security\Service\HashGenerator;

class AuthorFactory
{
    private HashGenerator $hashGenerator;
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