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
    
    #[Route('/authors', name: 'loadAuthors', methods: ['GET'])]
    public function loadAction(Request $request): Response
    {
        $authors = $this->useAuthorService->getAll();

        return $this->render('authors.html.twig', [
            'authors' => $authors,
        ]);
    }

    #[Route('/authors', name: 'addAuthor', methods: ['POST'])]
    public function addAction(Request $request): Response
    {
        return $this->useAuthorService->create($request);
    }

    #[Route('/authors/{id}', name: 'deleteAuthor', methods: ['DELETE'])]
    public function deleteAction(Request $request): Response
    {
        return $this->useAuthorService->delete($request);
    }
}