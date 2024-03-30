<?php 

namespace App\Service;
use Symfony\Component\DependencyInjection\Loader\Configurator\AbstractServiceConfigurator;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\BookRepository;
use App\Entity\Factory\BookFactory;

class BookService extends AbstractServiceConfigurator {

    public function __construct(private BookFactory $bookFactory, private BookRepository $useBookRepository) {
    }

    public function create(Request $request) {
        $title = $request->request->get('title');
        $publicationYear = $request->request->get('publicationYear');
        $ISBN = $request->request->get('ISBN');
        $pageCount = $request->request->get('pageCount');

        $book = $this->bookFactory->newBookInstance($title, $publicationYear, $ISBN, $pageCount);

        $this->useBookRepository->addBook($book);
    }

    public function getAll(): array {

        return $this->useBookRepository->getAllBooks();
    }
}