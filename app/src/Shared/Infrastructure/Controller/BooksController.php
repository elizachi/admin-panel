<?php 

namespace App\Shared\Infrastructure\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Users\Infrastructure\Repository\BookRepository;

class BooksController extends AbstractController {

    private $useBookRepository;

    public function __construct(BookRepository $bookRepository) {
        $this->useBookRepository = $bookRepository;
    }

    #[Route('/books', name: 'loadBooks', methods: ['GET'])]
    public function loadAction(Request $request): Response {

        ob_start();
        include $this->getParameter('kernel.project_dir') . '/templates/books.php';
        $content = ob_get_clean();

        $books = $this->useBookRepository->getAllBooks();

        $content = str_replace('{{CONTENT}}', implode('\n', $books), $content);

        return new Response($content);
    }
}