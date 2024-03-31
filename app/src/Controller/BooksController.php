<?php 

namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\BookService;

class BooksController extends AbstractController
{
    public function __construct(private readonly BookService $useBookService)
    {
    }

    #[Route('/books', name: 'loadBooks', methods: ['GET'])]
    public function loadAction(Request $request): Response
    {
        $books = $this->useBookService->getAll();

        return $this->render('books.html.twig', [
            'books' => $books,
        ]);
    }

    #[Route('/books', name: 'addBook', methods: ['POST'])]
    public function addAction(Request $request): Response
    {
        $this->useBookService->create($request);
        return new Response('Book was created successfully', Response::HTTP_OK);
    }

    #[Route('/books/{id}', name: 'deleteBook', methods: ['DELETE'])]
    public function deleteAction(Request $request): Response
    {
        $this->useBookService->delete($request);
        return new Response('Book was deleted successfully', Response::HTTP_OK);
    }
}