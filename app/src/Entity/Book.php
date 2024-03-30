<?php

declare(strict_types=1);

namespace App\Entity;

class Book {
    private int $id;
    private string $title;
    private int $publicationYear;

    private int $ISBN;

    private int $pageCount;

    public function __construct(
        string $title, int $publicationYear, int $ISBN, int $pageCount) {
        $this->title = $title;
        $this->publicationYear = $publicationYear;
        $this->ISBN = $ISBN;
        $this->pageCount = $pageCount;
    }

    public function __toString() {
        return $this->title;
    }

    public function getTitle(): string {
        return $this->title;
    }
}