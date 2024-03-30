<?php 

namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\UserService;

class MainController extends AbstractController {

    public function __construct(private readonly UserService $useUserService) {
    }

    private function showData(Request $request): Response {
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

    #[Route('/', name: 'load', methods: ['GET'])]
    public function loadAction(Request $request): Response {

        return $this->showData($request);
    }

    #[Route('/', name: 'buttonLog', methods: ['POST'])]
    public function loginAction(Request $request): Response {

        $user = $this->useUserService->findByLoginAndPassword($request);

        if ($user != null) {
            setCookie('login', $user->getLogin(), 0, '/');
        }

        return $this->showData($request);
    }
}