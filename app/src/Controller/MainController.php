<?php 

namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\UserService;

class MainController extends AbstractController
{

    public function __construct(private readonly UserService $useUserService)
    {
    }

    #[Route('/', name: 'load', methods: ['GET'])]
    public function loadAction(Request $request): Response
    {
        if($request->cookies->has('login')) {
            return $this->render('main/index.html.twig');
        } else {
            return $this->render('main/unauthorized.html.twig');
        }
    }

    #[Route('/', name: 'buttonLog', methods: ['POST'])]
    public function loginAction(Request $request): Response
    {
        $user = $this->useUserService->findByLoginAndPassword($request);

        if ($user != null) {
            setCookie('login', $user->getLogin(), 0, '/');
            return new Response('User successfully authorized', Response::HTTP_OK);
        }

        return new Response('Invalid login or password, please, try again.', Response::HTTP_BAD_REQUEST);
    }
}