<?php 

declare(strict_types=1);

namespace App\Repository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Component\HttpFoundation\Response;
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

    public function addBook(Book $book): Response
    {
        /**
         * Check that such book does not exist
         */
        if ($this->isExist($book)) {
            return new Response('Such book already exist', Response::HTTP_BAD_REQUEST);
        }

        $this->_em->persist($book);
        $this->_em->flush();

        /**
         * Check that book has been added
         */
        $addedBook = $this->getBookById($book->getId());

        if( $addedBook ) {
            return new Response('Book was created successfully', Response::HTTP_OK);
        } else {
            throw new \Exception('Book not added');
        }
    }

    public function removeBook(int $id): Response
    {
        /**
         * Check if book exist
         */
        $existedBook = $this->getBookById($id);

        if ($existedBook) {
            $this->_em->remove($existedBook);
            $this->_em->flush();
        } else {
            return new Response('Book with id = ' . $id . ' does not exist', Response::HTTP_BAD_REQUEST);
        }
        return new Response('Book was deleted successfully', Response::HTTP_OK);
    }

    public function getBookById(int $id): ?Book
    {
        return $this->_em->find(Book::class, $id);
    }

    private function isExist(Book $book): bool
    {
        $bookTitleISBN = $this->findOneBy([
            'title' => $book->getTitle(),
            'ISBN' => $book->getISBN(),
        ]);

        $bookTitleYear = $this->findOneBy([
            'title' => $book->getTitle(),
            'publicationYear' => $book->getPublicationYear(),
        ]);
        return $bookTitleISBN !== null || $bookTitleYear !== null;
    }
}