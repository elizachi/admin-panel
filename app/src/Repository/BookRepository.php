<?php 

declare(strict_types=1);

namespace App\Repository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Book;

class BookRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry, EntityManagerInterface $entityManager)
    {
        parent::__construct($registry, Book::class);
        $this->_em = $entityManager;
    }

    public function getAllBooks(): array
    {
        return $this->findAll();
    }

    public function addBook(Book $book): void
    {
        $this->_em->persist($book);
        $this->_em->flush();
    }

    public function removeBook(int $id): void
    {
        /**
         * Check if book exist
         */
        $existedBook = $this->getBookById($id);

        if ($existedBook) {
            $this->_em->remove($existedBook);
            $this->_em->flush();
        } else {
            throw new \Exception("Book with {$id} does not exist");
        }
    }

    public function getBookById(int $id): ?Book
    {
        return $this->_em->find(Book::class, $id);
    }
}