<?php 

declare(strict_types=1);

namespace App\Users\Infrastructure\Repository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Users\Domain\Entity\Author;

class AuthorRepository extends ServiceEntityRepository {
    public function __construct(ManagerRegistry $registry) {
        parent::__construct($registry, Author::class);
    }

    public function getAllAuthors(): array {
        return $this->findAll();
    }
}