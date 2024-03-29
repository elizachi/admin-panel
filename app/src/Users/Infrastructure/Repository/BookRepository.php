<?php 

declare(strict_types=1);

namespace App\Users\Infrastructure\Repository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Users\Domain\Entity\Book;

class BookRepository extends ServiceEntityRepository {
    public function __construct(ManagerRegistry $registry) {
        parent::__construct($registry, Book::class);
    }

    public function getAllBooks(): array {
        return $this->findAll();
    }
}