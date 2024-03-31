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

    private function showData(Request $request): Response
    {
        ob_start();
        include $this->getParameter('kernel.project_dir') . '/templates/books.php';
        $content = ob_get_clean();

        $books = $this->useBookService->getAll();

        $result = '';
        for ($i = 0; $i < count($books); $i++) {
            $result .= $books[$i];
            if ($i < count($books) - 1) {
                $result .= "\n";
            }
        }

        $content = str_replace('{{CONTENT}}', $result, $content);

        return new Response($content);
    }

    #[Route('/books', name: 'loadBooks', methods: ['GET'])]
    public function loadAction(Request $request): Response
    {
        return $this->showData($request);
    }

    #[Route('/books', name: 'addBook', methods: ['POST'])]
    public function addAction(Request $request): Response
    {
        $this->useBookService->create($request);
        return $this->showData($request);
    }

    #[Route('/books/{id}', name: 'deleteBook', methods: ['DELETE'])]
    public function deleteAction(Request $request): Response
    {
        $this->useBookService->delete($request);
        return $this->showData($request);
    }
}