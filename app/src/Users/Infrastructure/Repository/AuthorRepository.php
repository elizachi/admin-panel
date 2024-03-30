<?php 

declare(strict_types=1);

namespace App\Users\Infrastructure\Repository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Author;

class AuthorRepository extends ServiceEntityRepository {
    public function __construct(ManagerRegistry $registry, EntityManagerInterface $entityManager) {
        parent::__construct($registry, Author::class);
        $this->_em = $entityManager;
    }

    public function getAllAuthors(): array {
        return $this->findAll();
    }

    public function addAuthor(Author $author): void {
        $this->_em->persist($author);
        $this->_em->flush();
    }
}