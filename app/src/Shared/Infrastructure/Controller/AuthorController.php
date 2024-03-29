<?php 

namespace App\Shared\Infrastructure\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Users\Infrastructure\Repository\AuthorRepository;

class AuthorController extends AbstractController {

    private $useAuthorRepository;

    public function __construct(AuthorRepository $authorRepository) {
        $this->useAuthorRepository = $authorRepository;
    }

    #[Route('/authors', name: 'loadAuthors', methods: ['GET'])]
    public function loadAction(Request $request): Response {

        ob_start();
        include $this->getParameter('kernel.project_dir') . '/templates/authors.php';
        $content = ob_get_clean();

        $authors = $this->useAuthorRepository->getAllAuthors();

        $content = str_replace('{{CONTENT}}', implode('\n', $authors), $content);

        return new Response($content);
    }
}