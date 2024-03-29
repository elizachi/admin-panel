<?php 

namespace App\Shared\Infrastructure\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Users\Infrastructure\Repository\AuthorRepository;
use App\Users\Domain\Entity\Author;

class AuthorController extends AbstractController {

    private $useAuthorRepository;

    public function __construct(AuthorRepository $authorRepository) {
        $this->useAuthorRepository = $authorRepository;
    }

    private function showData(Request $request): Response {
        ob_start();
        include $this->getParameter('kernel.project_dir') . '/templates/authors.php';
        $content = ob_get_clean();

        $authors = $this->useAuthorRepository->getAllAuthors();

        $result = '';
        for ($i = 0; $i < count($authors); $i++) {
            $result .= $authors[$i];
            if ($i < count($authors) - 1) {
                $result .= "\n";
            }
        }

        $content = str_replace('{{CONTENT}}', $result, $content);

        return new Response($content);
    }
    
    #[Route('/authors', name: 'loadAuthors', methods: ['GET'])]
    public function loadAction(Request $request): Response {
        
        return $this->showData($request);
    }

    #[Route('/authors', name: 'buttonAdd', methods: ['POST'])]
    public function addAction(Request $request): Response {
        $name = $request->request->get('name');
        $surname = $request->request->get('surname');
        $patronymic = $request->request->get('patronymic');

        $this -> useAuthorRepository->addAuthor(new Author($name, $surname, $patronymic));

        return $this->showData($request);
    }
}