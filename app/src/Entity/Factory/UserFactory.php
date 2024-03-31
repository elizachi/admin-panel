<?php

declare(strict_types=1);

namespace App\Entity\Factory;

use App\Entity\User;
use App\Security\Service\HashGenerator;

class UserFactory
{
    public function __construct(private readonly HashGenerator $hashGenerator)
    {
    }

    public function newUserInstance(string $login, string $password): User
    {
        $user = new User(
            $login,
            $this->hashGenerator->hash($password)
        );

        return $user;
    }
}