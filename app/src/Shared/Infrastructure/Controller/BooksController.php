<?php 

namespace App\Shared\Infrastructure\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Users\Infrastructure\Repository\BookRepository;
use App\Users\Domain\Entity\Book;

class BooksController extends AbstractController {

    private $useBookRepository;

    public function __construct(BookRepository $bookRepository) {
        $this->useBookRepository = $bookRepository;
    }

    private function showData(Request $request): Response {
        ob_start();
        include $this->getParameter('kernel.project_dir') . '/templates/books.php';
        $content = ob_get_clean();

        $books = $this->useBookRepository->getAllBooks();

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
    public function loadAction(Request $request): Response {

        return $this->showData($request);
    }

    #[Route('/books', name: 'buttonAdd', methods: ['POST'])]
    public function addAction(Request $request): Response {
        $title = $request->request->get('title');
        $publicationYear = $request->request->get('publicationYear');
        $ISBN = $request->request->get('ISBN');
        $pageCount = $request->request->get('pageCount');

        $this -> useBookRepository->addAuthor(new Book($title, $publicationYear, $ISBN, $pageCount));

        return $this->showData($request);
    }
}