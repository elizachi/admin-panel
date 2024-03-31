<?php 

namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LogoutController extends AbstractController
{
    #[Route('/logout', name: 'logot', methods: ['POST'])]
    public function login(): Response
    {
        setCookie('login', '', time() - 3600, '/');
        return new Response('User successfully logout');
    }
}