<?php 

namespace App\Service;
use Symfony\Component\DependencyInjection\Loader\Configurator\AbstractServiceConfigurator;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Repository\BookRepository;
use App\Entity\Factory\BookFactory;
use App\Entity\Book;

class BookService extends AbstractServiceConfigurator
{
    public function __construct(private BookFactory $bookFactory, private BookRepository $useBookRepository)
    {
    }

    public function create(Request $request): Response
    {
        $title = $request->request->get('title');
        $publicationYear = $request->request->get('publicationYear');
        $ISBN = $request->request->get('ISBN');
        $pageCount = $request->request->get('pageCount');

        $book = $this->bookFactory->newBookInstance($title, $publicationYear, $ISBN, $pageCount);

        return $this->useBookRepository->addBook($book);
    }

    public function getAll(): array
    {
        return $this->useBookRepository->getAllBooks();
    }

    public function delete(Request $request): Response
    {
        $id = $request->attributes->get('id');
        return $this->useBookRepository->removeBook($id);
    }
}