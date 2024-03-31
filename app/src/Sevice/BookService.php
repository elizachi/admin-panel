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

        if(!($this->isValidYear($publicationYear))) {
            return new Response('Wrong publication year', Response::HTTP_BAD_REQUEST);
        } else if(!($this->isValidISBN($ISBN))) {
            return new Response('Wrong ISBN', Response::HTTP_BAD_REQUEST);
        } else if(!($this->isValidPageCount($pageCount))) {
            return new Response('Wrong page count', Response::HTTP_BAD_REQUEST);
        }

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

    private function isValidISBN(string $ISBN): bool
    {
        $isbn = str_replace('-', '', $ISBN);

        if (strlen($ISBN) != 10) {
            return false;
        }
    
        $total = 0;
        for ($i = 0; $i < 9; $i++) {
            if (!is_numeric($ISBN[$i])) {
                return false;
            }
            $total += intval($isbn[$i]) * ($i + 1);
        }
    
        if (is_numeric($ISBN[9]) || $ISBN[9] == 'X') {
            $total += ($ISBN[9] == 'X' ? 10 : intval($ISBN[9])) * 10;
        }
        return $total % 11 == 0;  
    }

    private function isValidYear(string $year): bool
    {
        if(!ctype_digit($year)) {
            return false;
        }

        $currentYear = date('Y');
        $minYear = 1970;

        if ($year >= $minYear && $year <= $currentYear) {
            return true;
        } else {
            return false;
        }
    }

    private function isValidPageCount(string $pageCount): bool {
        if(!ctype_digit($pageCount)) {
            return false;
        }
        return true;
    }
}