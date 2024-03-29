<?php 

namespace App\Shared\Infrastructure\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Cookie;

class MainController extends AbstractController {
    #[Route('/', name: 'load')]
    public function loadAction(Request $request): Response {

        if($request->cookies->has('login')) {
            ob_start();
            include $this->getParameter('kernel.project_dir') . '/templates/main/index.php';
            $content = ob_get_clean();
        } else {
            ob_start();
            include $this->getParameter('kernel.project_dir') . '/templates/main/unauthorized.php';
            $content = ob_get_clean();
        }

        return new Response($content);
    }
    // #[Route('/', name: 'login', methods: ['POST'])]
    // public function loginAction(Request $request): Response {
    //     $login = $request->get('login');
    //     $password = $request->get('password');

    //     $response = new Response($login);
    //     $response->headers->setCookie(new Cookie('login', $login, 0, '/'));

    //     return $response;
    // }
}