<?php

declare(strict_types=1);

namespace App\Entity\Factory;

use App\Entity\Book;

class BookFactory
{
    public function __construct() {
    }

    public function newBookInstance(string $title, int $publicationYear, int $ISBN, int $pageCount): Book {
        $author = new Book(
            $title,
            $publicationYear,
            $ISBN,
            $pageCount
        );

        return $author;
    }
}