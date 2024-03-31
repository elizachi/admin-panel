<?php 

declare(strict_types=1);

namespace App\Repository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\User;

class UserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    public function findByLoginAndPassword(string $login, string $password): ?User
    {
        return $this->findOneBy(['login' => $login, 'password' => $password]);
    }
}