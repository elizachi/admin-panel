<?php

declare(strict_types=1);

namespace App\Entity\Factory;

use App\Entity\User;

class UserFactory
{
    public function __construct() {
    }

    public function create(string $login, string $password): User {
        /**
         * @todo add hash password
         */
        $user = new User($login, $password);

        return $user;
    }
}