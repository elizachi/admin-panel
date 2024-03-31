<?php 

declare(strict_types=1);

namespace App\Repository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Author;

class AuthorRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry, EntityManagerInterface $entityManager)
    {
        parent::__construct($registry, Author::class);
        $this->_em = $entityManager;
    }

    public function getAllAuthors(): array
    {
        return $this->findAll();
    }

    public function addAuthor(Author $author): Author
    {
        $this->_em->persist($author);
        $this->_em->flush();

        /**
         * Check that author has been added
         */
        $addedAuthor = $this->getAuthorById($author->getId());

        if( $addedAuthor ) {
            return $addedAuthor;
        } else {
            throw new \Exception("Author not added");
        }
    }

    public function removeAuthor(int $id): void
    {
        /**
         * Check if author exist
         */
        $existedAuthor = $this->getAuthorById($id);

        if ( $existedAuthor ) {
            $this->_em->remove($existedAuthor);
            $this->_em->flush();
        } else {
            throw new \Exception("Author with {$id} does not exist");
        }
    }

    public function getAuthorById(int $id): ?Author
    {
        return $this->_em->find(Author::class, $id);
    }
}