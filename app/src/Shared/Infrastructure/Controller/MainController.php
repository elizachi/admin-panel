<?php 

namespace App\Shared\Infrastructure\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Users\Infrastructure\Repository\UserRepository;

class MainController extends AbstractController {

    private $useUserRepository;

    public function __construct(UserRepository $userRepository) {
        $this->useUserRepository = $userRepository;
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
        $login = $request->request->get('login');
        $password = $request->request->get('password');

        $user = $this->useUserRepository->findByLoginAndPassword('admin', 
        '5f4dcc3b5aa765d61d8327deb882cf99');

        if ($user != null) {
            setCookie('login', $user->getLogin(), 0, '/');
        }

        return $this->showData($request);
    }
}