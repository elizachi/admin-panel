<?php 

namespace App\Service;
use Symfony\Component\DependencyInjection\Loader\Configurator\AbstractServiceConfigurator;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\UserRepository;
use App\Entity\Factory\UserFactory;

class UserService extends AbstractServiceConfigurator {

    public function __construct(private UserFactory $userFactory, private UserRepository $useUserRepository) {
    }

    public function findByLoginAndPassword(Request $request) {
        $login = $request->request->get('login');
        $password = $request->request->get('password');

        $user = $this->userFactory->newUserInstance($login, $password);

        $this->useUserRepository->findByLoginAndPassword($user->getLogin(), $user->getPassword());
    }
}