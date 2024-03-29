<?php 

declare(strict_types=1);

namespace App\Users\Domain\Repository;
use App\Users\Domain\Entity\User;

interface UserRepositoryInterface {

    public function findByLoginAndPassword(string $login, string $password): ?User;

}