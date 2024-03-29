<?php 

namespace App\Shared\Infrastructure\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Cookie;
use App\Users\Infrastructure\Repository\BookRepository;

class BooksController extends AbstractController {

    private $useBookRepository;

    public function __construct(BookRepository $bookRepository) {
        $this->useBookRepository = $bookRepository;
    }

    #[Route('/books', name: 'loadBooks', methods: ['GET'])]
    public function loadAction(Request $request): Response {

        $books = $this->useBookRepository->getAllBooks();
        return new Response(implode('\n', $books));
    }
}