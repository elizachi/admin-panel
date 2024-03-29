<?php 

namespace App\Shared\Infrastructure\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LoginController extends AbstractController {
    #[Route('/login', name: 'login')]
    public function login(): Response {
        ob_start();
        include $this->getParameter('kernel.project_dir') . '/templates/login.php';
        $content = ob_get_clean();

        return new Response($content);
    }
}