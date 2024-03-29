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

        $authors = $this->useAuthorRepository->getAllAuthors();
        return new Response(implode('\n', $authors));
    }
}