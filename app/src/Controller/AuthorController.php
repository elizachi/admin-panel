<?php 

namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\AuthorService;

class AuthorController extends AbstractController
{
    public function __construct(private readonly AuthorService $useAuthorService)
    {
    }

    private function showData(Request $request): Response
    {
        ob_start();
        include $this->getParameter('kernel.project_dir') . '/templates/authors.php';
        $content = ob_get_clean();

        $authors = $this->useAuthorService->getAll();

        $result = '';
        for ($i = 0; $i < count($authors); $i++)
        {
            $result .= $authors[$i];
            if ($i < count($authors) - 1)
            {
                $result .= "\n";
            }
        }

        $content = str_replace('{{CONTENT}}', $result, $content);

        return new Response($content);
    }
    
    #[Route('/authors', name: 'loadAuthors', methods: ['GET'])]
    public function loadAction(Request $request): Response
    {
        return $this->showData($request);
    }

    #[Route('/authors', name: 'buttonAdd', methods: ['POST'])]
    public function addAction(Request $request): Response
    {
        $this->useAuthorService->create($request);
        return $this->showData($request);
    }

    #[Route('/authors', name: 'deleteAuthor', methods: ['DELETE'])]
    public function deleteAction(Request $request): Response
    {
        $this->useAuthorService->delete($request);
        return $this->showData($request);
    }
}