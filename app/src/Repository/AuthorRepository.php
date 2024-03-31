<?php 

declare(strict_types=1);

namespace App\Repository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Component\HttpFoundation\Response;
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

    public function addAuthor(Author $author): Response
    {

        /**
         * Check that such author does not exist
         */
        if ($this->isExist($author)) {
            return new Response('Author with this name, surname and patronimyc already exist', Response::HTTP_BAD_REQUEST);
        }

        $this->_em->persist($author);
        $this->_em->flush();

        /**
         * Check that author has been added
         */
        $addedAuthor = $this->getAuthorById($author->getId());

        if( $addedAuthor ) {
            return new Response('Author was created successfully', Response::HTTP_OK);
        } else {
            throw new \Exception('Author not added');
        }
    }

    public function removeAuthor(int $id): Response
    {
        /**
         * Check if author exist
         */
        $existedAuthor = $this->getAuthorById($id);

        if ( $existedAuthor ) {
            $this->_em->remove($existedAuthor);
            $this->_em->flush();
        } else {
            return new Response('Author with id = ' . $id . ' does not exist', Response::HTTP_BAD_REQUEST);
        }
        return new Response('Author was deleted successfully', Response::HTTP_OK);
    }

    public function getAuthorById(int $id): ?Author
    {
        return $this->_em->find(Author::class, $id);
    }

    private function isExist(Author $author): bool
    {
        $author = $this->findOneBy([
            'name' => $author->getName(),
            'surname' => $author->getSurname(),
            'patronymic' => $author->getPatronymic(),
        ]);
        return $author !== null;
    }
}